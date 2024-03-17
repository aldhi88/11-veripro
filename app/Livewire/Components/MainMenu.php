<?php

namespace App\Livewire\Components;

use App\Models\AuthLogin;
use Livewire\Attributes\On;
use Livewire\Component;

class MainMenu extends Component
{
    public $newMitra;
    public function render()
    {
        return view('components.layouts.menu');
    }

    #[On('mainmenu-mount')] 
    public function mount()
    {
        $this->newMitra = AuthLogin::where('status',0)
            ->whereHas('master_users', function($q){
                $q->where('auth_role_id', 4);
            })
            ->get()->count();
    }
}
