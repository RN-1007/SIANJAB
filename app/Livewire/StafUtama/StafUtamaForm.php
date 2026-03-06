<?php

namespace App\Livewire\StafUtama;

use App\Models\DataPd;
use App\Models\DataStafUtama;
use Livewire\Component;
use Livewire\Attributes\On;

class StafUtamaForm extends Component
{
    public $id_staf_utama;
    public $id_skpd = '';
    public $nomenklatur_jabatan_struktural = '';

    protected $rules = [
        'id_skpd' => 'required|exists:data_skpds,id',
        'nomenklatur_jabatan_struktural' => 'required|string|max:255',
    ];

     #[On('selectSkpdChanged')] 
    public function updateSkpd($skpdId)
    {
        $this->id_skpd = $skpdId;
    }

    public function render()
    {
        return view('livewire.staf-utama.staf-utama-form', [
            'skpds' => DataPd::orderBy('nama_pd')->get(),
        ]);
    }

    public function store()
    {
        $this->validate();

        DataStafUtama::create([
            'id_skpd' => $this->id_skpd,
            'nomenklatur_jabatan_struktural' => $this->nomenklatur_jabatan_struktural,
        ]);

        $this->reset(['id_skpd', 'nomenklatur_jabatan_struktural']);

        $this->dispatch('close-modal');
        $this->dispatch('refresh-staf-utama-table');
    }
}