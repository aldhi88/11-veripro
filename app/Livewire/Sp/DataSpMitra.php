<?php

namespace App\Livewire\Sp;

use App\Models\AuthLogin;
use App\Models\SpInduk;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DataSpMitra extends Component
{
    public function render()
    {
        return view('mods.sp.data_sp_mitra');
    }

    public $dtMitras;
    public $dtStatus;
    public function mount()
    {
        $this->dtStatus = SpInduk::dtStatus();

        $this->dtMitras = AuthLogin::query()
            ->select(
                "auth_logins.*",
                DB::raw("DATE_FORMAT(auth_logins.created_at, '%d/%m/%Y') as created_at_id"),
            )
            ->with([
                'master_users',
            ])
            ->whereHas('master_users', function($q){
                $q->where('auth_role_id', 4);
            })
            ->where('status', 1)
            ->get();
    }
}