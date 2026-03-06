<?php

namespace App\Livewire\DataUraianTugas;

use App\Models\DataUraianTugasStaf;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class DataUraianTugasForm extends Component
{
    public $id_user = '';
    public $pns = 0;
    public $non_pns = 0;
    public $pppk = 0;
    public $cpns = 0;
    public $pemenuhan_pegawai;
    public $kelas_jabatan;

    #[On('userIdChanged')]
    public function setUserId($id)
    {
        $this->id_user = $id;

        $this->validateOnly('id_user', [
            'id_user' => 'required|exists:users,id|unique:data_uraian_tugas_stafs,id_user'
        ]);
    }

    public function save()
    {
        $validatedData = $this->validate([
            'id_user' => 'required|exists:users,id|unique:data_uraian_tugas_stafs,id_user',
            'pns' => 'required|numeric|min:0',
            'non_pns' => 'required|numeric|min:0',
            'pppk' => 'required|numeric|min:0',
            'cpns' => 'required|numeric|min:0',
            'pemenuhan_pegawai' => 'required|numeric|min:0',
            'kelas_jabatan' => 'required|numeric|min:0',
        ]);

        $jumlah_eksisting = $validatedData['pns'] + $validatedData['non_pns'] + $validatedData['pppk'] + $validatedData['cpns'];

        $validatedData['jumlah_eksisting'] = $jumlah_eksisting;

        $validatedData['abk_ideal'] = 0;
        $validatedData['abk_berlebih'] = 0;

        DataUraianTugasStaf::create($validatedData);

        $this->reset();

        $this->dispatch('close-modal');
        $this->dispatch('refresh-in-data-uraian-tugas-table');
    }

    public function render()
    {
        $existingUserIds = DataUraianTugasStaf::pluck('id_user')->all();

        $users = User::with('strukturJabatan')
            ->whereNotIn('id', $existingUserIds)
            ->whereIn('role', ['user'])
            ->orderBy('jabatan')
            ->get();

        return view('livewire.data-uraian-tugas.data-uraian-tugas-form', [
            'users' => $users
        ]);
    }
}
