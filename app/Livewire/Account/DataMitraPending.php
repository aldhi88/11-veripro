<?php

namespace App\Livewire\Account;

use Livewire\Component;

class DataMitraPending extends Component
{
    public $deleteConfirm = false;
    public $data = [];
    
    public function render()
    {
        return view('mods.account.data_mitra_pending');
    }

    public function mount()
    {
        
    }
}
