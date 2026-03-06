<?php


namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Tusi extends Component
{
    public function render()
    {
        return view('livewire.tusi');
    }
}