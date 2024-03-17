<?php

namespace App\Livewire\Account;

use App\Models\AuthRole;
use App\Models\MasterUnit;
use Livewire\Component;

class DataAccount extends Component
{
    public $role;
    public $units;
    public $deleteConfirm = false;
    public $data = [];
    
    public function render()
    {
        return view('mods.account.data_account');
    }

    public function mount()
    {
        $this->role = AuthRole::query()
            ->where('id', '!=', 4)
            ->get();

        $this->units = MasterUnit::all();
    }

}
