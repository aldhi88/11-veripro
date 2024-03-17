<?php

namespace App\Livewire\Account;

use App\Models\AuthLogin;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ChangePassMitra extends Component
{
    public $editId;
    public $username;
    #[Rule('required|min:5', as:'Sandi Login')]
    public $password;

    public function render()
    {
        return view('mods.account.change_pass_mitra');
    }

    public function mount($data)
    {
        $this->editId = $data['key'];

        $dtEdit = AuthLogin::where('id', $data['key'])
            ->with([
                'master_users.auth_roles',
                'master_users.master_units'
            ])
            ->get()
            ->first()
        ;

        $this->username = $dtEdit->username;
    }

    public function submit()
    {
        $form = $this->validate();
        $dtAuthLogin['password'] = Hash::make($form['password']);
        AuthLogin::find($this->editId)->update($dtAuthLogin);

        $this->dispatch('alert', data:['type' => 'success',  'message' => 'Perubahan data akun sudah disimpan']);
        $this->reset('password');

    }


}
