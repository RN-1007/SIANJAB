<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class DataUraianTugas extends Component
{
    public function render()
    {
         if (auth()->user()->role !== 'admin') {

            auth()->logout();

            $this->redirect(route('login'), navigate: true);
        }

        return view('livewire.data-uraian-tugas');
    }
}
