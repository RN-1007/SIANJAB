<?php

namespace App\Livewire\StrukturJabatan;

use App\Models\DataPd;
use App\Models\StrukturJabatan;
use Livewire\Component;
use Illuminate\Validation\Rule;

class StrukturJabatanForm extends Component
{
    public $id_pd = '';
    public $nama_jabatan = '';
    public $tipe_jabatan = '';
    public $kelas_jabatan = '';

    protected $listeners = ['pdSelected'];

    public function pdSelected($pdId)
    {
        $this->id_pd = $pdId;
    }

    public function store()
    {
        $this->validate([
            'id_pd' => [
                'required',
                'exists:data_pds,id',
                function ($attribute, $value, $fail) {
                    if ($this->tipe_jabatan == 'Staf Ahli' || $this->tipe_jabatan == 'Jabatan Fungsional') {
                        $pimpinanTinggiExists = StrukturJabatan::where('id_pd', $value)
                            ->where('tipe_jabatan', 'Pimpinan Tinggi')
                            ->exists();

                        if (!$pimpinanTinggiExists) {
                            $fail('Harap tambahkan "Pimpinan Tinggi" untuk PD ini terlebih dahulu sebelum menambahkan ' . $this->tipe_jabatan . '.');
                        }
                    }
                }
            ],
            'nama_jabatan' => 'required|string|max:255',

            'tipe_jabatan' => [
                'required',
                'in:Pimpinan Tinggi,Staf Ahli,Jabatan Fungsional',
                Rule::unique('struktur_jabatans')->where(function ($query) {
                    return $query->where('id_pd', $this->id_pd);
                })
            ],

            'kelas_jabatan' => 'required|integer|min:1',
        ], [
            'tipe_jabatan.unique' => 'Tipe jabatan ini sudah ada untuk Perangkat Daerah yang dipilih.'
        ]);

        $parentId = null;
        if ($this->tipe_jabatan == 'Staf Ahli' || $this->tipe_jabatan == 'Jabatan Fungsional') {
            $pimpinanTinggi = StrukturJabatan::where('id_pd', $this->id_pd)
                ->where('tipe_jabatan', 'Pimpinan Tinggi')
                ->first();
            
            if ($pimpinanTinggi) { 
                $parentId = $pimpinanTinggi->id;
            }
        }

        StrukturJabatan::create([
            'id_pd' => $this->id_pd,
            'parent_id' => $parentId,
            'nama_jabatan' => $this->nama_jabatan,
            'tipe_jabatan' => $this->tipe_jabatan,
            'kelas_jabatan' => $this->kelas_jabatan,
        ]);

        $this->dispatch('jabatan-created');
        $this->dispatch('close-modal');
        $this->reset();
        session()->flash('message', 'Jabatan Pimpinan baru berhasil ditambahkan!');
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        $perangkatDaerahs = DataPd::orderBy('nama_pd')->get();

        return view('livewire.struktur-jabatan.struktur-jabatan-form', [
            'perangkatDaerahs' => $perangkatDaerahs,
        ]);
    }
}


