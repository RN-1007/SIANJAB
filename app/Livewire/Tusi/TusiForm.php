<?php

namespace App\Livewire\Tusi;

use App\Models\TugasDanFungsi;
use Livewire\Component;

class TusiForm extends Component
{
    public $tusi, $code_tusi, $nama_jabatan_permempan_45, $nama_jabatan_permempan_41;

    public function render()
    {
        return view('livewire.tusi.tusi-form');
    }

    public function store()
    {
        $this->validate([
            'tusi' => 'required|string|max:255',
            'code_tusi' => 'nullable|string|max:255',
            'nama_jabatan_permempan_45' => 'nullable|string|max:255',
            'nama_jabatan_permempan_41' => 'nullable|string|max:255',
        ]);

        TugasDanFungsi::create([
            'tusi' => $this->tusi,
            'code_tusi' => $this->code_tusi,
            'nama_jabatan_permempan_45' => $this->nama_jabatan_permempan_45,
            'nama_jabatan_permempan_41' => $this->nama_jabatan_permempan_41,
        ]);

        $this->reset(['tusi', 'code_tusi', 'nama_jabatan_permempan_45', 'nama_jabatan_permempan_41']);
        $this->dispatch('close-modal');
        session()->flash('message', 'Data Tusi berhasil ditambahkan!');

        $this->dispatch('refresh-tusi-in-table');
    }
}
