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

        TagihanHistory::create($dt);
        Tagihan::find($this->dtTagih['id'])->update([
            'status' => 3,
            'revisi' => $dt['revisi'],
        ]);
        session()->flash('message', 'Revisi data tagihan sudah berhasil dikirimkan.');
        return redirect()->to('/tagihan/user/index');
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
        return view('mods.tagihan.proses_user_tagihan');
    }
}
