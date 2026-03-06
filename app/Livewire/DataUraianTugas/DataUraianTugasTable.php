<?php

namespace App\Livewire\DataUraianTugas;

use App\Models\DataUraianTugasStaf;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

// Listener ini tetap ada agar Table bisa di-refresh dari Form Tambah
#[On('refresh-in-data-uraian-tugas-table')] 
class DataUraianTugasTable extends Component
{
    public $uraianTugasId;
    public $pns, $non_pns, $pppk, $cpns, $pemenuhan_pegawai, $kelas_jabatan;
    public $id_user;
    public $availableUsers = [];
    public $deleteId, $deleteName;

    #[On('set-id-user-from-js')]
    public function setUserIdFromJs($id_user)
    {
        $this->id_user = $id_user;
    }

    public function edit($id)
    {
        $this->resetValidation();
        $uraianTugas = DataUraianTugasStaf::with('user')->find($id);

        if ($uraianTugas) {
            $this->uraianTugasId = $uraianTugas->id;
            $this->id_user = $uraianTugas->id_user;
            $this->pns = $uraianTugas->pns;
            $this->non_pns = $uraianTugas->non_pns;
            $this->pppk = $uraianTugas->pppk;
            $this->cpns = $uraianTugas->cpns;
            $this->pemenuhan_pegawai = $uraianTugas->pemenuhan_pegawai;
            $this->kelas_jabatan = $uraianTugas->kelas_jabatan;

            $usersLain = User::whereDoesntHave('uraianTugasStaf')
                ->whereIn('role', ['user', 'kepala'])
                ->get();

            if ($uraianTugas->user) {
                $this->availableUsers = $usersLain->push($uraianTugas->user)->sortBy('jabatan');
            } else {
                $this->availableUsers = $usersLain->sortBy('jabatan');
            }
            
            $this->dispatch('open-edit-modal');
            $this->dispatch('set-edit-user-data', ['id_user' => $this->id_user]);
        }
    }

    public function update()
    {
        $validatedData = $this->validate([
             'id_user' => 'required|exists:users,id|unique:data_uraian_tugas_stafs,id_user,' . $this->uraianTugasId,
             'pns' => 'required|numeric|min:0',
             'non_pns' => 'required|numeric|min:0',
             'pppk' => 'required|numeric|min:0',
             'cpns' => 'required|numeric|min:0',
             'pemenuhan_pegawai' => 'required|numeric|min:0',
             'kelas_jabatan' => 'required|numeric|min:0',
        ]);

        $uraianTugas = DataUraianTugasStaf::find($this->uraianTugasId);
        if ($uraianTugas) {
            $jumlah_eksisting = $validatedData['pns'] + $validatedData['non_pns'] + $validatedData['pppk'] + $validatedData['cpns'];
            $validatedData['jumlah_eksisting'] = $jumlah_eksisting;
            $uraianTugas->update($validatedData);
        }

        $this->dispatch('close-edit-modal');
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $uraianTugas = DataUraianTugasStaf::with('user')->find($id);
        if ($uraianTugas) {
            $this->deleteId = $uraianTugas->id;
            $this->deleteName = $uraianTugas->user?->jabatan ?? 'Data ' . $id;
            $this->dispatch('open-delete-modal');
        }
    }

    public function destroy()
    {
        if ($this->deleteId) {
            DataUraianTugasStaf::find($this->deleteId)->delete();
            $this->dispatch('close-delete-modal');
            $this->dispatch('refresh-uraian-tugas-form');
        }
    }

    public function resetInputFields()
    {
        $this->reset(['uraianTugasId', 'pns', 'non_pns', 'pppk', 'cpns', 'pemenuhan_pegawai', 'kelas_jabatan', 'id_user', 'availableUsers']);
        $this->resetValidation();
    }

    public function render()
    {
        // PERBAIKAN: HAPUS DISPATCH DI SINI UNTUK MENCEGAH LOOPING
        $this->dispatch('refresh-data-uraian-tugas-table');

        $uraianTugas = DataUraianTugasStaf::with('user')->latest()->get();

        return view('livewire.data-uraian-tugas.data-uraian-tugas-table', [
            'uraianTugas' => $uraianTugas
        ]);
    }
}