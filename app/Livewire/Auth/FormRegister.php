<?php

namespace App\Livewire\Auth;

use App\Models\AuthLogin;
use App\Models\MasterUser;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class FormRegister extends Component
{
    #[Rule('', as:'ID Login')]
    public $username;
    #[Rule('', as:'Sandi Login')]
    public $password;
    #[Rule('', as:'Konfirmasi Sandi Login')]
    public $password_confirmation;
    #[Rule('required', as:'Nama Admin')]
    public $nama;

    #[Rule('', as:'Nama Perusahaan')]
    public $perusahaan;
    #[Rule('', as:'Nama Direktur')]
    public $direktur;
    #[Rule('', as:'Nomor Telepon')]
    public $telepon;
    #[Rule('', as:'Alamat Email')]
    public $email;
    #[Rule('', as:'Lokasi Oprasional')]
    public $lokasi;
    #[Rule('', as:'Alamat Perusahaan')]
    public $alamat;
    
    public function render()
    {
        return view('mods.auth.form_register');
    }

    public function register()
    {
        // $form = $this->validate();
        $form = $this->validate([ 
            'username' => 'required|min:4',
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required|min:5',

            'nama' => 'required',
            'perusahaan' => 'required',
            'direktur' => 'required',
            'telepon' => 'required',
            'lokasi' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
        ]);

        $cek = AuthLogin::query()
            ->where('username', $form['username'])
            ->whereHas('master_users', function($q) use($form){
                $q->where('auth_role_id', 4);
            })
            ->get()->count();

        if($cek > 0){
            $this->addError('username', 'ID Pengguna ini sudah digunakan oleh mitra lain, silahkan ganti.');
        }else{

            $dtAuthLogin = $this->only(['username', 'password']);
            $dtAuthLogin['password'] = Hash::make($dtAuthLogin['password']);
            $dtAuthLogin['status'] = 0;
            $q = AuthLogin::create($dtAuthLogin);
            $authLoginId = $q->id;
    
            $dtMasterUser['auth_login_id'] = $authLoginId;
            $dtMasterUser['auth_role_id'] = 4;
            $dtMasterUser['master_unit_id'] = 1;
            $dtMasterUser['nama'] = $form['nama'];
            $dtMasterUser['detail'] = json_encode([
                'perusahaan' => $form['perusahaan'],
                'direktur' => $form['direktur'],
                'lokasi' => $form['lokasi'],
                'alamat' => $form['alamat'],
                'telepon' => $form['telepon'],
                'email' => $form['email'],
            ]);
            MasterUser::create($dtMasterUser);
    
            session()->flash('status', 'success');
            session()->flash('msg', 'Proses registrasi anda sudah berhasil, silahkan konfirmasi ke bagian admin untuk aktivasi akun anda.');
            $this->reset();

        }


    }
}
