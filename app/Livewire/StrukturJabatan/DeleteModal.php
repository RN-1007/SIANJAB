<?php

namespace App\Livewire\StrukturJabatan;

use App\Models\StrukturJabatan as StrukturJabatanModel;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class DeleteModal extends Component
{
    public $deleteId = null;
    public $deleteName = '';
    public $message = '';

    #[On('open-delete-modal')]
    public function openModal($id)
    {
        Log::info('DeleteModal: openModal called with ID: ' . $id);

        $jabatan = StrukturJabatanModel::find($id);

        if ($jabatan) {
            $this->deleteId = $jabatan->id;
            $this->deleteName = $jabatan->nama_jabatan;

            $childrenCount = $jabatan->children()->count();

            if ($childrenCount > 0) {
                $this->message = '<p><strong>⚠️ PERHATIAN:</strong> Jabatan ini memiliki <strong>' . $childrenCount . ' turunan</strong> (sub-jabatan).</p>' .
                    '<p>Menghapus jabatan <strong>' . $this->deleteName . '</strong> akan <span class="text-danger">menghapus semua jabatan di bawahnya</span> secara otomatis (cascade delete).</p>' .
                    '<p class="text-danger font-weight-bold mt-3">Apakah Anda yakin ingin melanjutkan?</p>';
            } else {
                $this->message = '<p>Anda yakin ingin menghapus jabatan <strong>' . $this->deleteName . '</strong>?</p>';
            }

            $this->dispatch('show-delete-confirmation-modal');
        } else {
            Log::warning('DeleteModal: Jabatan tidak ditemukan dengan ID: ' . $id);
        }
    }

    public function destroy()
    {
        Log::info('DeleteModal: Destroy method called for ID: ' . $this->deleteId);

        if ($this->deleteId) {
            $jabatan = StrukturJabatanModel::find($this->deleteId);

            if ($jabatan) {
                $namaJabatan = $jabatan->nama_jabatan;
                $childrenCount = $jabatan->children()->count(); 

                try {
                    $this->deleteWithChildren($jabatan);

                    Log::info('DeleteModal: Jabatan deleted: ' . $namaJabatan . ' with ' . $childrenCount . ' children');

                    $this->dispatch('hide-delete-confirmation-modal');

                    $message = $childrenCount > 0
                        ? "Jabatan '{$namaJabatan}' dan {$childrenCount} turunannya berhasil dihapus!"
                        : "Jabatan '{$namaJabatan}' berhasil dihapus!";

                    $this->dispatch('delete-success', ['message' => $message]);
                    session()->flash('message', 'Jabatan berhasil dihapus!');
                    return redirect(request()->header('Referer'));
                } catch (\Exception $e) {
                    Log::error('Error deleting jabatan: ' . $e->getMessage());
                    session()->flash('error', 'Terjadi kesalahan saat menghapus jabatan.');
                }
            }

            $this->reset(['deleteId', 'deleteName', 'message']);
        }
    }

    private function deleteWithChildren($jabatan)
    {
        foreach ($jabatan->children as $child) {
            $this->deleteWithChildren($child);
        }
        $jabatan->delete();
    }

    public function closeModal()
    {
        $this->reset(['deleteId', 'deleteName', 'message']);

        $this->dispatch('hide-delete-confirmation-modal');
    }

    public function render()
    {
        return view('livewire.struktur-jabatan.delete-modal');
    }
}
