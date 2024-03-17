<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ModalPassword extends Component
{
    #[Rule('required|min:5', as:'Validasi Kata Sandi')]
    public $password;
    public $data = [];

    public function render()
    {
        return view('components.modal.modal_password');
    }

    #[On('modalpassword-prepare')] 
    public function prepare($data)
    {
        $this->data = $data;
        $this->reset('password');

    }

    public function process()
    {
        $form = $this->validate();
        
        if(Hash::check($form['password'], Auth::user()->password)){
            $this->dispatch($this->data['callback'], data:$this->data);
            $this->dispatch('closeModal',id:'modalPassword');
        }else{
            $this->addError('password', 'Sandi login anda salah');
        }
    }
    
}
