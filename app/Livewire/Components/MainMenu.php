<?php

namespace App\Livewire\Components;

use App\Models\AuthLogin;
use App\Models\Lov;
use App\Models\SpInduk;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class MainMenu extends Component
{
    public $newMitra;
    public $dtToc;
    public function render()
    {
        return view('components.layouts.menu');
    }

    #[On('mainmenu-mount')]
    public function mount()
    {
        $this->getToc();
        $this->newMitra = AuthLogin::where('status',0)
            ->whereHas('master_users', function($q){
                $q->where('auth_role_id', 4);
            })
            ->get()->count();
    }

    public function getToc()
    {
        $q = SpInduk::query()
            ->select('tgl_sp','tgl_toc')
            ->where('status',2)
            ->get();

        foreach ($q as $key => $value) {
            $tocStatus[] = Lov::checkToc($value);
        }

        $this->dtToc = collect($tocStatus)->where('class','!=','success')->count();
    }
}
