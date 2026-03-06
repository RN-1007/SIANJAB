<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class StafUtama extends Component
{
    public function mount()
    {
        if (auth()->user()->role !== 'admin') {

            auth()->logout();

            $this->redirect(route('login'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.staf-utama');
    }
}