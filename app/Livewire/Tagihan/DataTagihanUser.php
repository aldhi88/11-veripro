<?php

namespace App\Livewire\Tagihan;

use App\Models\KhsInduk;
use App\Models\SpInduk;
use App\Models\Tagihan;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DataTagihanUser extends Component
{
    public function render()
    {
        return view('mods.tagihan.data_tagihan_user');
    }

    public $status;
    public $dtSp;
    public $dtKhs;
    public function mount()
    {
        $this->status = Tagihan::dtStatus();

        $q = Tagihan::select('sp_induk_id')
            ->whereHas('sp_induks', function(Builder $query){
                $query->where('master_unit_id', Auth::user()->master_users->master_unit_id);
            })
            ->get()->toArray();
        $arySpId = array_column($q,'sp_induk_id');
        $this->dtSp = SpInduk::whereIn('id', $arySpId)->get();
        

        $q = ($this->dtSp)->toArray();
        $aryKhsId = array_column($q,'khs_induk_id');
        $this->dtKhs = KhsInduk::where('id', $aryKhsId)->get();
    }
}
