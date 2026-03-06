<?php

namespace App\Livewire\StafUtama;

use App\Models\DataPd;
use App\Models\DataStafUtama;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('refresh-staf-utama-table')]
class StafUtamaTable extends Component
{
    public $id_staf_utama;
    public $id_skpd = '';
    public $nomenklatur_jabatan_struktural = '';

    public $deleteId;
    public $deleteName;

    protected $rules = [
        'id_skpd' => 'required|exists:data_skpds,id',
        'nomenklatur_jabatan_struktural' => 'required|string|max:255',
    ];

       #[On('selectSkpdChanged')]
    public function updateSkpdId($skpdId)
    {
        $this->id_skpd = $skpdId;
    }


    public function edit($id)
    {
        $item = DataStafUtama::findOrFail($id);
        $this->id_staf_utama = $item->id;
        $this->id_skpd = $item->id_skpd;
        $this->nomenklatur_jabatan_struktural = $item->nomenklatur_jabatan_struktural;
        $this->dispatch('open-edit-modal');
        $this->dispatch('set-edit-skpd', ['skpdId' => $this->id_skpd]);
    }

    public function update()
    {
        $this->validate();
        $item = DataStafUtama::find($this->id_staf_utama);
        if ($item) {
            $item->update([
                'id_skpd' => $this->id_skpd,
                'nomenklatur_jabatan_struktural' => $this->nomenklatur_jabatan_struktural,
            ]);
        }
        $this->dispatch('close-edit-modal');
        session()->flash('message', 'Data Staf Utama berhasil diperbarui!');
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $item = DataStafUtama::find($id);
        if ($item) {
            $this->deleteId = $item->id;
            $this->deleteName = $item->nomenklatur_jabatan_struktural;
            $this->dispatch('open-delete-modal');
        }
    }

    public function destroy()
    {
        if ($this->deleteId) {
            DataStafUtama::find($this->deleteId)->delete();
            $this->dispatch('close-delete-modal');
            $this->reset(['deleteId', 'deleteName']);
            session()->flash('message', 'Data Staf Utama berhasil dihapus!');
        }
    }

    public function resetInputFields()
    {
        $this->reset(['id_staf_utama', 'id_skpd', 'nomenklatur_jabatan_struktural']);
        $this->resetErrorBag();
    }

    public function render()
    {
        $this->dispatch('staf-utama-table-updated');
        return view('livewire.staf-utama.staf-utama-table', [
            'items' => DataStafUtama::with('skpd')->orderBy('id', 'desc')->get(),
            'skpds' => DataPd::orderBy('nama_pd')->get(),
        ]);
    }

    public function refreshStafUtamaTable() {}
}
