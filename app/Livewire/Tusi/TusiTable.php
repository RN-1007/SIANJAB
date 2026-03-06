<?php

namespace App\Livewire\Tusi;

use App\Models\TugasDanFungsi;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('refresh-tusi-in-table')]
class TusiTable extends Component
{
    public $id_tusi;
    public $tusi = '';
    public $code_tusi = '';
    public $nama_jabatan_permempan_45 = '';
    public $nama_jabatan_permempan_41 = '';
    public $deleteId;
    public $deleteName;

    protected function rules()
    {
        return [
            'tusi' => 'required|string',
            'code_tusi' => [
                'required',
                'max:255',
                Rule::unique('tugas_dan_fungsis')->ignore($this->id_tusi),
            ],
            'nama_jabatan_permempan_45' => 'required|string|max:255',
            'nama_jabatan_permempan_41' => 'required|string|max:255',
        ];
    }
    
    // Validasi khusus untuk update yang memeriksa apakah field berubah
    protected function getUpdateRules()
    {
        $tusi = TugasDanFungsi::find($this->id_tusi);
        $rules = $this->rules();
        
        // Jika code_tusi tidak berubah, hapus validasi unique
        if ($tusi && $tusi->code_tusi === $this->code_tusi) {
            $rules['code_tusi'] = ['required', 'string', 'max:255'];
        }
        
        return $rules;
    }


    public function edit($id)
    {
        $tusi = TugasDanFungsi::findOrFail($id);
        $this->id_tusi = $tusi->id;
        $this->tusi = $tusi->tusi;
        $this->code_tusi = $tusi->code_tusi;
        $this->nama_jabatan_permempan_45 = $tusi->nama_jabatan_permempan_45;
        $this->nama_jabatan_permempan_41 = $tusi->nama_jabatan_permempan_41;
        $this->dispatch('open-edit-modal');
    }

    public function update()
    {
        // Gunakan aturan validasi khusus untuk update
        $this->validate($this->getUpdateRules());
        
        $tusi = TugasDanFungsi::find($this->id_tusi);
        if ($tusi) {
            $tusi->update([
                'tusi' => $this->tusi,
                'code_tusi' => $this->code_tusi,
                'nama_jabatan_permempan_45' => $this->nama_jabatan_permempan_45,
                'nama_jabatan_permempan_41' => $this->nama_jabatan_permempan_41,
            ]);
        }
        $this->dispatch('close-edit-modal');
        session()->flash('message', 'Data Tusi berhasil diperbarui!');
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $tusi = TugasDanFungsi::find($id);
        if ($tusi) {
            $this->deleteId = $tusi->id;
            $this->deleteName = $tusi->tusi;
            $this->dispatch('open-delete-modal');
        }
    }

    public function destroy()
    {
        if ($this->deleteId) {
            TugasDanFungsi::find($this->deleteId)->delete();
            $this->dispatch('close-delete-modal');
            $this->reset(['deleteId', 'deleteName']);
            session()->flash('message', 'Data Tusi berhasil dihapus!');
        }
    }

    public function resetInputFields()
    {
        $this->reset(['id_tusi', 'tusi', 'code_tusi', 'nama_jabatan_permempan_45', 'nama_jabatan_permempan_41']);
        $this->resetErrorBag();
    }

    public function render()
    {
        $this->dispatch('refresh-tusi-table');
        return view('livewire.tusi.tusi-table', [
            'tusis' => TugasDanFungsi::orderBy('id', 'desc')->get()
        ]);
    }

    public function refreshTusiInTable() {}
}
