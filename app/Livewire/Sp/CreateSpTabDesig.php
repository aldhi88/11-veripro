<?php

namespace App\Livewire\Sp;

use Livewire\Attributes\On;
use Livewire\Component;

class CreateSpTabDesig extends Component
{

    public function mount()
    {
        // dd(session('tab_data'));
    }

    public function render()
    {
        return view('mods.sp.create_sp_tab_desig');
    }
}
