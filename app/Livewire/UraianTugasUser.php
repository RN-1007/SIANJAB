<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class UraianTugasUser extends Component
{
    public function render()
    {
        return view('livewire.uraian-tugas-user');
    }
}
