<?php

namespace App\Livewire\Khs;

use App\Models\KhsAmandemen;
use App\Models\KhsAmandemenDesignator;
use App\Models\KhsInduk;
use App\Models\KhsIndukDesignator;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class DetailKhs extends Component
{
    

    public $param;
    public $khsId;
    public $dtAmanCount;
    
    public $activeTab = 'induk_';
    public $dtId;
    public $dtKhsInduk;
    public $dtKhs = [];
    public $dtAman = [];

    public $isAllowEdit;
    public $isAllowDelete;

    public function mount($param)
    {
        $this->param = $param;
        $this->dtId = $param['key'];
        $this->dtKhsInduk = (
                KhsInduk::where('id',$param['key'])
                    ->get()
                )->map(function ($item) {
                        $item['json'] = json_decode($item['json'],true);
                        return $item;
                    }
                )->first()->toArray();   
        
        $this->dtKhs = $this->dtKhsInduk;
    
        $dtAman = KhsAmandemen::where('khs_induk_id',$this->dtId);

        if($dtAman->get()->count() > 0){
            $this->dtAman = ($dtAman->get())
                ->map(function ($item) {
                        $item['json'] = json_decode($item['json'],true);
                        return $item;
                    }
                )->toArray();
        }
    }

    public function changeTab($table, $id)
    {
        $this->activeTab = $table.'_'.$id;
        if($table=='aman'){
            $this->dtKhs = (collect($this->dtAman))->where('id',$id)->first();
            $this->isAllowDelete = KhsAmandemen::isAllowDelete($id);
            $this->isAllowEdit = KhsAmandemen::isAllowEdit($id);
        }else{
            $this->mount($this->param);
        }

        $param['dataId'] = $this->dtKhs['id'];
        if($table=='induk'){
            $param['route'] = route('khs.detailKhsIndukDt');
        }else{
            $param['route'] = route('khs.detailKhsAmanDt');
        }
        $this->dispatch('reloadDt', data: $param);
    }

    #[On('detailkhs-delete')] 
    public function delete($data)
    {
        KhsAmandemen::where('id', $data['id'])->delete();
        KhsAmandemenDesignator::where('khs_amandemen_id', $data['id'])->forceDelete();
        $this->dispatch('alert', data:['type' => 'success',  'message' => 'KHS '.$data['attr'].' telah berhasil dihapus']);
        $this->changeTab('induk',0);
        $param = $this->param;
        $this->reset();
        $this->mount($param);
    }
    
    #[On('detailkhs-changeFixPrice')] 
    public function changeFixPrice($dt)
    {
        $fixPrice = $dt['val']==0?1:0;
        if($dt['table']=="induk"){
            $param['route'] = route('khs.detailKhsIndukDt');
            KhsIndukDesignator::find($dt['id'])->update(["fix_price" => $fixPrice]);
        }else{
            $param['route'] = route('khs.detailKhsAmanDt');
            KhsAmandemenDesignator::find($dt['id'])->update(["fix_price" => $fixPrice]);
        }

        $param['dataId'] = $this->dtKhs['id'];
        $this->dispatch('reloadDt', data: $param);

    }

    public function render()
    {
        return view('mods.khs.detail_khs');
    }
}
