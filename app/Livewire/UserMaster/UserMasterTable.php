<?php

namespace App\Livewire\UserMaster;

use App\Models\StrukturJabatan;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;

#[On('refresh-user-table')]
class UserMasterTable extends Component
{
    public $userId;
    public $id_jabatan;
    public $username;
    public $role;
    public $password;
    public $password_confirmation;
    public $status;
    public $jabatan;
    public $jabatan_staf;

    public $deleteId;
    public $deleteName;

    public $filterJabatanId = null;
    public $filterJabatanName = '';

    #[On('jabatanChanged')]
    public function updateJabatan($jabatanId)
    {
        $this->id_jabatan = $jabatanId;
    }

    public function mount($filterJabatanId = null)
    {
        $this->filterJabatanId = $filterJabatanId;
        
        if($filterJabatanId) {
            $jabatan = StrukturJabatan::find($filterJabatanId);
            $this->filterJabatanName = $jabatan ? $jabatan->nama_jabatan : '';
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->id_jabatan = $user->id_jabatan;
        $this->username = $user->username;
        $this->role = $user->role;
        $this->status = $user->status;
        $this->jabatan = $user->jabatan;
        $this->jabatan_staf = $user->jabatan_staf;
        $this->password = '';
        $this->password_confirmation = '';


        $this->dispatch('open-edit-modal');
        $this->dispatch('set-edit-jabatan', ['jabatanId' => $this->id_jabatan]);
    }

    public function update()
    {
        $validatedData = $this->validate([
            'jabatan_staf' => ['nullable', 'required_if:role,user', 'in:pelaksana,fungsional,penunjang'],
            'jabatan' => ['nullable', 'required_if:role,user,kepala,admin', 'string', 'max:255'],
            'username' => 'required|string|max:255|unique:users,username,' . $this->userId,
            'status' => 'required|in:active,inactive',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($this->userId);
        
        $validatedData['role'] = $this->role;
        $validatedData['id_jabatan'] = $this->id_jabatan;

        if ($validatedData['role'] === 'admin') {
            $validatedData['id_jabatan'] = null;
            $validatedData['jabatan_staf'] = null;
        }

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        $this->dispatch('close-edit-modal');
        session()->flash('message', 'Data user berhasil diupdate!');
        $this->resetInputFields();
    }

    public function confirmDelete($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->deleteId = $user->id;
            $this->deleteName = $user->jabatan;
            $this->dispatch('open-delete-modal');
        }
    }

    public function destroy()
    {
        if ($this->deleteId) {
            $userToDelete = User::find($this->deleteId);
            if ($userToDelete->id === auth()->id()) {
                session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            } elseif ($userToDelete->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
                session()->flash('error', 'Tidak dapat menghapus admin terakhir.');
            } else {
                $userToDelete->delete();
                session()->flash('message', 'Data user berhasil dihapus!');
            }
            $this->dispatch('close-delete-modal');
            $this->reset(['deleteId', 'deleteName']);
        }
    }

    public function resetInputFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function resetFilter()
    {
        $this->filterJabatanId = null;
        $this->filterJabatanName = '';

        return redirect()->route('user-master');
    }

    public function render()
    {
        $this->dispatch('refresh-datatable');
        $adminCount = User::where('role', 'admin')->count();
        $query = User::with('strukturJabatan.dataPd');

        if ($this->filterJabatanId) {
            $query->where('id_jabatan', $this->filterJabatanId);
        }

        $users = $query->get();
        $jabatans = StrukturJabatan::with('dataPd')->get();

        return view('livewire.user-master.user-master-table', [
            'users' => $users,
            'jabatans' => $jabatans,
            'adminCount' => $adminCount,
        ]);
    }
}