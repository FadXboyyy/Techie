<?php


namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
            'remember' => $this->remember,
        ];

        $this->emit('loginAttempt', $credentials);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
