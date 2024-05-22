<?php

namespace App\Livewire\Tagihan;

use App\Models\Lov;
use App\Models\Tagihan;
use App\Models\TagihanHistory;
use Livewire\Component;
use Livewire\Attributes\On;

class ProsesUserTagihan extends Component
{
    public $tab = 1;
    public $dtTagih;
    public $dt;
    public $doc;
    public $pejabat;
    public $trixId;


    public function rules()
    {
        return [
            "dt.dt_tagihan.no_nodin" => "required",
            "dt.dt_tagihan.tgl_nodin" => "required",
        ];
    }

    protected $validationAttributes = [
        "dt.dt_tagihan.no_nodin" => "No. Nota Dinas",
        "dt.dt_tagihan.no_nodin" => "Tgl. Nota Dinas",
    ];

    #[On('prosesusertagihan-submit')] 
    public function submit()
    {
        $this->validate();
        $dt = $this->dtTagih;
        $dt['status'] = 5;
        $dt['json'] = json_encode($this->dt);
        Tagihan::find($this->dtTagih['id'])->update($dt);
        TagihanHistory::create([
            'tagihan_id' => $this->dtTagih['id'],
            'status' => 5,
            'json' => $dt['json']
        ]);

        session()->flash('message', 'Data Tagihan sudah berhasil di disetujui.');
        return redirect()->to('/tagihan/user/index');
    }

    #[On('prosesusertagihan-revisi')] 
    public function revisi()
    {
        $dt['json'] = json_encode($this->dtTagih['json']);
        $dt['revisi'] = $this->dtTagih['revisi'];
        $dt['tagihan_id'] = $this->dtTagih['id'];
        $dt['status'] = 3;

        $dtRevis['status'] = 3;
        $dtRevis['revisi'] = $dt['revisi'];
        $dtRevis['json'] = $dt['json'];
        TagihanHistory::create($dt);
        Tagihan::find($this->dtTagih['id'])->update($dtRevis);
        session()->flash('message', 'Revisi data tagihan sudah berhasil dikirimkan.');
        return redirect()->to('/tagihan/user/index');
    }

    public function mount($data)
    {
        
        $this->trixId = 'trix-' . uniqid();
        $this->doc = Tagihan::dtDokTurnkey();
        $this->dtTagih = Tagihan::whereId($data['key'])->first()->toArray();
        $this->dtTagih['json'] = json_decode($this->dtTagih['json'], true);
        $this->dtTagih['json']['dt_tagihan']['no_nodin'] = "";
        $this->dtTagih['json']['dt_tagihan']['tgl_nodin'] = "";
        $this->dtTagih['revisi'] = "";
        unset(
            $this->dtTagih['created_at'],
            $this->dtTagih['updated_at'],
            $this->dtTagih['deleted_at'],
            $this->dtTagih['status_label'],
            $this->dtTagih['status_desc'],
        );
        $this->dt = $this->dtTagih['json'];
        $this->setPejabat();
        // dd($this->all());
    }

    public function setPejabat()
    {
        $lov = Lov::select('key', 'value')->get()->toArray();

        $this->pejabat['gm_ta'] = array_values((collect($lov))->where('key', 'gm_ta')->toArray())[0];
        $this->pejabat['mgr_osp-fo'] = array_values((collect($lov))->where('key', 'mgr_osp-fo')->toArray())[0];
        $this->pejabat['sm_osp-fo'] = array_values((collect($lov))->where('key', 'sm_osp-fo')->toArray())[0];
        $this->pejabat['mgr_qe'] = array_values((collect($lov))->where('key', 'mgr_qe')->toArray())[0];
        $this->pejabat['sm_qe'] = array_values((collect($lov))->where('key', 'sm_qe')->toArray())[0];
        $this->pejabat['mgr_shared'] = array_values((collect($lov))->where('key', 'mgr_shared')->toArray())[0];
        $this->pejabat['waspang'] = array_values((collect($lov))->where('key', 'waspang')->toArray())[0];
        $this->pejabat['gudang'] = array_values((collect($lov))->where('key', 'gudang')->toArray())[0];
    }
    
    public function changeTab($i)
    {
        $this->tab = $i;
    }

    public function render()
    {
        return view('mods.tagihan.proses_user_tagihan');
    }
}
