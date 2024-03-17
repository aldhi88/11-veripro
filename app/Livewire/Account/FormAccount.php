<?php

namespace App\Livewire\Account;

use App\Models\AuthLogin;
use App\Models\AuthRole;
use App\Models\MasterUnit;
use App\Models\MasterUser;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class FormAccount extends Component
{
    public $roles;
    #[Rule('required|min:4', as:'ID Login')]
    public $username;
    #[Rule('required|min:5', as:'Sandi Login')]
    public $password;
    #[Rule('required')]
    public $auth_role_id;
    public $units;
    #[Rule('required')]
    public $master_unit_id;

    public function render()
    {
        return view('mods.account.form_account');
    }

    public function mount()
    {
        $this->roles = AuthRole::query()
            ->where('id', '!=', 4)
            ->get();
        $this->auth_role_id = null;

        $this->units = [];

        $this->username = null;
        $this->password = null;
    }

    public function genMasterUnit($role=null)
    {
        
        $q = MasterUnit::query();
        if($this->auth_role_id == 1){
            $q->where('id', 1);
        }else if($this->auth_role_id == 2){
            $q->where('id', 4);
        }else{
            $q->whereBetween('id', [2, 3]);
        }

        $q = $q->get();

        $this->units = $q;
        
    }

    public function submit()
    {
        $form = $this->validate();
        $dtAuthLogin = $this->only(['username', 'password']);

        $cek = AuthLogin::query()
            ->where('username', $form['username'])
            ->whereHas('master_users', function($q) use($form){
                $q->where('auth_role_id', $form['auth_role_id']);
            })
            ->get()->count();
        
        if($cek > 0){
            $this->dispatch('alert', data:['type' => 'error',  'message' => 'Data akun dengan peran yang sama sudah ada di database']);
        }else{

            $dtAuthLogin['password'] = Hash::make($dtAuthLogin['password']);
            $q = AuthLogin::create($dtAuthLogin);
    
            $userId = $q->id;
    
            $dtMasterUser = $this->only(['auth_role_id','master_unit_id']);
            $dtMasterUser['auth_login_id'] = $userId;
            $dtMasterUser['nama'] = $dtAuthLogin['username'];
            MasterUser::create($dtMasterUser);
            $this->dispatch('alert', data:['type' => 'success',  'message' => 'Data akun baru berhasil ditambahkan']);
        }
        $this->mount();


    }
}
