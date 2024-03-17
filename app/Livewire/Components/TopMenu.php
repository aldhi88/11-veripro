<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class TopMenu extends Component
{
    public $photo;

    public function render()
    {
        return view('components.layouts.top_menu');
    }

    #[On('topmenu-mount')] 
    public function mount()
    {
        if (is_null(Auth::user()->master_users->photo)) {
            $this->photo = asset('assets/images/users/default.png');
        }else{
            $this->photo = asset('storage/'.Auth::user()->master_users->photo);
        }
    }
}
