<?php

namespace App\Livewire\UraianTugasUser;

use App\Models\DataDetailUraianTugasStaf;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class DataPendukungModal extends Component
{
    use WithFileUploads;

    public $modalType = '';
    public $existingFileName = '';
    public $show = false;
    public $selectedUraianTugasId;
    public $inputType = '';
    public $link = '';
    public $targetColumn = '';

    #[Rule('file|mimes:pdf,jpg,jpeg,png,doc,docx,excel,xls,xlsx,ppt,pptx|max:10048')]
    public $file;

    #[On('showDataPendukungModal')]
    public function showModal($uraianTugasId, $type = 'upload', $targetColumn = 'data_pendukung')
    {
        $this->resetInputPendukung();
        $this->selectedUraianTugasId = $uraianTugasId;
        $this->modalType = $type;
        $this->targetColumn = $targetColumn;

        if ($this->modalType === 'update') {
            $item = DataDetailUraianTugasStaf::find($uraianTugasId);
            $data = $item->{$this->targetColumn};

            if ($item && $data) {
                if (Str::startsWith($data, 'http')) {
                    $this->inputType = 'link';
                    $this->link = $data;
                } else {
                    $this->inputType = 'file';
                    $this->existingFileName = basename($data);
                }
            }
        }

        $this->dispatch('open-data-pendukung-modal');
    }

    public function updatedInputType()
    {
        $this->reset(['link', 'file']);
        $this->resetValidation(['link', 'file']);
    }

    public function saveDataPendukung()
    {
        if ($this->inputType === 'link') {
            $this->validate(['link' => 'required|url']);
        } elseif ($this->inputType === 'file') {
            if ($this->file) {
                $this->validateOnly('file');
            } elseif ($this->modalType === 'upload') {
                $this->validate(['file' => 'required']);
            }
        } else {
            $this->dispatch('show-error', message: 'Silakan pilih jenis input terlebih dahulu.');
            return;
        }

        $item = DataDetailUraianTugasStaf::find($this->selectedUraianTugasId);
        if (!$item) {
            return;
        }

        $dataLama = $item->{$this->targetColumn};
        $updateData = [];

        $typeColumn = 'type_' . $this->targetColumn;

        if ($this->inputType === 'file' && $this->file) {
            if ($dataLama && !Str::startsWith($dataLama, 'http')) {
                Storage::disk('public')->delete($dataLama);
            }
            // Simpan file baru
            $path = $this->file->store('data-pendukung', 'public');
            $updateData[$this->targetColumn] = $path;
            $updateData[$typeColumn] = 'file';
        } elseif ($this->inputType === 'link') {
            if ($dataLama && !Str::startsWith($dataLama, 'http')) {
                Storage::disk('public')->delete($dataLama);
            }
            $updateData[$this->targetColumn] = $this->link;
            $updateData[$typeColumn] = 'link';
        }

        if (!empty($updateData)) {
            $item->update($updateData);
        }

        $this->closeModal();
        $this->dispatch('show-success', message: 'Data pendukung berhasil disimpan!');
        $this->dispatch('uraianTugasCreatedTable2');
        $this->dispatch('uraianTugasCreatedTable1');
    }


    public function closeModal()
    {
        $this->dispatch('close-data-pendukung-modal');
        $this->resetInputPendukung();
    }

    private function resetInputPendukung()
    {
        $this->reset(['selectedUraianTugasId', 'inputType', 'link', 'file', 'existingFileName']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.uraian-tugas-user.data-pendukung-modal');
    }
}
