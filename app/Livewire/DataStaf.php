<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class DataStaf extends Component
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
        return view('livewire.data-staf');
    }
}
