<?php

namespace App\Livewire\Account;

use App\Models\AuthLogin;
use App\Models\MasterUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyAccount extends Component
{
    use WithFileUploads;

    public $account = [];
    public $username;
    #[Rule('', as:'Nama Pengguna')]
    public $nama;
    public $role;
    #[Rule('', as:'Foto')]
    public $photo;
    public $oldPhoto;
    public $detail = [];
    public $tabActive = 'info';
    public $newPass;
    public $newPass_confirmation;
    public $dtFormPass = [];

    protected $validationAttributes = [
        'photo' => 'Foto Baru'
    ];

    public function render()
    {
        return view('mods.account.my_account');
    }

    public function mount()
    {
        $this->account = Auth::user();
        $this->username = Auth::user()->username;
        $this->nama = Auth::user()->master_users->nama;
        $this->role = Auth::user()->master_users->auth_roles->name;
        if (is_null(Auth::user()->master_users->photo)) {
            $this->oldPhoto = asset('assets/images/users/default.png');
        }else{
            $this->oldPhoto = asset('storage/'.Auth::user()->master_users->photo);
        }
        $this->detail = json_decode(Auth::user()->master_users->detail);
        $this->newPass = null;
        $this->newPass_confirmation = null;
    }

    public function changeTab($tab)
    {
        $this->tabActive = $tab;
    }

    public function default()
    {
        $this->mount();
    }

    public $isPasswordConfirm = false;
    public $data;

    #[On('editaccount-updateInfo')] 
    public function updateInfo($data=null)
    {
        $this->data = $data;

        $form = $this->validate([ 
            'nama' => 'required|min:4',
            'photo' => "nullable|mimes:jpeg,png|max:1024",
        ]);

        if(!$this->isPasswordConfirm){
            $data['msg'] = 'merubah informasi akun';
            $data['attr'] = Auth::user()->username;
            $data['id'] = Auth::user()->id;
            $data['callback'] = "editaccount-updateInfo";
            $this->dispatch('showModal',id:'modalPassword');
            $this->dispatch('modalpassword-prepare', data:$data);
            $this->isPasswordConfirm = true;
        }else{
            if (!is_null($form['photo'])) {

                if(!is_null(Auth::user()->master_users->photo)){
                    unlink(storage_path('app/public/'.Auth::user()->master_users->photo));
                }
                
                $fileName = $this->photo->store('public/image/account');
                $form['photo'] = str_replace("public/","", $fileName);
                $this->oldPhoto = asset('storage/'.$form['photo']);
    
            }else{
                unset($form['photo']);
            }

            MasterUser::where('auth_login_id', Auth::user()->id)
                ->update($form);
            $this->dispatch('alert', data:['type' => 'success',  'message' => 'Informasi Akun sudah diperbaharui']);
            $this->dispatch('topmenu-mount');
            $this->reset('isPasswordConfirm');
        }

        
    }

    public function changePassConfirm()
    {
        

        $this->dtFormPass = $form;

        $this->dispatch('modalpassword-prepare',data:
            [
                'id' => 'modalPassword', 
                'desc' => 'perubahan sandi login',
                'callback' => 'editaccount-changepass'
            ]);
    }

    #[On('editaccount-changePass')] 
    public function changePass()
    {
        $form = $this->validate([ 
            'newPass' => 'required|confirmed|min:5',
            'newPass_confirmation' => 'required|min:5',
        ]);

        if(!$this->isPasswordConfirm){

            $data['msg'] = 'merubah sandi login anda';
            $data['attr'] = Auth::user()->username;
            $data['id'] = Auth::user()->id;
            $data['callback'] = "editaccount-changePass";

            $this->dispatch('showModal',id:'modalPassword');
            $this->dispatch('modalpassword-prepare', data:$data);
            $this->isPasswordConfirm = true;
        }else{
            AuthLogin::find(Auth::user()->id)
                ->update(['password' => Hash::make($form['newPass'])]);

            $this->dispatch('alert', data:['type' => 'success',  'message' => 'Sandi login sudah diperbaharui']);
            // $this->isPasswordConfirm = false;
            $this->reset('isPasswordConfirm');
            $this->reset('newPass');
            $this->reset('newPass_confirmation');
        }
    }
}
