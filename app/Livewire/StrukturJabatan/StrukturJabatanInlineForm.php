<?php

namespace App\Livewire\StrukturJabatan;

use App\Models\StrukturJabatan;
use Livewire\Component;
use Livewire\Attributes\On;

class StrukturJabatanInlineForm extends Component
{
    public $parentId;
    public $parentName;
    public $tipeAnak;
    public $nama_jabatan;
    public $kelas_jabatan;
    public $id_pd;

    #[On('open-inline-add-modal')]
    public function openModal($parentId, $parentName, $tipeAnak)
    {
        $this->reset();
        $this->parentId = $parentId;
        $this->parentName = $parentName;
        $this->tipeAnak = $tipeAnak;

        $parent = StrukturJabatan::find($parentId);
        if ($parent) {
            $this->id_pd = $parent->id_pd;
        }
    }

    public function store()
    {
        $this->validate([
            'nama_jabatan' => 'required|string|max:255',
            'kelas_jabatan' => 'required|integer|min:1',
        ]);

        StrukturJabatan::create([
            'id_pd' => $this->id_pd,
            'parent_id' => $this->parentId,
            'nama_jabatan' => $this->nama_jabatan,
            'tipe_jabatan' => $this->tipeAnak,
            'kelas_jabatan' => $this->kelas_jabatan,
            'nomenklatur_jabatan' => $this->tipeAnak === 'Nomenklatur Jabatan' ? $this->nama_jabatan : null,
        ]);

        $this->dispatch('jabatan-created');
        $this->dispatch('close-modal');
        $this->reset();
        session()->flash('message', 'Jabatan baru berhasil ditambahkan!');
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.struktur-jabatan.struktur-jabatan-inline-form');
    }
}