<?php

namespace App\Livewire\UserMaster;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminMasterForm extends Component
{
    public $username;
    public $status = 'active';
    public $jabatan = 'Administrator Sistem'; // Default value sudah diatur di sini
    public $password;
    public $password_confirmation;

    private function resetInputFields()
    {
        $this->reset('username', 'password', 'password_confirmation');
        $this->status = 'active';
        $this->jabatan = 'Administrator Sistem'; // Pastikan reset juga mengembalikan ke default
        $this->resetErrorBag();
    }

    public function store()
    {
        // AWAL PERUBAHAN
        // Tambahkan validasi untuk 'jabatan' agar tidak kosong
        $validatedData = $this->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'status' => 'required|in:active,inactive',
            'jabatan' => 'required|string|max:255', // Validasi ditambahkan
            'password' => 'required|string|min:8|confirmed',
        ]);
        // AKHIR PERUBAHAN

        // Tambahkan nilai otomatis untuk admin
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role'] = 'admin';
        $validatedData['jabatan_staf'] = null;
        $validatedData['id_jabatan'] = null; // Tidak berelasi dengan struktur jabatan

        User::create($validatedData);

        session()->flash('message', 'Admin baru berhasil ditambahkan.');
        $this->resetInputFields();
        $this->dispatch('refresh-user-table');
        $this->dispatch('close-admin-modal');
    }

    public function render()
    {
        return view('livewire.user-master.admin-master-form');
    }
}