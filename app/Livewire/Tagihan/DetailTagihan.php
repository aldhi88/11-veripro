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
        $this->his =(TagihanHistory::where('tagihan_id',$data['key'])
            ->orderBy('created_at', 'asc')
            ->get())
            ->map(function ($item) {
                $item['json'] = json_decode($item['json'],true);
                // $item['dt_sp']['json_sp'] = json_decode($item['dt_sp']['json_sp'],true);
                return $item;
            })
            ->toArray();
        $this->his = collect($this->his)->map(function($item){
            $item['json']['dt_sp']['json_sp'] = json_decode($item['json']['dt_sp']['json_sp'],true);
            return $item;
        })->toArray();
        $this->status = TagihanHistory::dtStatus();
        // dd($this->all());
    }
}
