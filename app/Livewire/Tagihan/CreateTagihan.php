<?php

namespace App\Livewire\Tagihan;

use App\Models\KhsInduk;
use App\Models\Lov;
use App\Models\SpInduk;
use App\Models\Tagihan;
use App\Models\TagihanHistory;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;


class CreateTagihan extends Component
{
    public $tab = 1;
    public $editId;
    public $desigs = [];
    public $doc;
    public $pejabat;
    public $allDesigs;
    public $desigLokMat = [];

    public $dt = [];

    public function render()
    {
        return view('mods.tagihan.create_tagihan');
    }

    public function mount($data)
    {
        $this->editId = $data['key'];
        $this->doc = Tagihan::dtDokTurnkey();
        $this->setPejabat();
        $this->setDtEdit($data['key']);
        $this->setGudang();
        // dd($this->all());
    }

    public function setDtEdit($id)
    {
        $this->dt['dt_sp'] = SpInduk::whereId($id)
            ->with([
                'master_units',
                'mitras.master_users',
                'khs_induks'
            ])
            ->first()
            ->toArray();
        unset(
            $this->dt['dt_sp']['created_at'],
            $this->dt['dt_sp']['updated_at'],
            $this->dt['dt_sp']['deleted_at'],
            $this->dt['dt_sp']['status_label'],
        );
        $this->dt['dt_sp']['json'] = json_decode($this->dt['dt_sp']['json'],true);
        $this->dt['dt_sp']['original_json'] = json_decode($this->dt['dt_sp']['original_json'],true);
        $this->dt['dt_sp']['khs_induks']['json'] = json_decode($this->dt['dt_sp']['khs_induks']['json'],true);
        $this->dt['dt_sp']['mitras']['master_users']['detail'] = json_decode($this->dt['dt_sp']['mitras']['master_users']['detail'],true);

        for ($i = 0; $i < 8; $i++) {
            $this->dt['dt_tagihan']['dt_turnkey']['rincian'][$i] = 0;
        }
        $this->dt['dt_tagihan']['dt_turnkey']['tgl_turnkey'] = null;
        $this->dt['dt_tagihan']['dt_lokasi'] = $this->dt['dt_sp']['json']['lokasi'];
        $this->dt['dt_tagihan']['dt_gudang'] = [];

        $this->dt['dt_tagihan']['grand_total_material'] = $this->dt['dt_sp']['json']['grand_total_material'];
        $this->dt['dt_tagihan']['grand_total_jasa'] = $this->dt['dt_sp']['json']['grand_total_jasa'];
        $this->dt['dt_tagihan']['grand_total_all'] = $this->dt['dt_sp']['json']['grand_total_all'];
        $this->dt['dt_tagihan']['grand_total_material_rekon'] = $this->dt['dt_sp']['json']['grand_total_material'];
        $this->dt['dt_tagihan']['grand_total_jasa_rekon'] = $this->dt['dt_sp']['json']['grand_total_jasa'];
        $this->dt['dt_tagihan']['grand_total_all_rekon'] = $this->dt['dt_sp']['json']['grand_total_all'];
        $this->dt['dt_tagihan']['grand_total_material_tambah'] = 0;
        $this->dt['dt_tagihan']['grand_total_jasa_tambah'] = 0;
        $this->dt['dt_tagihan']['grand_total_all_tambah'] = 0;
        $this->dt['dt_tagihan']['grand_total_material_kurang'] = 0;
        $this->dt['dt_tagihan']['grand_total_jasa_kurang'] = 0;
        $this->dt['dt_tagihan']['grand_total_all_kurang'] = 0;

        foreach ($this->dt['dt_tagihan']['dt_lokasi'] as $iLok => $vLok) {

            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['total_material_lokasi_rekon'] = $vLok['total_material_lokasi'];
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['total_jasa_lokasi_rekon'] = $vLok['total_jasa_lokasi'];
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['total_lokasi_rekon'] = $vLok['total_lokasi'];
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['total_material_lokasi_tambah'] = 0;
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['total_jasa_lokasi_tambah'] = 0;
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['total_lokasi_tambah'] = 0;
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['total_material_lokasi_kurang'] = 0;
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['total_jasa_lokasi_kurang'] = 0;
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['total_lokasi_kurang'] = 0;

            foreach ($vLok['desig_items'] as $iRow => $vRow) {
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume_rekon'] = $vRow['volume'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume_tambah'] = 0;
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume_kurang'] = 0;
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material_rekon'] = $vRow['total_material'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa_rekon'] = $vRow['total_jasa'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_rekon'] = $vRow['total'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material_tambah'] = 0;
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa_tambah'] = 0;
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_tambah'] = 0;
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material_kurang'] = 0;
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa_kurang'] = 0;
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_kurang'] = 0;

                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['boxmat_rekon'] = 
                    $this->dt['dt_sp']['json']['lokasi'][$iLok]['desig_items'][$iRow]['boxmat'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['boxjas_rekon'] = 
                    $this->dt['dt_sp']['json']['lokasi'][$iLok]['desig_items'][$iRow]['boxjas'];

                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['material_rekon'] = 
                    $this->dt['dt_sp']['json']['lokasi'][$iLok]['desig_items'][$iRow]['material'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['material_b_rekon'] = 
                    $this->dt['dt_sp']['json']['lokasi'][$iLok]['desig_items'][$iRow]['material_b'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['jasa_rekon'] = 
                    $this->dt['dt_sp']['json']['lokasi'][$iLok]['desig_items'][$iRow]['jasa'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['jasa_b_rekon'] = 
                    $this->dt['dt_sp']['json']['lokasi'][$iLok]['desig_items'][$iRow]['jasa_b'];

                $this->dispatch('createsp-initSelect2', data: [
                    'lokasi' => $iLok,
                    'row' => $iRow,
                    'selected' => $vRow['id']
                ]);
            }
        }

        $this->genDesigList();
        
    }

    public function submit()
    {
        $this->validate();

        $dtJson['dt_sp'] = $this->dt['dt_sp'] ;
        $dtJson['dt_tagihan'] = $this->dt['dt_tagihan'] ;
        
        $dt['auth_login_id'] = $this->dt['dt_sp']['auth_login_id'];
        $dt['mitra_id'] = Auth::user()->id;
        $dt['sp_induk_id'] = $this->editId;
        $dt['status'] = 2;
        $dt['json'] = json_encode($dtJson);

        $tagihan = Tagihan::where('sp_induk_id', $this->editId)->get();
        if(count($tagihan) == 0){
            $q = Tagihan::create($dt);
            $tagihanId = $q->id;
            SpInduk::find($this->editId)->update(['status' => 2]);
            session()->flash('message', 'Data Tagihan baru berhasil di buat.');
        }else{
            $tagihanId = $tagihan->first()->id;
            Tagihan::find($tagihanId)->update($dt);
            session()->flash('message', 'Data Tagihan berhasil buat ulang.');
        }
        
        $dtHis['tagihan_id'] = $tagihanId;
        $dtHis['status'] = 2;
        $dtHis['json'] = $dt['json'];
        TagihanHistory::create($dtHis);

        return redirect()->to('/tagihan/mitra/index');
    }

    public function setGudang()
    {
        $this->allDesigs = [];
        $iAllDesig = 0;
        foreach ($this->dt['dt_tagihan']['dt_lokasi'] as $iLok => $vLok) {
            foreach ($vLok['desig_items'] as $iRow => $vRow) {
                if((collect($this->allDesigs))->where('id', $vRow['id'])->count() < 1){
                    $this->allDesigs[$iAllDesig] = $vRow;
                    $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['id'] = $vRow['id'] ;
                    $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['nama'] = $vRow['nama'];
                    $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['nama_material'] = $vRow['nama_material'];
                    $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['nama_jasa'] = $vRow['nama_jasa'];
                    $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['satuan'] = $vRow['satuan'];
                    $iAllDesig++;
                }
            }
        }

        $this->dt['dt_tagihan']['dt_gudang']['pakai'] = [];
        foreach ($this->dt['dt_tagihan']['dt_lokasi'] as $iLok => $vLok) {
            foreach ($this->allDesigs as $iDesMat => $vDesMat) {

                $this->dt['dt_tagihan']['dt_gudang']['pakai']['data'][$iLok][$iDesMat] = 0;
                $count = (collect($vLok['desig_items']))->where('id', $vDesMat['id'])->where('material_b_rekon', '!=', '0')->count();

                if($count > 0){
                    $sum = (collect($vLok['desig_items']))->where('id', $vDesMat['id'])->sum('volume_rekon');
                    $this->dt['dt_tagihan']['dt_gudang']['pakai']['data'][$iLok][$iDesMat] = intval($sum);
                }

            }
        }

        $this->dt['dt_tagihan']['dt_gudang']['ambil']['data'] = [];
        $this->dt['dt_tagihan']['dt_gudang']['ambil']['total'] = [];
        $this->dt['dt_tagihan']['dt_gudang']['kembali']['data'] = [];
        $this->dt['dt_tagihan']['dt_gudang']['kembali']['total'] = [];
        $this->dt['dt_tagihan']['dt_gudang']['kembali']['ket'] = [];

        $this->reTotalPakai(1);
        $this->reTotalAmbil(1);
        $this->reTotalKembali(1);
        $this->reGrandTotalGudang();

        $iDesigMaterial = 0;
        $tempDesig = [];
        $this->dt['dt_tagihan']['dt_gudang']['rekon'] = [];
        foreach ($this->dt['dt_tagihan']['dt_lokasi'] as $iLok => $vLok) {
            foreach ($vLok['desig_items'] as $iDd => $vDd) {
                
                if((collect($tempDesig))->where('id', $vDd['id'])->count() < 1){
                    $dtIndex = (collect($this->allDesigs))->search(function ($item) use($vDd) {
                        return $item['id'] == $vDd['id'];
                    });
                    $tempDesig[] = $vDd;
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['id'] = $vDd['id']; 
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['nama_barang'] = $vDd['nama']; 
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['nama_barang_material'] = $vDd['nama_material']; 
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['nama_barang_alista'] = $vDd['nama']; 
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['nama_barang_material'] = $vDd['nama_material']; 
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['gudang'] = 'Medan'; 
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['satuan'] = $vDd['satuan']; 
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['sum_rekon'] = 
                        $this->dt['dt_tagihan']['dt_gudang']['pakai']['total'][$dtIndex];
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['v_ta'] = 
                        $this->dt['dt_tagihan']['dt_gudang']['pakai']['total'][$dtIndex];
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['v_mitra'] = 0;
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['v_back'] = 
                        $this->dt['dt_tagihan']['dt_gudang']['kembali']['total'][$dtIndex];
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['ket'] = '';
                    $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['ket_matlok'] = '';
                    
                    $iDesigMaterial++;
                }
            }
            
        }
    }

    public function rePemakaian($index, $vType)
    {
        if($vType=='v_mitra'){
            if($this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_mitra'] > 
                $this->dt['dt_tagihan']['dt_gudang']['pakai']['total'][$index]
            ){
                $this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_mitra'] = 
                    $this->dt['dt_tagihan']['dt_gudang']['pakai']['total'][$index];
            }
            if($this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_mitra'] < 0){
                $this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_mitra'] = 0;
            }

            $this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_ta'] =
                $this->dt['dt_tagihan']['dt_gudang']['pakai']['total'][$index] - 
                $this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_mitra'];
        }else{
            if($this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_ta'] > 
                $this->dt['dt_tagihan']['dt_gudang']['pakai']['total'][$index]
            ){
                $this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_ta'] = 
                    $this->dt['dt_tagihan']['dt_gudang']['pakai']['total'][$index];
            }
            if($this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_ta'] < 0){
                $this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_ta'] = 0;
            }
            $this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_mitra'] =
                $this->dt['dt_tagihan']['dt_gudang']['pakai']['total'][$index] - 
                $this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_ta'];
        }
    }

    public function reGrandTotalGudang()
    {
        $this->dt['dt_tagihan']['dt_gudang']['grand_total'] = [];
        foreach ($this->dt['dt_tagihan']['dt_gudang']['ambil']['total'] as $i1 => $v1) {
            $this->dt['dt_tagihan']['dt_gudang']['grand_total'][$i1] = 
                $this->dt['dt_tagihan']['dt_gudang']['ambil']['total'][$i1] -
                $this->dt['dt_tagihan']['dt_gudang']['pakai']['total'][$i1] - 
                $this->dt['dt_tagihan']['dt_gudang']['kembali']['total'][$i1];
        }
    }

    public function reTotalKembali($first=null)
    {
        if(count($this->dt['dt_tagihan']['dt_gudang']['kembali']['data'])>0){
            $data = $this->dt['dt_tagihan']['dt_gudang']['kembali'];
            foreach ($data['data'] as $key1 => $value1) {
                foreach ($value1['nilai'] as $key2 => $value2) {
                    $total[$key2][] = $value2;
                }
            }
    
            foreach ($data['total'] as $key => $value) {
                $this->dt['dt_tagihan']['dt_gudang']['kembali']['total'][$key] = array_sum($total[$key]); 
                $this->dt['dt_tagihan']['dt_gudang']['rekon'][$key]['v_back'] = array_sum($total[$key]);
            }
        }else{
            foreach ($this->allDesigs as $key => $value) {
                $this->dt['dt_tagihan']['dt_gudang']['kembali']['total'][$key] = 0; 
            }
        }

        if(is_null($first)){
            $this->reGrandTotalGudang();
        }
    }
    public function addKetKembali()
    {
        $index = count($this->dt['dt_tagihan']['dt_gudang']['kembali']['ket']);
        $this->dt['dt_tagihan']['dt_gudang']['kembali']['ket'][$index] = "";
    }
    public function delKetKembali($i)
    {
        unset($this->dt['dt_tagihan']['dt_gudang']['kembali']['ket'][$i]);
        $this->dt['dt_tagihan']['dt_gudang']['kembali']['ket'] = array_values($this->dt['dt_tagihan']['dt_gudang']['kembali']['ket']);
    }
    public function addKembali($i)
    {
        $this->dt['dt_tagihan']['dt_gudang']['kembali']['data'][$i]['id_kembali'] = null; 
        $this->dt['dt_tagihan']['dt_gudang']['kembali']['data'][$i]['tgl_rfr'] = null; 
        foreach ($this->allDesigs as $key => $value) {
            $this->dt['dt_tagihan']['dt_gudang']['kembali']['data'][$i]['nilai'][$key] = 0; 
        }
        $this->reTotalKembali();
    }
    public function delKembali($i)
    {
        unset($this->dt['dt_tagihan']['dt_gudang']['kembali']['data'][$i]);
        $this->dt['dt_tagihan']['dt_gudang']['kembali']['data'] = array_values($this->dt['dt_tagihan']['dt_gudang']['kembali']['data']);
        $this->reTotalKembali();
    }

    public function reTotalPakai($first=null)
    {
        $collection = collect($this->dt['dt_tagihan']['dt_gudang']['pakai']['data']);
        $totalPerIndex = [];
        $collection->each(function ($subArray) use (&$totalPerIndex) {
            foreach ($subArray as $index => $value) {
                $totalPerIndex[$index] = isset($totalPerIndex[$index]) ? $totalPerIndex[$index] + $value : $value;
                $this->dt['dt_tagihan']['dt_gudang']['rekon'][$index]['v_ta'] = $totalPerIndex[$index];
            }
        });
        $this->dt['dt_tagihan']['dt_gudang']['pakai']['total'] = $totalPerIndex;
        if(is_null($first)){
            $this->reGrandTotalGudang();
        }
    }

    public function reTotalAmbil($first=null)
    {
        if(count($this->dt['dt_tagihan']['dt_gudang']['ambil']['data'])>0){
            $data = $this->dt['dt_tagihan']['dt_gudang']['ambil'];
            foreach ($data['data'] as $key1 => $value1) {
                foreach ($value1['nilai'] as $key2 => $value2) {
                    $total[$key2][] = $value2;
                }
            }
    
            foreach ($data['total'] as $key => $value) {
                $this->dt['dt_tagihan']['dt_gudang']['ambil']['total'][$key] = array_sum($total[$key]); 
            }
        }else{
            foreach ($this->allDesigs as $key => $value) {
                $this->dt['dt_tagihan']['dt_gudang']['ambil']['total'][$key] = 0; 
            }
        }
        if(is_null($first)){
            $this->reGrandTotalGudang();
        }
    }
    public function addAmbil($i)
    {
        $this->dt['dt_tagihan']['dt_gudang']['ambil']['data'][$i]['no_rfc'] = null; 
        $this->dt['dt_tagihan']['dt_gudang']['ambil']['data'][$i]['tgl_rfc'] = null; 
        foreach ($this->allDesigs as $key => $value) {
            $this->dt['dt_tagihan']['dt_gudang']['ambil']['data'][$i]['nilai'][$key] = 0; 
        }
        $this->reTotalAmbil();
    }
    public function delAmbil($i)
    {
        unset($this->dt['dt_tagihan']['dt_gudang']['ambil']['data'][$i]);
        $this->dt['dt_tagihan']['dt_gudang']['ambil']['data'] = array_values($this->dt['dt_tagihan']['dt_gudang']['ambil']['data']);
        $this->reTotalAmbil();
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

    public function genDesigList()
    {
        $dtKhs = KhsInduk::query()
            ->select(
                'khs_induks.id',
                'khs_induks.no_kontrak',
                'khs_induks.tgl_kontrak',
            )
            ->where('id', $this->dt['dt_sp']['khs_induk_id'])
            ->with([
                "khs_induk_designators",
                "khs_amandemens" => function (Builder $q) {
                    $q->select('id', 'khs_induk_id', 'no_aman', 'tgl_aman')
                        ->orderBy('tgl_aman', "DESC")
                        ->where('tgl_aman', '<=', $this->dt['dt_sp']['tgl_sp'])
                        ->with([ "khs_amandemen_designators"])
                        ->first();
                },
            ])
            ->get()->first();
        $this->desigs = $dtKhs->khs_induk_designators->toArray();
        if (count($dtKhs->khs_amandemens) > 0) {
            $this->desigs = $dtKhs->khs_amandemens->first()->khs_amandemen_designators->toArray();
        }
    }

    public function checkMatJas($iLok, $iRow, $status, $type)
    {
        $label_b = "material_b_rekon";
        $label_box = "boxmat_rekon";
        if ($type == "jasa_rekon") {
            $label_b = "jasa_b_rekon";
            $label_box = "boxjas_rekon";
        }
        if ($status == "") {
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow][$label_b] = 
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow][$type];
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow][$label_box] = "checked";
        } else {
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow][$label_b] = 0;
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow][$label_box] = "";
        }
        $this->reTotal($iLok, $iRow);
    }

    public function reTotal($iLok = null, $iRow = null)
    {
        if (!is_null($iLok)) {
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material'] =
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume'] *
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['material_b'];
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa'] =
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume'] *
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['jasa_b'];
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total'] =
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material'] +
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa'];

            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material_rekon'] =
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume_rekon'] *
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['material_b_rekon'];
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa_rekon'] =
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume_rekon'] *
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['jasa_b_rekon'];
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_rekon'] =
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material_rekon'] +
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa_rekon'];

            if(
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume'] > 
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume_rekon']
            ){
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume_kurang'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume_rekon'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material_kurang'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material_rekon'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa_kurang'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa_rekon'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_kurang'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_rekon'];
            }else if(
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume'] < 
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume_rekon']
            ){
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume_tambah'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume_rekon'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['volume'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material_tambah'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material_rekon'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_material'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa_tambah'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa_rekon'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_jasa'];
                $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_tambah'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total_rekon'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['total'];

            }

        }

        foreach ($this->dt['dt_tagihan']['dt_lokasi'] as $key => $value) {
            $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_material_lokasi'] = (collect($value['desig_items']))->sum('total_material');
            $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_jasa_lokasi'] = (collect($value['desig_items']))->sum('total_jasa');
            $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_lokasi'] = (collect($value['desig_items']))->sum('total');

            $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_material_lokasi_rekon'] = (collect($value['desig_items']))->sum('total_material_rekon');
            $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_jasa_lokasi_rekon'] = (collect($value['desig_items']))->sum('total_jasa_rekon');
            $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_lokasi_rekon'] = (collect($value['desig_items']))->sum('total_rekon');

            if(
                $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_material_lokasi'] > 
                $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_material_lokasi_rekon']
            ){
                $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_material_lokasi_kurang'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_material_lokasi'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_material_lokasi_rekon']; 
                $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_jasa_lokasi_kurang'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_jasa_lokasi'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_jasa_lokasi_rekon']; 
                $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_lokasi_kurang'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_lokasi'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_lokasi_rekon']; 
            }else if(
                $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_material_lokasi'] < 
                $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_material_lokasi_rekon']
            ){
                $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_material_lokasi_tambah'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_material_lokasi_rekon'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_material_lokasi']; 
                $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_jasa_lokasi_tambah'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_jasa_lokasi_rekon'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_jasa_lokasi']; 
                $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_lokasi_tambah'] = 
                    $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_lokasi_rekon'] - 
                    $this->dt['dt_tagihan']['dt_lokasi'][$key]['total_lokasi']; 
            }
        }

        $this->dt['dt_tagihan']['grand_total_material'] = (collect($this->dt['dt_tagihan']['dt_lokasi']))->sum('total_material_lokasi');
        $this->dt['dt_tagihan']['grand_total_jasa'] = (collect($this->dt['dt_tagihan']['dt_lokasi']))->sum('total_jasa_lokasi');
        $this->dt['dt_tagihan']['grand_total_all'] = (collect($this->dt['dt_tagihan']['dt_lokasi']))->sum('total_lokasi');
        $this->dt['dt_tagihan']['grand_total_material_rekon'] = (collect($this->dt['dt_tagihan']['dt_lokasi']))->sum('total_material_lokasi_rekon');
        $this->dt['dt_tagihan']['grand_total_jasa_rekon'] = (collect($this->dt['dt_tagihan']['dt_lokasi']))->sum('total_jasa_lokasi_rekon');
        $this->dt['dt_tagihan']['grand_total_all_rekon'] = (collect($this->dt['dt_tagihan']['dt_lokasi']))->sum('total_lokasi_rekon');

        if(
            $this->dt['dt_tagihan']['grand_total_material'] > 
            $this->dt['dt_tagihan']['grand_total_material_rekon']
        ){
            $this->dt['dt_tagihan']['grand_total_material_kurang'] = 
                $this->dt['dt_tagihan']['grand_total_material'] - 
                $this->dt['dt_tagihan']['grand_total_material_rekon'];
            $this->dt['dt_tagihan']['grand_total_jasa_kurang'] = 
                $this->dt['dt_tagihan']['grand_total_jasa'] - 
                $this->dt['dt_tagihan']['grand_total_jasa_rekon'];
            $this->dt['dt_tagihan']['grand_total_all_kurang'] = 
                $this->dt['dt_tagihan']['grand_total_all'] - 
                $this->dt['dt_tagihan']['grand_total_all_rekon'];
        }else if(
            $this->dt['dt_tagihan']['grand_total_material'] < 
            $this->dt['dt_tagihan']['grand_total_material_rekon']
        ){
            $this->dt['dt_tagihan']['grand_total_material_tambah'] = 
                $this->dt['dt_tagihan']['grand_total_material_rekon'] - 
                $this->dt['dt_tagihan']['grand_total_material'];
            $this->dt['dt_tagihan']['grand_total_jasa_tambah'] = 
                $this->dt['dt_tagihan']['grand_total_jasa_rekon'] - 
                $this->dt['dt_tagihan']['grand_total_jasa'];
            $this->dt['dt_tagihan']['grand_total_all_tambah'] = 
                $this->dt['dt_tagihan']['grand_total_all_rekon'] - 
                $this->dt['dt_tagihan']['grand_total_all'];
        }

        $this->setGudang();
    }

    public function changeTab($tab)
    {
        $this->tab = $tab;
    }

    public function initLoc($iLok)
    {
        $this->dt['dt_tagihan']['dt_lokasi'][$iLok] = [
            'nama_lokasi' => null,
            'nama_sto' => null,
            'total_material_lokasi' => 0,
            'total_jasa_lokasi' => 0,
            'total_lokasi' => 0,
            'total_material_lokasi_rekon' => 0,
            'total_jasa_lokasi_rekon' => 0,
            'total_lokasi_rekon' => 0,
            'desig_items' => []
        ];

        $this->initDesig($iLok, 0);
    }

    public function delLoc($iLok)
    {
        unset($this->dt['dt_tagihan']['dt_lokasi'][$iLok]);
        $this->dt['dt_tagihan']['dt_lokasi'] = array_values($this->dt['dt_tagihan']['dt_lokasi']);
        $this->dispatch('createsp-reselected', data: ['lokasi' => $iLok, 'row' => 0, 'locations' => $this->dt['dt_tagihan']['dt_lokasi'], 'desigs'=> $this->desigs]);
        $this->setGudang();
    }

    public function initDesig($iLok, $iRow)
    {
        $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow] = [
            'id' => null,
            'nama' => null,
            'nama_material' => null,
            'nama_jasa' => null,
            'uraian' => null,
            'satuan' => null,
            'fix_price' => null,

            'volume' => 0,
            'material' => 0,
            'material_b' => 0,
            'jasa' => 0,
            'jasa_b' => 0,
            'boxmat' => "checked disabled",
            'boxjas' => "checked disabled",
            'total_material' => 0,
            'total_jasa' => 0,
            'total' => 0,

            'volume_rekon' => 0,
            'material_rekon' => 0,
            'material_b_rekon' => 0,
            'jasa_rekon' => 0,
            'jasa_b_rekon' => 0,
            'boxmat_rekon' => "checked disabled",
            'boxjas_rekon' => "checked disabled",
            'total_material_rekon' => 0,
            'total_jasa_rekon' => 0,
            'total_rekon' => 0,

        ];

        if ($iRow > 0 || ($iLok > 0)) {
            $this->dispatch('init-select2-after', data: ['lokasi' => $iLok, 'row' => $iRow]);
        }
    }

    public function delDesig($iLok, $iRow)
    {
        unset($this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]);
        $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'] = array_values($this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items']);
        $this->dispatch('createsp-reselected', data: ['lokasi' => $iLok, 'row' => $iRow, 'desigs' => $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items']]);
        $this->setGudang();
    }

    public function rules()
    {
        return [
            "dt.dt_tagihan.tgl_ut" => "required",
            "dt.dt_tagihan.no_ut" => "required",
            "dt.dt_tagihan.tgl_baut" => "required",
            "dt.dt_tagihan.tgl_laut" => "required",
            "dt.dt_tagihan.tgl_mohon" => "required",
            "dt.dt_tagihan.no_mohon" => "required",
            "dt.dt_tagihan.tgl_ba_rekon" => "required",
            "dt.dt_tagihan.tgl_ba_gambar" => "required",
            "dt.dt_tagihan.tgl_turnkey" => "nullable",

            "dt.dt_tagihan.dt_ttd.gm_ta" => "required",
            "dt.dt_tagihan.dt_ttd.mgr_unit" => "required",
            "dt.dt_tagihan.dt_ttd.sm_unit" => "required",
            "dt.dt_tagihan.dt_ttd.mgr_shared" => "required",
            "dt.dt_tagihan.dt_ttd.wapang" => "required",
            "dt.dt_tagihan.dt_ttd.gudang" => "required",

            "dt.dt_tagihan.dt_lokasi.*.nama_lokasi" => "required",
            "dt.dt_tagihan.dt_lokasi.*.nama_sto" => "required",
            "dt.dt_tagihan.dt_lokasi.*.desig_items.*.id" => "required",

        ];
    }

    protected $validationAttributes = [
        "dt.dt_lokasi.*.nama_lokasi" => "Nama Lokasi",
        "dt.dt_lokasi.*.nama_sto" => "Nama STO",
        "dt.dt_lokasi.*.desig_items.*.id" => "Item Designator",

        "dt.dt_tagihan.tgl_ut" => "Tgl UT",
        "dt.dt_tagihan.no_ut" => "No UT",
        "dt.dt_tagihan.tgl_baut" => "Tgl BAUT",
        "dt.dt_tagihan.tgl_laut" => "Tgl LAUT",
        "dt.dt_tagihan.tgl_mohon" => "Tgl Permohonan",
        "dt.dt_tagihan.no_mohon" => "No Permohonan",
        "dt.dt_tagihan.tgl_ba_rekon" => "Tgl BA Rekon",
        "dt.dt_tagihan.tgl_ba_gambar" => "Tgl BA Gambar",

        "dt.dt_tagihan.dt_ttd.gm_ta" => " GM. Telkom Akses ",
        "dt.dt_tagihan.dt_ttd.mgr_unit" => "Mgr. Unit",
        "dt.dt_tagihan.dt_ttd.sm_unit" => " SM. Unit",
        "dt.dt_tagihan.dt_ttd.mgr_shared" => " Mgr. Shared Service",
        "dt.dt_tagihan.dt_ttd.wapang" => "Wapang",
        "dt.dt_tagihan.dt_ttd.gudang" => "Petugas Gudang ",
    ];

    #[On('createsp-initSelect2')]
    public function initSelect2($data)
    {
        $data['desigs'] = $this->desigs;
        $this->dispatch('init-select2', data: $data);
    }

    #[On('createsp-onSelectDesignatorJs')]
    public function onSelectDesignatorJs($param)
    {
        $iLok = intval($param['indexLokasi']);
        $iRow = intval($param['indexRow']);
        $designatorId = intval($param['value']);

        $dtAry = array_values((collect($this->desigs))->where('id', $designatorId)->toArray())[0];

        unset(
            $dtAry['khs_amandemen_id'],
            $dtAry['created_at'],
            $dtAry['updated_at'],
            $dtAry['deleted_at'],
            $dtAry['khs_induk_id'],
        );

        $aryKeys = array_keys($dtAry);
        foreach ($aryKeys as $key => $value) {
            $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow][$value] = $dtAry[$value];
        }

        $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['material_b_rekon'] = $dtAry['material'];
        $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['jasa_b_rekon'] = $dtAry['jasa'];
        $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['boxmat_rekon'] = "checked";
        $this->dt['dt_tagihan']['dt_lokasi'][$iLok]['desig_items'][$iRow]['boxjas_rekon'] = "checked";
        $this->reTotal($iLok, $iRow);
    }
}



