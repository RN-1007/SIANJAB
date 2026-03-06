<?php

namespace App\Livewire\UraianTugasUser;

use App\Models\RincianTugasStaf;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class RincianTugasUserModal extends Component
{
    public ?RincianTugasStaf $rincianTugas = null;


    #[On('showRincianTugasModal')]
    public function showModal($rincianTugasId)
    {
        // Cari data rincian tugas berdasarkan ID yang dikirim
        $this->rincianTugas = RincianTugasStaf::find($rincianTugasId);

        // Kirim event ke JavaScript untuk membuka modal secara fisik
        $this->dispatch('open-rincian-tugas-modal');
    }

    public function render()
    {
        return view('livewire.uraian-tugas-user.rincian-tugas-user-modal');
    }
}
