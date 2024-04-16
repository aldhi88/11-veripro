<?php

namespace App\Livewire\Sp;

use App\Models\SpAmandemen;
use App\Models\SpInduk;
use App\Models\Tagihan;
use Livewire\Attributes\On;
use Livewire\Component;

class DetailSp extends Component
{
    public $activeTab = 'induk';
    public $dtAman = [];
    public $dtInduk = [];
    public $dtSp = [];
    public $allowEditDelete = false;
    public $param;

    public function mount($param)
    {
        $this->param = $param;
        $spIndukId = $param['key'];
        
        $this->dtInduk = SpInduk::where('id',$spIndukId)
            ->with([
                'khs_induks.auth_logins.master_users',
                'khs_amandemens',
                'master_units'
            ])
            ->first()
            ->toArray();

        $this->dtAman = SpAmandemen::where('sp_induk_id', $spIndukId)
            ->with([
                'sp_induks.khs_induks.auth_logins.master_users',
                'sp_induks.khs_amandemens',
                'master_units'
            ])
            ->get()
            ->toArray();
        $this->changeTab('induk','');
    }

    public function changeTab($tab, $id)
    {
        $this->activeTab = $tab.$id;
        

        if($this->activeTab=='induk'){
            $this->dtSp = $this->dtInduk;
        }else{
            // dd($this->activeTab, strstr($this->activeTab, 'abu'));
            $this->allowEditDelete = SpAmandemen::allowEditDelete($id);

            $this->dtSp = collect($this->dtAman)->where('id', $id)->first();
            $this->dtSp['khs_induks'] = $this->dtSp['sp_induks']['khs_induks'];
            $this->dtSp['khs_amandemens'] = $this->dtSp['sp_induks']['khs_amandemens'];
            unset($this->dtSp['sp_induks']);
        }
        $this->dtSp['json'] = json_decode($this->dtSp['json'],true);
    }

    #[On('detailsp-delete')] 
    public function delete($data)
    {
        $q = SpAmandemen::where('id', $data['id'])->first();
        $q->delete();

        $spIndukId = $q->sp_induk_id;

        // $spIndukId = SpAmandemen::select('sp_induk_id')
        //     ->where('id',$data['id'])
        //     ->first()
        //     ->getAttribute('sp_induk_id');

        $q = SpAmandemen::where('sp_induk_id', $spIndukId)
            ->orderBy('tgl_sp', 'desc')
            ->get();

        if(count($q)>0){
            $json = $q[0]['json'];
        }else{
            $json = SpInduk::select('json_sp')
                ->where('id',$spIndukId)
                ->first()
                ->getAttribute('json_sp');
        }

        SpInduk::find($spIndukId)->update(['json' => $json]);

        $qTagihan = Tagihan::where('sp_induk_id', $spIndukId);
        $cekTagihan = $qTagihan;
        $countTagihan = $cekTagihan->get()->count();

        if($countTagihan != 0){
            $qTagihan->first();
            $qTagihan->update(['status' => 1]);
            $tagihanId = $qTagihan->id;
            $tagihanJson = $qTagihan->json;

            TagihanHistory::create([
                'tagihan_id' => $tagihanId,
                'status' => 1,
                'json' => $tagihanJson,
            ]);
        }

        $this->dispatch('alert', data:['type' => 'success',  'message' => 'SP '.$data['attr'].' telah berhasil dihapus']);
        $this->changeTab('induk','');
        $param = $this->param;
        $this->reset();
        $this->mount($param);
    }

    public function render()
    {
        return view('mods.sp.detail_sp');
    }
}
