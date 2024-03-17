<?php

namespace App\Livewire\Tagihan;

use App\Models\Lov;
use App\Models\Tagihan;
use App\Models\TagihanHistory;
use Livewire\Component;
use Livewire\Attributes\On;

class ProsesProTagihan extends Component
{
    public $tab = 0;
    public $dtTagih;
    public $dt;
    public $doc;
    public $pejabat;
    public $trixId;
    public $isAmanPenutup = false;
    public $revisi;


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

        $dt = $this->dtTagih;
        $dt['status'] = 8;
        $dt['json'] = json_encode($this->dt);

        Tagihan::find($this->dtTagih['id'])->update($dt);
        TagihanHistory::create([
            'tagihan_id' => $this->dtTagih['id'],
            'status' => 8,
            'json' => $dt['json']
        ]);

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
        Tagihan::find($this->dtTagih['id'])->update([
            'status' => 6,
            'revisi' => $dt['revisi'],
        ]);
        session()->flash('message', 'Revisi data tagihan sudah berhasil dikirimkan.');
        return redirect()->to('/tagihan/pro/index');
    }

    public function mount($data)
    {
        $this->trixId = 'trix-' . uniqid();
        $this->doc = Tagihan::dtDokTurnkey();
        $this->dtTagih = Tagihan::whereId($data['key'])->first()->toArray();
        $this->dtTagih['json'] = json_decode($this->dtTagih['json'], true);
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
        if($this->dt['dt_tagihan']['grand_total_all'] != $this->dt['dt_tagihan']['grand_total_all_rekon']){
            $this->isAmanPenutup = true;
        }
    }

    public function setPejabat()
    {
        $lov = Lov::select('key', 'value')->get()->toArray();
        foreach ($lov as $key => $value) {
            $lov[$key]['value'] = json_decode($value['value']);
            unset($lov[$key]['status_label']); 
        }

        $this->pejabat['gm_ta'] = array_values((collect($lov))->where('key', 'gm_ta')->toArray())[0];
        $this->pejabat['mgr_konstruksi'] = array_values((collect($lov))->where('key', 'mgr_konstruksi')->toArray())[0];
        $this->pejabat['sm_konstruksi'] = array_values((collect($lov))->where('key', 'sm_konstruksi')->toArray())[0];
        $this->pejabat['mgr_maintenance'] = array_values((collect($lov))->where('key', 'mgr_maintenance')->toArray())[0];
        $this->pejabat['sm_maintenance'] = array_values((collect($lov))->where('key', 'sm_maintenance')->toArray())[0];
        $this->pejabat['mgr_shared'] = array_values((collect($lov))->where('key', 'mgr_shared')->toArray())[0];
        $this->pejabat['wapang'] = array_values((collect($lov))->where('key', 'wapang')->toArray())[0];
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
