<?php

namespace App\Livewire\Auth;

use App\Models\AuthLogin;
use App\Models\AuthRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Rule;

class FormLogin extends Component
{
    public $roles = [];

    #[Rule('', as:'Login Sebagai')]
    public $auth_role_id;

    #[Rule('required|min:4', as:'ID Login')]
    public $username;

    #[Rule('required|min:5', as:'Kata Sandi')]
    public $password;

    public function render()
    {
        return view('mods.auth.form_login');
    }

    public function mount()
    {
        $this->roles = AuthRole::where('id', '!=', 1)->get();
    }

    public function login()
    {
        $data = $this->validate();
        $data['auth_role_id'] = is_null($data['auth_role_id'])?1:$data['auth_role_id'];

        $q = AuthLogin::query()
            ->where('username', $data['username'])
            ->whereHas('master_users', function($q) use($data){
                $q->where('auth_role_id', $data['auth_role_id']);
            })
            ->get();
            
        if($q->count() == 1){
            if(Hash::check($data['password'], $q[0]['password'])){
                Auth::loginUsingId($q[0]['id']);
                return redirect()->route('anchor');
            }
            session()->flash('message', 'Kata Sandi tidak sesuai.');

        }else{

            session()->flash('message', 'ID Login anda tidak ditemukan');
        }
    }
}
