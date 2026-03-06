<?php

namespace App\Livewire\UraianTugasTusi;

use App\Models\DataUraianTugasStaf;
use App\Models\TugasDanFungsi;
use App\Models\UraianTugasDanTusi;
use Livewire\Attributes\On;
use Livewire\Component;

class UraianTugasTusiForm extends Component
{
    public $id_uraian_tugas_staf = null;
    public $id_tusi = null;

    #[On('uraianTugasStafChanged')]
    public function setUraianTugasStaf($id)
    {
        $this->id_uraian_tugas_staf = $id;
    }

    #[On('tusiChanged')]
    public function setTusi($id)
    {
        $this->id_tusi = $id;
    }

    public function resetInput()
    {
        $this->id_uraian_tugas_staf = null;
        $this->id_tusi = null;
        $this->dispatch('reset-selects');
    }

    public function store()
    {
        $this->validate([
            'id_uraian_tugas_staf' => 'required|exists:data_uraian_tugas_stafs,id',
            'id_tusi' => 'required|exists:tugas_dan_fungsis,id',
        ], [
            'id_uraian_tugas_staf.required' => 'Jabatan Staf wajib dipilih.',
            'id_tusi.required' => 'Tugas dan Fungsi wajib dipilih.',
        ]);

        $existing = UraianTugasDanTusi::where('id_uraian_tugas_staf', $this->id_uraian_tugas_staf)
            ->where('id_tusi', $this->id_tusi)
            ->exists();

        if ($existing) {
            session()->flash('error', 'Kombinasi Jabatan dan Tusi ini sudah ada.');
            $this->dispatch('close-modal');
            return;
        }

        UraianTugasDanTusi::create([
            'id_uraian_tugas_staf' => $this->id_uraian_tugas_staf,
            'id_tusi' => $this->id_tusi,
        ]);

        session()->flash('message', 'Data berhasil ditambahkan.');
        $this->resetInput();
        $this->dispatch('close-modal');
        $this->dispatch('uraian-tugas-tusi-created');
    }

    public function render()
    {
        $uraianTugasStafs = DataUraianTugasStaf::with(['user.strukturJabatan'])
            ->get()
            ->sortBy('user.jabatan');

        $tusis = TugasDanFungsi::orderBy('code_tusi', 'asc')->get();

        return view('livewire.uraian-tugas-tusi.uraian-tugas-tusi-form', [
            'uraianTugasStafs' => $uraianTugasStafs,
            'tusis' => $tusis,
        ]);
    }
}
