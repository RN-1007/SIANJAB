<?php

namespace App\Livewire;

use App\Models\DataUraianTugasStaf;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class StafUser extends Component
{
    public $jabatanStafId;
    public $namaJabatanStaf;

    public function mount($jabatanStafId = null)
    {
        $this->jabatanStafId = $jabatanStafId; // id User
        $this->namaJabatanStaf = null;

        if ($this->jabatanStafId) {
            // 1. Cari data penugasan staf berdasarkan id_user
            $dataPenugasanStaf = DataUraianTugasStaf::where('id_user', $this->jabatanStafId)->first();

            // 2. Pastikan data ditemukan dan relasi 'staf' tidak null
            if ($dataPenugasanStaf && $dataPenugasanStaf->staf) {
                $this->namaJabatanStaf = $dataPenugasanStaf->staf->nomenklatur_jabatan_struktural;
            }
        }
    }

    public function render()
    {
        return view('livewire.staf-user', [
            'namaJabatanStaf' => $this->namaJabatanStaf,
            'jabatanStafId' => $this->jabatanStafId,
        ]);
    }
}
