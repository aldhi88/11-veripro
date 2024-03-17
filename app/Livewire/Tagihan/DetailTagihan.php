<?php

namespace App\Livewire\Tagihan;

use App\Models\TagihanHistory;
use Livewire\Component;

class DetailTagihan extends Component
{
    public function render()
    {
        return view('mods.tagihan.detail_tagihan');
    }

    public $his = [];
    public $status;
    public function mount($data)
    {
        $this->his = TagihanHistory::where('tagihan_id',$data['key'])
            ->orderBy('created_at', 'asc')
            ->get()
            ->toArray();
        
        foreach ($this->his as $key => $value) {
            $this->his[$key]['json'] = json_decode($this->his[$key]['json'], true);
        }
        $this->status = TagihanHistory::dtStatus();
        // dd($this->all());
    }
}
