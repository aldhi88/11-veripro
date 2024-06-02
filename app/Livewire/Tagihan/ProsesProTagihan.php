<?php

namespace App\Livewire\Tagihan;

use App\Models\Lov;
use App\Models\Tagihan;
use App\Models\TagihanHistory;
use Livewire\Component;
use Livewire\Attributes\On;

class ProsesProTagihan extends Component
{
    public $tab = -2;
    public $dtTagih;
    public $dt;
    public $doc;
    public $pejabat;
    public $trixId;
    public $isAmanPenutup = false;
    public $revisi;
    public $status;


    public function rules()
    {
        return [
            "dt.dt_tagihan.no_laut" => "required",
            "dt.dt_tagihan.no_bast" => "required",
            "dt.dt_tagihan.tgl_bast" => "required",
            "dt.dt_tagihan.no_baut" => "required",
            "dt.dt_tagihan.no_ba_rekon" => "required",
            "dt.dt_tagihan.no_ba_gambar" => "required",
        ];
    }

    protected $validationAttributes = [
        "dt.dt_tagihan.no_laut" => "No.LAUT",
        "dt.dt_tagihan.no_bast" => "No.BAST",
        "dt.dt_tagihan.tgl_bast" => "Tgl.BAST",
        "dt.dt_tagihan.no_baut" => "No.BAUT",
        "dt.dt_tagihan.no_ba_rekon" => "No.BA Rekon",
        "dt.dt_tagihan.no_ba_gambar" => "No.BA Gambar",
        'dt.dt_tagihan.aman_penutup' => 'No.Amandemen Penutup',

    ];

    #[On('prosesprotagihan-submit')] 
    public function submit()
    {
        $validate = $this->rules();
        if($this->isAmanPenutup){
            $validate['dt.dt_tagihan.aman_penutup'] = 'required';
        }
        $this->validate($validate);

        // $dt = $this->dtTagih;
        $dt['status'] = 8;
        $dt['json'] = json_encode($this->dt);
        Tagihan::find($this->dtTagih['id'])->update($dt);
        
        $dt['tagihan_id'] = $this->dtTagih['id'];
        TagihanHistory::create($dt);

        session()->flash('message', 'Data Tagihan sudah berhasil di disetujui.');
        return redirect()->to('/tagihan/pro/index');
    }

    #[On('prosesprotagihan-revisi')] 
    public function revisi()
    {
        $dt['json'] = json_encode($this->dtTagih['json']);
        $dt['revisi'] = $this->dtTagih['revisi'];
        $dt['tagihan_id'] = $this->dtTagih['id'];
        $dt['status'] = 6;
        TagihanHistory::create($dt);

        $dtRevis['status'] = 6;
        $dtRevis['revisi'] = $dt['revisi'];
        $dtRevis['json'] = $dt['json'];
        Tagihan::find($this->dtTagih['id'])->update($dtRevis);
        session()->flash('message', 'Revisi data tagihan sudah berhasil dikirimkan.');
        return redirect()->to('/tagihan/pro/index');
    }

    public function mount($data)
    {
        $this->trixId = 'trix-' . uniqid();
        $this->doc = Tagihan::dtDokTurnkey();
        $this->dtTagih = Tagihan::whereId($data['key'])->first()->toArray();
        $this->dtTagih['json'] = json_decode($this->dtTagih['json'], true);
        
        unset(
            $this->dtTagih['created_at'],
            $this->dtTagih['updated_at'],
            $this->dtTagih['deleted_at'],
            $this->dtTagih['status_label'],
            $this->dtTagih['status_desc'],
        );
        $this->dt = $this->dtTagih['json'];
        $this->setPejabat();
        if($this->dt['dt_tagihan']['dt_lokasi']['grand_total'] != $this->dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']){
            $this->isAmanPenutup = true;
        }
        $this->status = $this->dtTagih['status'];
        if($this->status<=5){
            $this->dtTagih['revisi'] = "";
        }
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
        return view('mods.tagihan.proses_pro_tagihan');
    }
}
