<?php

namespace App\Livewire\UraianTugasTusi;

use App\Models\DataUraianTugasStaf;
use App\Models\TugasDanFungsi;
use App\Models\UraianTugasDanTusi;
use Livewire\Attributes\On;
use Livewire\Component;

class UraianTugasTusiTable extends Component
{
    // Properti untuk edit
    public $selectedId;
    public $id_uraian_tugas_staf;
    public $id_tusi;

    public $deleteId = null;
    public $deleteName = '';

    protected $listeners = ['uraian-tugas-tusi-created' => '$refresh'];

    protected $rules = [
        'id_uraian_tugas_staf' => 'required|exists:data_uraian_tugas_stafs,id',
        'id_tusi' => 'required|exists:tugas_dan_fungsis,id',
    ];

    protected $messages = [
        'id_uraian_tugas_staf.required' => 'Jabatan Staf wajib dipilih.',
        'id_tusi.required' => 'Tugas dan Fungsi wajib dipilih.',
    ];

    #[On('editUraianTugasStafChanged')]
    public function setEditUraianTugasStaf($id)
    {
        $this->id_uraian_tugas_staf = $id;
    }

    #[On('editTusiChanged')]
    public function setEditTusi($id)
    {
        $this->id_tusi = $id;
    }

    public function edit($id)
    {
        $record = UraianTugasDanTusi::findOrFail($id);
        $this->selectedId = $id;
        $this->id_uraian_tugas_staf = $record->id_uraian_tugas_staf;
        $this->id_tusi = $record->id_tusi;
        $this->dispatch('open-edit-modal');

        $this->dispatch('set-edit-data', [
            'uraianTugasStafId' => $this->id_uraian_tugas_staf,
            'tusiId' => $this->id_tusi
        ]);
    }

    public function update()
    {
        $this->validate();
        if ($this->selectedId) {
            $record = UraianTugasDanTusi::find($this->selectedId);
            $record->update([
                'id_uraian_tugas_staf' => $this->id_uraian_tugas_staf,
                'id_tusi' => $this->id_tusi,
            ]);
            $this->resetInput();
            $this->dispatch('close-edit-modal');
            session()->flash('message', 'Data berhasil diperbarui.');
        }
    }

    public function confirmDelete($id)
    {
        $record = UraianTugasDanTusi::with(['tusi', 'dataUraianTugasStaf.user'])->findOrFail($id);

        $this->deleteId = $id;
        
        $this->deleteName = 'Tusi "' . ($record->tusi->tusi ?? 'N/A') . '" untuk jabatan "' . ($record->dataUraianTugasStaf->user->jabatan ?? 'N/A') . '"';

        $this->dispatch('open-delete-modal');
    }

    public function destroy()
    {
        if ($this->deleteId) {
            UraianTugasDanTusi::destroy($this->deleteId);
            session()->flash('message', 'Data berhasil dihapus.');
            $this->dispatch('close-delete-modal');
        }
    }

    public function resetInput()
    {
        $this->selectedId = null;
        $this->id_uraian_tugas_staf = null;
        $this->id_tusi = null;

        $this->dispatch('reset-edit-selects');
    }

    public function render()
    {
        $this->dispatch('setting-tusi-table-updated');

        $data = UraianTugasDanTusi::with(['tusi', 'dataUraianTugasStaf.user.strukturJabatan'])->latest()->get();

        $uraianTugasStafs = DataUraianTugasStaf::with('user')->get()->sortBy('user.jabatan');

        $tusis = TugasDanFungsi::orderBy('code_tusi', 'asc')->get();

        return view('livewire.uraian-tugas-tusi.uraian-tugas-tusi-table', [
            'uraianTugas' => $data,
            'uraianTugasStafs' => $uraianTugasStafs,
            'tusis' => $tusis,
        ]);
    }
}
