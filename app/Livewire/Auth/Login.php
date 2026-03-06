<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.auth')]
class Login extends Component
{
    public $username = '';
    public $password = '';

    protected $rules = [
        'username' => 'required',
        'password' => 'required'
    ];

    protected $messages = [
        'username.required' => 'Username wajib diisi',
        'password.required' => 'Password wajib diisi',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt([
            'username' => $this->username,
            'password' => $this->password,
            'status' => 'active'
        ])) {
            session()->regenerate();
            return redirect()->route('dashboard');
        }

        $this->addError('username', 'Username atau password salah');
        $this->password = '';
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
