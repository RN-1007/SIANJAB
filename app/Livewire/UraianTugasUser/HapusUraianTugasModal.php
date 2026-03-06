<?php

namespace App\Livewire\UraianTugasUser;

use App\Models\DataDetailUraianTugasStaf;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class HapusUraianTugasModal extends Component
{
    public ?int $uraianTugasId = null;
    public ?string $uraianTugasName = null;

    #[On('openDeleteModal')]
    public function loadModal($uraianTugasId)
    {
        $this->reset();
        $item = DataDetailUraianTugasStaf::find($uraianTugasId);

        if ($item) {
            $this->uraianTugasId = $item->id;
            $this->uraianTugasName = $item->uraian_tugas_staf;

            $this->dispatch('open-delete-modal-event');
        } else {
            $this->dispatch('show-error', ['message' => 'Data untuk dihapus tidak ditemukan.']);
        }
    }

    public function delete()
    {
        if (!$this->uraianTugasId) {
            return;
        }

        try {
            $item = DataDetailUraianTugasStaf::findOrFail($this->uraianTugasId);

            $fileColumns = ['data_pendukung', 'data_pendukung_sebelumnya'];

            foreach ($fileColumns as $column) {
                $filePath = $item->{$column};
                if ($filePath && !Str::startsWith($filePath, 'http')) {
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }

            $item->delete();

            $this->dispatch('close-delete-modal-event');
            $this->dispatch('uraianTugasCreatedTable1');
            $this->dispatch('uraianTugasCreatedTable2');
            $this->dispatch('show-success', message: 'Uraian tugas berhasil dihapus.');
        } catch (\Exception $e) {
            $this->dispatch('show-error', ['message' => 'Gagal menghapus data.']);
            $this->dispatch('close-delete-modal-event');
        }
    }

    public function render()
    {
        return view('livewire.uraian-tugas-user.hapus-uraian-tugas-modal');
    }
}
