<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class UserMaster extends Component
{
    public $filterJabatanId = null;

    public function mount($id_jabatan = null)
    {
        // Hanya admin yang bisa mengakses halaman ini
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $this->filterJabatanId = $id_jabatan;
    }

    public function render()
    {
        return view('livewire.user-master');
    }
}