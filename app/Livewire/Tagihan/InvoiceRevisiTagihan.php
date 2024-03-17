<?php

namespace App\Livewire\Tagihan;

use App\Models\Lov;
use App\Models\Tagihan;
use App\Models\TagihanHistory;
use Livewire\Component;

class InvoiceRevisiTagihan extends Component
{
    public $tab = 8;
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

    public function submit()
    {
        $this->validate();

        $dt = $this->dtTagih;
        $dt['status'] = 11;
        $dt['json'] = json_encode($this->dt);

        Tagihan::find($this->dtTagih['id'])->update($dt);
        TagihanHistory::create([
            'tagihan_id' => $this->dtTagih['id'],
            'status' => 11,
            'json' => $dt['json']
        ]);

        session()->flash('message', 'Data Tagihan Tahap 2 sudah berhasil di revisi.');
        return redirect()->to('/tagihan/mitra/index');
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
        return view('mods.tagihan.invoice_revisi_tagihan');
    }
}
