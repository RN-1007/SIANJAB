<?php

namespace App\Livewire\StafUser;

use Livewire\Component;
use App\Models\DataDetailUraianTugasStaf;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class StafDataPendukungModal extends Component
{
    use WithFileUploads;

    public $modalType = '';
    public $existingFileName = '';
    public $selectedUraianTugasId;
    public $inputType = '';
    public $link = '';
    public $targetColumn = '';
    public $show = false;

    #[Rule('file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx,ppt,pptx|max:10240')]
    public $file;

    #[On('showStafDataPendukungModal')]
    public function showModal($uraianTugasId, $type = 'upload', $targetColumn = 'data_pendukung')
    {
        $this->resetInputPendukung();
        $this->selectedUraianTugasId = $uraianTugasId;
        $this->modalType = $type;
        $this->targetColumn = $targetColumn;

        if ($this->modalType === 'update') {
            $item = DataDetailUraianTugasStaf::find($uraianTugasId);
            if ($item) {
                $data = $item->{$this->targetColumn};

                if ($data) {
                    if (Str::startsWith($data, 'http')) {
                        $this->inputType = 'link';
                        $this->link = $data;
                    } else {
                        $this->inputType = 'file';
                        $this->existingFileName = basename($data);
                    }
                }
            }
        }

        $this->dispatch('open-staf-data-pendukung-modal');
    }

    public function updatedInputType()
    {
        $this->reset(['link', 'file']);
        $this->resetValidation(['link', 'file']);
    }

    public function saveDataPendukung()
    {
        try {
            if (empty($this->inputType)) {
                $this->addError('inputType', 'Silakan pilih jenis input terlebih dahulu');
                return;
            }

            $item = DataDetailUraianTugasStaf::findOrFail($this->selectedUraianTugasId);
            $successMessage = '';

            // Membuat nama kolom 'type' secara dinamis
            $typeColumnName = 'type_' . $this->targetColumn;

            if ($this->inputType === 'file') {
                $this->validate([
                    'file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx,ppt,pptx|max:10240'
                ]);

                if ($item->{$this->targetColumn} && !Str::startsWith($item->{$this->targetColumn}, 'http')) {
                    Storage::disk('public')->delete($item->{$this->targetColumn});
                }

                $path = $this->file->store('staf-data-pendukung', 'public');

                $item->update([
                    $this->targetColumn => $path,
                    $typeColumnName => 'file'
                ]);
                $successMessage = 'File berhasil diupload!';
            } elseif ($this->inputType === 'link') {
                $this->validate(['link' => 'required|url']);

                if ($item->{$this->targetColumn} && !Str::startsWith($item->{$this->targetColumn}, 'http')) {
                    Storage::disk('public')->delete($item->{$this->targetColumn});
                }

                $item->update([
                    $this->targetColumn => $this->link,
                    $typeColumnName => 'link'
                ]);
                $successMessage = 'Link berhasil disimpan!';
            }

            $this->closeModal();
            $this->dispatch('stafDataUpdated');
            $this->dispatch('show-success-modal', [
                'title' => 'Berhasil!',
                'message' => $successMessage
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            logger()->error('Validation Error:', $e->errors());
        } catch (\Exception $e) {
            logger()->error('Upload Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            $this->addError('general', 'Gagal menyimpan data. Silakan coba lagi.');
        }
    }

    public function closeModal()
    {
        $this->dispatch('close-staf-data-pendukung-modal');
        $this->resetInputPendukung();
    }

    private function resetInputPendukung()
    {
        $this->reset([
            'selectedUraianTugasId',
            'inputType',
            'link',
            'file',
            'existingFileName',
            'modalType',
            'targetColumn'
        ]);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.staf-user.staf-data-pendukung-modal');
    }
}
