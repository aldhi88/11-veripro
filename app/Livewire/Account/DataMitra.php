<?php

namespace App\Livewire\Account;

use Livewire\Component;

class DataMitra extends Component
{
    public $deleteConfirm = false;
    public $data = [];
    
    public function render()
    {
        return view('mods.account.data_mitra');
    }

    public function mount()
    {
        
    }
}
