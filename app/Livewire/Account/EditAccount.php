<?php

namespace App\Livewire\Account;

use App\Models\AuthLogin;
use App\Models\AuthRole;
use App\Models\MasterUnit;
use App\Models\MasterUser;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;


class EditAccount extends Component
{
    public $id;

    public $roles = [];
    #[Rule('required')]
    public $auth_role_id;
    
    public $units = [];
    #[Rule('required')]
    public $master_unit_id;

    #[Rule('required')]
    public $username;
    #[Rule('nullable|min:5', as:'Sandi Login')]
    public $password;

    public function render()
    {
        return view('mods.account.edit_account');
    }

    public function mount($data)
    {
        $this->id = $data['key'];
        $this->roles = AuthRole::query()
            ->where('id', '!=', 4)
            ->get();

        $dtEdit = AuthLogin::where('id', $data['key'])
            ->with([
                'master_users.auth_roles',
                'master_users.master_units'
            ])
            ->get()
            ->first()
        ;

        $this->auth_role_id = $dtEdit->master_users->auth_role_id;
        $this->master_unit_id = $dtEdit->master_users->master_unit_id;
        $this->genMasterUnit($this->auth_role_id);
        $this->username = $dtEdit->username;

        

    }

    public function genMasterUnit($role)
    {
        $q = MasterUnit::query();
        if($role == 1){
            $q->where('id', 1);
        }else if($role == 2){
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
        
        if(!is_null($form['password'])){
            $dtAuthLogin['password'] = Hash::make($form['password']);
            AuthLogin::find($this->id)
                ->update($dtAuthLogin);
        }

        $dtMasterUser = $this->only(['auth_role_id','master_unit_id']);
        MasterUser::where('auth_login_id', $this->id)->update($dtMasterUser);
        $this->dispatch('alert', data:['type' => 'success',  'message' => 'Perubahan data akun sudah disimpan']);

    }



}
