<?php

namespace App\Livewire\DataUser;

use App\Models\DataPd;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class DataUserTable extends Component
{
    public $selectedSkpd = null;

    #[On('skpdSelected')]
    public function skpdSelected($skpd)
    {
        $this->selectedSkpd = $skpd;
    }

    public function render()
    {

        $query = User::query()
            ->whereIn('role', ['user', 'kepala', 'subkepala']);

        if (!empty($this->selectedSkpd)) {
            $query->where('jabatan.id_pd', $this->selectedSkpd);
        }
        $query->join('struktur_jabatans as jabatan', 'users.id_jabatan', '=', 'jabatan.id');

        $query->leftJoin('struktur_jabatans as parent_jabatan', 'jabatan.parent_id', '=', 'parent_jabatan.id');

        $datajabatanstaf = $query->selectRaw("
                users.*,
                users.id as iduser,
                jabatan.nama_jabatan as nama_jabatan_user,
                COALESCE(parent_jabatan.nama_jabatan, jabatan.tipe_jabatan) as nama_jabatan_struktural
            ")
            ->orderBy('nama_jabatan_struktural', 'asc')
            ->orderBy('nama_jabatan_user', 'asc')
            ->get();


        $dataskpd = DataPd::all();
        $this->dispatch('plugins-reinitialized');

        return view('livewire.data-user.data-user-table', [
            'datajabatanstaf' => $datajabatanstaf,
            'dataskpd' => $dataskpd,
        ]);
    }


    public function toggleStatus($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->status = $user->status === 'active' ? 'inactive' : 'active';
            $user->save();
        }
    }
}
