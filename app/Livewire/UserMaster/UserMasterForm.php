<?php

namespace App\Livewire\UserMaster;

use App\Models\DataPd;
use App\Models\StrukturJabatan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserMasterForm extends Component
{
    public $id_pd;
    public $id_jabatan;
    public $strukturJabatans = [];
    public $role = 'user';

    // Properti form lainnya
    public $username;
    public $status = 'active';
    public $jabatan; // Diubah dari nama_jabatan
    public $password;
    public $password_confirmation;
    public $jabatan_staf;

    public function updatedIdPd($value)
    {
        if (!empty($value)) {
            $this->strukturJabatans = StrukturJabatan::where('id_pd', $value)->orderBy('nama_jabatan')->get();
        } else {
            $this->strukturJabatans = [];
        }
        $this->id_jabatan = null;
    }

    public function updatedRole($value)
    {
        if ($value === 'kepala') {
            $this->jabatan_staf = null;
        }
    }

    private function resetInputFields()
    {
        $this->reset();
        $this->role = 'user';
        $this->status = 'active';
        $this->strukturJabatans = [];
        $this->dispatch('reset-select2');
    }

    public function store()
    {
        if ($this->role !== 'user') {
            $this->jabatan_staf = null;
        }

        // PERUBAHAN UTAMA DI SINI
        $rules = [
            'id_pd' => 'required|exists:data_pds,id',
            'id_jabatan' => 'required|exists:struktur_jabatans,id',
            'username' => 'required|string|max:255|unique:users,username',
            'role' => 'required|in:user,kepala',
            'status' => 'required|in:active,inactive',
            'jabatan' => 'required|string|max:255', // Diubah dari nama_jabatan
            'password' => 'required|string|min:8|confirmed',
            'jabatan_staf' => 'required_if:role,user|nullable|in:pelaksana,fungsional,penunjang',
        ];
        
        $validatedData = $this->validate($rules);
        
        // Hapus id_pd dari data yang akan disimpan karena tidak ada di model User
        unset($validatedData['id_pd']);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($validatedData['role'] !== 'user') {
            $validatedData['jabatan_staf'] = null;
        }

        User::create($validatedData);

        session()->flash('message', 'User berhasil ditambahkan.');
        $this->resetInputFields();
        $this->dispatch('refresh-user-table');
        $this->dispatch('close-add-modal');
    }

    public function render()
    {
        $perangkatDaerahs = DataPd::orderBy('nama_pd')->get();
        return view('livewire.user-master.user-master-form', [
            'perangkatDaerahs' => $perangkatDaerahs
        ]);
    }
}