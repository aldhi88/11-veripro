<?php

namespace App\Livewire\Tagihan;

use App\Models\TagihanHistory;
use Livewire\Attributes\On;
use Livewire\Component;

class DetailStatusTagihan extends Component
{
    public $dtDetails = [];
    public $dtAwal = [];

    public function render()
    {
        return view('mods.tagihan.detail_status_tagihan');
    }

    #[On('detaistatustagihan-prepare')] 
    public function prepare($id)
    {
        $this->dtDetails = TagihanHistory::where('tagihan_id', $id)
            ->orderBy('created_at', 'asc')
            ->with([
                'tagihans.auth_logins.master_users',
                'tagihans.sp_induks.auth_logins.master_users',
            ])
            ->get();
        
        $this->dtAwal = $this->dtDetails->toArray()[0];
           
    }

}