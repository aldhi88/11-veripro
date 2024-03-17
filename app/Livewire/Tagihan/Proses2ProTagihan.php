<?php

namespace App\Livewire\Tagihan;

use App\Models\Lov;
use App\Models\SpInduk;
use App\Models\Tagihan;
use App\Models\TagihanHistory;
use Livewire\Component;
use Livewire\Attributes\On;

class Proses2ProTagihan extends Component
{
    public $tab = 7;
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
            "dt.dt_tagihan.no_bayar" => "required",
            "dt.dt_tagihan.tgl_bayar" => "required",
            "dt.dt_tagihan.no_invoice" => "required",
            "dt.dt_tagihan.tgl_invoice" => "required",
            "dt.dt_tagihan.no_kwitansi" => "required",
            "dt.dt_tagihan.tgl_kwitansi" => "required",
        ];
    }

    protected $validationAttributes = [
        "dt.dt_tagihan.no_bayar" => "No.Bayar",
        "dt.dt_tagihan.tgl_bayar" => "Tgl.Bayar",
        "dt.dt_tagihan.no_invoice" => "No.Invoice",
        "dt.dt_tagihan.tgl_invoice" => "Tgl.Invoice",
        "dt.dt_tagihan.no_kwitansi" => "No.Kwitansi",
        "dt.dt_tagihan.tgl_kwitansi" => "Tgl.Kwitansi",

    ];

    #[On('prosesprotagihan-submit')] 
    public function submit()
    {
        $this->validate();

        $dt = $this->dtTagih;
        $dt['status'] = 12;
        $dt['json'] = json_encode($this->dt);

        Tagihan::find($this->dtTagih['id'])->update($dt);
        TagihanHistory::create([
            'tagihan_id' => $this->dtTagih['id'],
            'status' => 12,
            'json' => $dt['json']
        ]);
        SpInduk::find($this->dtTagih['sp_induk_id'])->update(['status'=>3]);

        session()->flash('message', 'Data Tagihan Tahap 2 sudah berhasil di kirim.');
        return redirect()->to('/tagihan/pro/index');
    }

    #[On('prosesprotagihan-revisi')] 
    public function revisi()
    {
        $dt['json'] = json_encode($this->dtTagih['json']);
        $dt['revisi'] = $this->dtTagih['revisi'];
        $dt['tagihan_id'] = $this->dtTagih['id'];
        $dt['status'] = 10;

        TagihanHistory::create($dt);
        Tagihan::find($this->dtTagih['id'])->update([
            'status' => 10,
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
        return view('mods.tagihan.proses2_pro_tagihan');
    }
}
