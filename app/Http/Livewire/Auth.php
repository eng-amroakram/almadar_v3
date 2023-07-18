<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Auth extends Component
{
    protected $listeners = [
        'refreshCheckboxes' => '$refresh',
        'login' => 'login',
        'register' => 'register',
        'logout' => 'logout',
    ];

    //Login
    public $email_phone_login = '';
    public $password_login = '';

    //Register
    public $name_register = "";
    public $email_register = "";
    public $password_register = "";
    public $phone_register = "";

    public function render()
    {
        return view('livewire.auth');
    }

    public function login()
    {
        $data = $this->validate([
            'email_phone_login' => ['required'],
            'password_login' => ['required'],
        ]);

        $user = User::where('phone', $data['email_phone_login'])->first();

        if (!$user) {
            $user = User::where('email', $data['email_phone_login'])->first();
        }

        if (!$user) {
            $this->emit('update_email_phone_login', 'رقم الهاتف غير موجود');
            return false;
        }

        if ($user) {
            if (Hash::check($data['password_login'], $user->password)) {
                FacadesAuth::login($user);
                return redirect()->route('index');
            }

            $this->emit('update_password_login', 'كلمة المرور خاطئة');
            return false;
        }
    }

    public function register()
    {
        $data = $this->validate([
            'name_register' => ['required', 'string'],
            'email_register' => ['required', 'string', 'email'],
            'password_register' => ['required'],
            'phone_register' => ['required'],
        ]);

        User::create([
            'name' => $data['name_register'],
            'phone' =>  $data['phone_register'],
            'email' => $data['email_register'],
            'password' => Hash::make($data['password_register']),
            'user_status' => 'inactive',
            'email_verified_at' => now(),
            'user_type' => 'marketer',
            'verification_code' => null,
            'created_at' => now(),
            'permissions' => json_encode(config('permissions.false')),
        ]);
    }

    public function logout()
    {
        $user = auth()->user();
        if ($user) {
            FacadesAuth::logout($user);
            return redirect()->route('index');
        }
    }
}
