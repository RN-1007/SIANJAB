<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DataPd;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.app')]
class Skpd extends Component
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
        return view('livewire.skpd');
    }
}
