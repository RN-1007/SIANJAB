<?php

namespace App\Livewire\Skpd;

use App\Models\DataPd;
use Livewire\Component;

class SkpdForm extends Component
{

    public $nama_pd;

    public function render()
    {
        return view('livewire.skpd.skpd-form');
    }

    public function store()
    {
        $this->validate([
            'nama_pd' => 'required|string|max:255',
        ]);

        try {
            DataPd::create([
                'nama_pd' => $this->nama_pd
            ]);

            $this->reset('nama_pd');

            $this->dispatch('close-modal');
            $this->dispatch('refresh-skpd-table');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
