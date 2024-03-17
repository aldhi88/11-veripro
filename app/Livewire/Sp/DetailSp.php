<?php

namespace App\Livewire\Sp;

use App\Models\SpAmandemen;
use App\Models\SpInduk;
use App\Models\Tagihan;
use App\Models\TagihanHistory;
use Livewire\Attributes\On;
use Livewire\Component;

class DetailSp extends Component
{
    public function render()
    {
        return view('mods.sp.detail_sp');
    }

    public $param;
    public $spId;
    public $dtSpInduk;
    public $dtJson;
    public $dtAman;
    public $dtJsonAman;
    public $dtJsonOri;

    public function mount($param)
    {
        $this->param = $param;
        $this->spId = $param['key'];
        $this->dtSpInduk = SpInduk::where('id', $this->spId)
            ->with([
                'master_units',
                'khs_induks',
                'mitras.master_users',
                'auth_logins',
            ])
            ->first()
        ;
        $this->dtJson = json_decode($this->dtSpInduk->json, true);
        $this->dtJsonOri = json_decode($this->dtSpInduk->original_json, true);

        // dump($this->dtSpInduk->toArray());
        $this->dtAman = SpAmandemen::where('sp_induk_id', $param['key'])
            ->orderBy('id', 'desc')
            ->orderBy('tgl_sp', 'desc')
            ->with([
                'sp_induks'
            ])
            ->get();
        
        
        // dd($this->dtAman->toArray());
    }

    #[On('detailsp-delete')] 
    public function delete($data)
    {

        SpAmandemen::destroy($data['id']);
        $dtAman = SpAmandemen::where('sp_induk_id', $this->spId)
            ->orderBy('tgl_sp', 'desc')
            ->get();

        if($dtAman->count() > 0){
            $newJson = $dtAman[0]->json;
        }else{
            $newJson = SpInduk::select('original_json')
                ->where('id', $this->spId)
                ->first()
                ->getAttribute('original_json');
        }

        $qUpSpInduk = SpInduk::whereId($this->spId)
            ->with([
                'master_units',
                'mitras.master_users',
                'khs_induks'
            ])
            ->first();
        $qUpSpInduk->update(['json' => $newJson]);

        if($this->dtSpInduk->status > 1){

            $tagihan = Tagihan::where('sp_induk_id', $this->spId)->first()->toArray();
            $tagihan['status'] = 1;
            $tagihanId = $tagihan['id'];
            unset(
                $tagihan['created_at'],
                $tagihan['updated_at'],
                $tagihan['deleted_at'],
                $tagihan['status_label'],
                $tagihan['status_desc'],
                $tagihan['id'],
            );
            $tagihan['json'] = json_decode($tagihan['json'], true);
            $tagihan['json']['json_sp'] = SpInduk::query()
                ->where('id', $this->spId)
                ->with([
                    'mitras.master_users',
                    'khs_induks.khs_amandemens',
                    'master_units',
                ])
                ->get()->first()->toArray();
            $tagihan['json']['json_sp']['json'] = json_decode($tagihan['json']['json_sp']['json'], true);
            $tagihan['json'] = json_encode($tagihan['json']);
            Tagihan::find($tagihanId)->update($tagihan);

            $dtTagihan['tagihan_id'] = $tagihanId;
            $dtTagihan['status'] = 1;
            $dtTagihan['json'] = $tagihan['json'];
            TagihanHistory::create($dtTagihan);
        }

        $this->dispatch('alert', data:['type' => 'success',  'message' => 'SP '.$data['attr'].' telah berhasil dihapus']);
        $this->mount($this->param);
    }

}
