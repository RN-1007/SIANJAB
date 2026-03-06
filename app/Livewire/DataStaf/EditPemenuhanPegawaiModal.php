<?php

namespace App\Livewire\DataStaf;

use App\Models\DataUraianTugasStaf;
use Livewire\Attributes\On;
use Livewire\Component;

class EditPemenuhanPegawaiModal extends Component
{
    public ?DataUraianTugasStaf $uraianTugas = null;

    public $pns;
    public $non_pns;
    public $pppk;
    public $cpns;
    public $pemenuhan_pegawai;

    #[On('openEditPemenuhanModal')]
    public function loadModal($uraianTugasId)
    {
        $this->reset();
        $this->resetValidation();

        $this->uraianTugas = DataUraianTugasStaf::find($uraianTugasId);

        if ($this->uraianTugas) {
            $this->pns = $this->uraianTugas->pns;
            $this->non_pns = $this->uraianTugas->non_pns;
            $this->pppk = $this->uraianTugas->pppk;
            $this->cpns = $this->uraianTugas->cpns;
            $this->pemenuhan_pegawai = $this->uraianTugas->pemenuhan_pegawai;

            $this->dispatch('open-modal', name: 'edit-pemenuhan-pegawai');
        }
    }

    public function save()
    {
        if (!$this->uraianTugas) {
            return;
        }

        $validatedData = $this->validate([
            'pns' => 'required|numeric|min:0',
            'non_pns' => 'required|numeric|min:0',
            'pppk' => 'required|numeric|min:0',
            'cpns' => 'required|numeric|min:0',
            'pemenuhan_pegawai' => 'nullable|numeric|min:0',
        ]);

        $jumlah_eksisting = $validatedData['pns'] + $validatedData['non_pns'] + $validatedData['pppk'] + $validatedData['cpns'];
        // $pemenuhan_pegawai = $jumlah_eksisting - $this->uraianTugas->abk_ideal;

        $this->uraianTugas->update([
            'pns' => $validatedData['pns'],
            'non_pns' => $validatedData['non_pns'],
            'pppk' => $validatedData['pppk'],
            'cpns' => $validatedData['cpns'],
            'jumlah_eksisting' => $jumlah_eksisting,
            'pemenuhan_pegawai' => $validatedData['pemenuhan_pegawai'],
        ]);

        $this->dispatch('close-modal', name: 'edit-pemenuhan-pegawai');

        $this->dispatch('data-updated');

        $this->dispatch('show-success', message: 'Data pemenuhan pegawai berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.data-staf.edit-pemenuhan-pegawai-modal');
    }
}
