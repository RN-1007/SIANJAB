<?php

namespace App\Livewire\Skpd;

use App\Models\DataPd;
use Livewire\Component;
use Livewire\Attributes\On;

#[On('skpd-added')]
#[On('refresh-skpd-table')]
class SkpdTable extends Component
{

    public $id_skpd;
    public $nama_pd = '';
    public $deleteId;
    public $deleteName;

    protected $rules = [
        'nama_pd' => 'required|string|max:255',
    ];

    public function edit($id)
    {
        $skpd = DataPd::findOrFail($id);
        $this->id_skpd = $skpd->id;
        $this->nama_pd = $skpd->nama_pd;
        $this->dispatch('open-edit-modal');
    }

    public function update()
    {
        $this->validate();
        try {
            $skpd = DataPd::find($this->id_skpd);
            if ($skpd) {
                $skpd->update([
                    'nama_pd' => $this->nama_pd,
                ]);
            }

            $this->dispatch('close-edit-modal');
            // Menambahkan notifikasi sukses untuk update
            session()->flash('message', 'Data SKPD berhasil diperbarui!');
            $this->resetInputFields();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        $skpd = DataPd::find($id);
        if ($skpd) {
            $this->deleteId = $skpd->id;
            $this->deleteName = $skpd->nama_pd;
            $this->dispatch('open-delete-modal');
        } else {
            session()->flash('message', 'Data tidak ditemukan.');
        }
    }

    public function destroy()
    {
        if ($this->deleteId) {
            DataPd::find($this->deleteId)->delete();
            $this->dispatch('close-delete-modal');
            $this->reset(['deleteId', 'deleteName']);
            session()->flash('message', 'Data SKPD berhasil dihapus!');
        }
    }

    public function resetInputFields()
    {
        $this->reset(['id_skpd', 'nama_pd']);
        $this->resetErrorBag();
    }

    public function render()
    {
        $this->dispatch('skpd-table-updated');
        return view('livewire.skpd.skpd-table', [
            'skpds' => DataPd::orderBy('id', 'desc')->get()
        ]);
    }

    public function skpdAdded()
    {
        session()->flash('message', 'SKPD berhasil ditambahkan!');
    }

    public function refreshSkpdTable()
    {
        // Biarkan kosong. Livewire akan me-refresh komponen secara otomatis.
    }
}
