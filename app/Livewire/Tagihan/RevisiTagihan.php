<?php

namespace App\Livewire\Tagihan;

use App\Imports\LokasiRekonImport;
use App\Models\Lov;
use App\Models\Tagihan;
use App\Models\TagihanHistory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class RevisiTagihan extends Component
{

    use WithFileUploads;

    public $tab = 0;
    public $editId;
    public $desigs = [];
    public $doc;
    public $pejabat;
    public $allDesigs;
    public $desigLokMat = [];

    public $dt = [];

    public $formUpload = [];
    public $dtLok = [];
    public $dtError = [];
    public $dtEdit = [];
    public $revisiClass = 'danger';
    public $status;



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

            "dt.dt_tagihan.dt_ttd.gm_ta_pejabat" => "required",
            "dt.dt_tagihan.dt_ttd.mgr_unit_pejabat" => "required",
            "dt.dt_tagihan.dt_ttd.sm_unit_pejabat" => "required",
            "dt.dt_tagihan.dt_ttd.mgr_shared_pejabat" => "required",
            "dt.dt_tagihan.dt_ttd.waspang_pejabat" => "required",
            "dt.dt_tagihan.dt_ttd.gudang_pejabat" => "required",
            "dt.dt_tagihan.dt_ttd.gm_ta_jabatan" => "required",
            "dt.dt_tagihan.dt_ttd.mgr_unit_jabatan" => "required",
            "dt.dt_tagihan.dt_ttd.sm_unit_jabatan" => "required",
            "dt.dt_tagihan.dt_ttd.mgr_shared_jabatan" => "required",
            "dt.dt_tagihan.dt_ttd.waspang_jabatan" => "required",
            "dt.dt_tagihan.dt_ttd.gudang_jabatan" => "required",

            "dt.dt_tagihan.dt_lokasi.lokasi.*.nama_lokasi" => "required",
            "dt.dt_tagihan.dt_lokasi.lokasi.*.sto" => "required",
            // "dt.dt_tagihan.dt_lokasi.lokasi.*.desig_items.*.id" => "required",

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

        "dt.dt_tagihan.dt_ttd.gm_ta_pejabat" => " GM. Telkom Akses ",
        "dt.dt_tagihan.dt_ttd.mgr_unit_pejabat" => "Mgr. Unit",
        "dt.dt_tagihan.dt_ttd.sm_unit_pejabat" => " SM. Unit",
        "dt.dt_tagihan.dt_ttd.mgr_shared_pejabat" => " Mgr. Shared Service",
        "dt.dt_tagihan.dt_ttd.waspang_pejabat" => "Waspang",
        "dt.dt_tagihan.dt_ttd.gudang_pejabat" => "Petugas Gudang",
        "dt.dt_tagihan.dt_ttd.gm_ta_jabatan" => " GM. Telkom Akses ",
        "dt.dt_tagihan.dt_ttd.mgr_unit_jabatan" => "Mgr. Unit",
        "dt.dt_tagihan.dt_ttd.sm_unit_jabatan" => " SM. Unit",
        "dt.dt_tagihan.dt_ttd.mgr_shared_jabatan" => " Mgr. Shared Service",
        "dt.dt_tagihan.dt_ttd.waspang_jabatan" => "Waspang",
        "dt.dt_tagihan.dt_ttd.gudang_jabatan" => "Petugas Gudang",

        "formUpload.jumlah" => "Jumlah Lokasi",
        "formUpload.file" => "File Lokasi",

    ];

    public function mount($data)
    {
        $this->editId = $data['key'];
        $this->doc = Tagihan::dtDokTurnkey();
        $this->setPejabat();
        $this->setDtEdit($data['key']);
        $this->setGudangEdit();
        $this->dtEdit = Tagihan::find($this->editId)->toArray();
        if($this->dtEdit['status'] == 5){
            $this->revisiClass = 'success';
        }
        $this->status = $this->dtEdit['status'];
    }

    public function uploadLokasi()
    {
        $this->validate([
            "formUpload.jumlah" => "required",
            "formUpload.file" => "required|mimes:xls,xlsx|max:2048",
        ]);

        $this->dt['file_lokasi'] = $this->formUpload['file'];

        $callback = function ($data) {
            if($data['dtError'] != 'pass'){
                foreach ($data['dtError'] as $key => $value) {
                    session()->flash('message', $value);
                }
            }else{
                $this->dt['dt_tagihan']['dt_lokasi'] = $data['dtLok'];
                session()->flash('msg-upload-ok','Upload Success');
            }
        };
        $import = new LokasiRekonImport($callback, $this->formUpload['jumlah'], $this->dt['dt_tagihan']['dt_lokasi']);
        Excel::import($import, $this->formUpload['file']);
        $this->setGudang();

    }

    public function setDtEdit($id)
    {
        $tagihanOld = (Tagihan::whereId($id)
                ->get()
            )->map(function ($item) {
                    $item['json'] = json_decode($item['json'],true);
                    unset(
                        $item['created_at'],
                        $item['updated_at'],
                        $item['deleted_at'],
                    );

                    return $item;
                }
            )
        ->first()
        ->toArray();

        $this->dt['dt_sp'] = $tagihanOld['json']['dt_sp'];
        $this->dt['dt_tagihan'] = $tagihanOld['json']['dt_tagihan'];
            
        $this->formUpload['jumlah'] = count($this->dt['dt_sp']['json']['dtLokasi']['lokasi']);
    }

    public function submit()
    {
        // dd($this->all());
        // dd($this->validate());
        $this->validate();
        $dtJson['dt_sp'] = $this->dt['dt_sp'] ;
        $dtJson['dt_tagihan'] = $this->dt['dt_tagihan'] ;
        
        $dt['auth_login_id'] = $this->dt['dt_sp']['auth_login_id'];
        $dt['mitra_id'] = Auth::user()->id;
        $dt['sp_induk_id'] = $this->dt['dt_sp']['id'];
        if($this->dtEdit['status'] == 3){
            $dt['status'] = 4;
        }
        if($this->dtEdit['status'] == 6){
            $dt['status'] = 7;
        }
        $dt['json'] = json_encode($dtJson);

        Tagihan::find($this->editId)->update($dt);
        session()->flash('message', 'Data Tagihan berhasil diperbaharui.');
        
        $dtHis['tagihan_id'] = $this->editId;
        $dtHis['status'] = $dt['status'];
        $dtHis['json'] = $dt['json'];
        TagihanHistory::create($dtHis);

        return redirect()->to('/tagihan/mitra/index');
    }

    public function setGudangEdit()
    {
        $this->allDesigs = [];
        $iAllDesig = 0;
        foreach ($this->dt['dt_tagihan']['dt_lokasi']['lokasi'] as $iLok => $vLok) {
            foreach ($vLok['desig_items'] as $iRow => $vRow) {
                if(
                    (collect($this->allDesigs))
                        ->where('nama_designator', $vRow['nama_designator'])
                        ->where('nama_material', $vRow['nama_material'])
                        ->where('nama_jasa', $vRow['nama_jasa'])
                        ->count() < 1
                ){
                    if($vRow['material']!=0){
                        $this->allDesigs[$iAllDesig] = $vRow;
                        $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['nama_designator'] = $vRow['nama_designator'];
                        $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['nama_material'] = $vRow['nama_material'];
                        $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['nama_jasa'] = $vRow['nama_jasa'];
                        $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['satuan'] = $vRow['satuan'];
                        $iAllDesig++;
                    }
                }
            }
        }

        $this->dt['dt_tagihan']['dt_gudang']['pakai'] = [];
        foreach ($this->dt['dt_tagihan']['dt_lokasi']['lokasi'] as $iLok => $vLok) {
            foreach ($this->allDesigs as $iDesMat => $vDesMat) {

                $this->dt['dt_tagihan']['dt_gudang']['pakai']['data'][$iLok][$iDesMat] = 0;
                $count = (collect($vLok['desig_items']))
                    ->where('nama_designator', $vDesMat['nama_designator'])
                    ->where('nama_material', $vDesMat['nama_material'])
                    ->where('nama_jasa', $vDesMat['nama_jasa'])
                    ->count();

                if($count > 0){
                    $sum = (collect($vLok['desig_items']))
                        ->where('nama_designator', $vDesMat['nama_designator'])
                        ->where('nama_material', $vDesMat['nama_material'])
                        ->where('nama_jasa', $vDesMat['nama_jasa'])
                        ->sum('volume_rekon');
                    $this->dt['dt_tagihan']['dt_gudang']['pakai']['data'][$iLok][$iDesMat] = intval($sum);
                }
            }
        }
        // dd($this->dt);

        $this->reTotalPakai(1);
        $this->reTotalAmbil(1);
        $this->reTotalKembali(1);
        $this->reGrandTotalGudang();
        $iDesigMaterial = 0;
        $tempDesig = [];

        foreach ($this->dt['dt_tagihan']['dt_lokasi']['lokasi'] as $iLok => $vLok) {
            foreach ($vLok['desig_items'] as $iDd => $vDd) {
                
                if(
                    (collect($tempDesig))
                        ->where('nama_designator', $vDd['nama_designator'])
                        ->where('nama_material', $vDd['nama_material'])
                        ->where('nama_jasa', $vDd['nama_jasa'])
                        ->count() < 1
                ){
                    $dtIndex = (collect($this->allDesigs))->search(function ($item) use($vDd) {
                        return $item['nama_designator'] == $vDd['nama_designator'] && 
                            $item['nama_material'] == $vDd['nama_material'] && 
                            $item['nama_jasa'] == $vDd['nama_jasa'];
                    });
                    $tempDesig[] = $vDd;
                    if($vDd['material']!=0){
                        $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['nama_barang'] = is_null($vDd['nama_designator'])?$vDd['nama_jasa']:$vDd['nama_designator']; 
                        $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['nama_barang_material'] = $vDd['nama_material']; 
                        $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['nama_barang_alista'] = is_null($vDd['nama_designator'])?$vDd['nama_jasa']:$vDd['nama_designator']; 
                        $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['nama_barang_jasa'] = $vDd['nama_jasa']; 
                        $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['gudang'] = 'Medan'; 
                        $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['satuan'] = $vDd['satuan']; 
                        
                        $iDesigMaterial++;
                    }
                }
            }
            
        }
    }

    public function setGudang()
    {
        $this->allDesigs = [];
        $iAllDesig = 0;
        $this->dt['dt_tagihan']['dt_gudang']['all_desig'] = [];
        foreach ($this->dt['dt_tagihan']['dt_lokasi']['lokasi'] as $iLok => $vLok) {
            foreach ($vLok['desig_items'] as $iRow => $vRow) {
                if(
                    (collect($this->allDesigs))
                        ->where('nama_designator', $vRow['nama_designator'])
                        ->where('nama_material', $vRow['nama_material'])
                        ->where('nama_jasa', $vRow['nama_jasa'])
                        ->count() < 1
                ){
                    // dump($vRow);
                    if($vRow['material']!=0){
                        $this->allDesigs[$iAllDesig] = $vRow;
                        $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['nama_designator'] = $vRow['nama_designator'];
                        $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['nama_material'] = $vRow['nama_material'];
                        $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['nama_jasa'] = $vRow['nama_jasa'];
                        $this->dt['dt_tagihan']['dt_gudang']['all_desig'][$iAllDesig]['satuan'] = $vRow['satuan'];
                        $iAllDesig++;
                    }
                }
            }
        }

        $this->dt['dt_tagihan']['dt_gudang']['pakai'] = [];
        foreach ($this->dt['dt_tagihan']['dt_lokasi']['lokasi'] as $iLok => $vLok) {
            foreach ($this->allDesigs as $iDesMat => $vDesMat) {

                $this->dt['dt_tagihan']['dt_gudang']['pakai']['data'][$iLok][$iDesMat] = 0;
                $count = (collect($vLok['desig_items']))
                    ->where('nama_designator', $vDesMat['nama_designator'])
                    ->where('nama_material', $vDesMat['nama_material'])
                    ->where('nama_jasa', $vDesMat['nama_jasa'])
                    ->count();

                if($count > 0){
                    $sum = (collect($vLok['desig_items']))
                        ->where('nama_designator', $vDesMat['nama_designator'])
                        ->where('nama_material', $vDesMat['nama_material'])
                        ->where('nama_jasa', $vDesMat['nama_jasa'])
                        ->sum('volume_rekon');
                    $this->dt['dt_tagihan']['dt_gudang']['pakai']['data'][$iLok][$iDesMat] = intval($sum);
                }
            }
        }
        // dd($this->dt);
        

        $this->dt['dt_tagihan']['dt_gudang']['ambil']['data'] = [];
        $this->dt['dt_tagihan']['dt_gudang']['ambil']['total'] = [];
        $this->dt['dt_tagihan']['dt_gudang']['kembali']['data'] = [];
        $this->dt['dt_tagihan']['dt_gudang']['kembali']['total'] = [];
        $this->dt['dt_tagihan']['dt_gudang']['kembali']['ket'] = [];

        $this->reTotalPakai(1);
        $this->reTotalAmbil(1);
        $this->reTotalKembali(1);
        $this->reGrandTotalGudang();
        // dd($this->dt);
        $iDesigMaterial = 0;
        $tempDesig = [];
        $this->dt['dt_tagihan']['dt_gudang']['rekon'] = [];
        foreach ($this->dt['dt_tagihan']['dt_lokasi']['lokasi'] as $iLok => $vLok) {
            foreach ($vLok['desig_items'] as $iDd => $vDd) {
                
                if(
                    (collect($tempDesig))
                        ->where('nama_designator', $vDd['nama_designator'])
                        ->where('nama_material', $vDd['nama_material'])
                        ->where('nama_jasa', $vDd['nama_jasa'])
                        ->count() < 1
                ){
                    $dtIndex = (collect($this->allDesigs))->search(function ($item) use($vDd) {
                        return $item['nama_designator'] == $vDd['nama_designator'] && 
                            $item['nama_material'] == $vDd['nama_material'] && 
                            $item['nama_jasa'] == $vDd['nama_jasa'];
                    });
                    $tempDesig[] = $vDd;
                    if($vDd['material']!=0){
                        $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['nama_barang'] = is_null($vDd['nama_designator'])?$vDd['nama_jasa']:$vDd['nama_designator']; 
                        $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['nama_barang_material'] = $vDd['nama_material']; 
                        $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['nama_barang_alista'] = is_null($vDd['nama_designator'])?$vDd['nama_jasa']:$vDd['nama_designator']; 
                        $this->dt['dt_tagihan']['dt_gudang']['rekon'][$iDesigMaterial]['nama_barang_jasa'] = $vDd['nama_jasa']; 
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

        $this->pejabat['gm_ta'] = array_values((collect($lov))->where('key', 'gm_ta')->toArray())[0];
        $this->pejabat['mgr_osp-fo'] = array_values((collect($lov))->where('key', 'mgr_osp-fo')->toArray())[0];
        $this->pejabat['sm_osp-fo'] = array_values((collect($lov))->where('key', 'sm_osp-fo')->toArray())[0];
        $this->pejabat['mgr_qe'] = array_values((collect($lov))->where('key', 'mgr_qe')->toArray())[0];
        $this->pejabat['sm_qe'] = array_values((collect($lov))->where('key', 'sm_qe')->toArray())[0];
        $this->pejabat['mgr_shared'] = array_values((collect($lov))->where('key', 'mgr_shared')->toArray())[0];
        $this->pejabat['waspang'] = array_values((collect($lov))->where('key', 'waspang')->toArray())[0];
        $this->pejabat['gudang'] = array_values((collect($lov))->where('key', 'gudang')->toArray())[0];
    }

    public function changeTab($tab)
    {
        $this->tab = $tab;
    }

    public function render()
    {
        return view('mods.tagihan.revisi_tagihan');
    }
}



