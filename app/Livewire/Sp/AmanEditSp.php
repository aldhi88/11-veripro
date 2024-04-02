<?php

namespace App\Livewire\Sp;

use App\Imports\LokasiImport;
use App\Models\KhsAmandemenDesignator;
use App\Models\KhsInduk;
use App\Models\KhsIndukDesignator;
use App\Models\MasterUnit;
use App\Models\MasterUser;
use App\Models\SpAmandemen;
use App\Models\SpInduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class AmanEditSp extends Component
{
    use WithFileUploads;

    public $tab = 'data';
    public $dData = '';
    public $dDesig = 'd-none';

    public $mitras = [];
    public $units = [];
    public $dt = [];
    public $dtKhs = [];
    public $openTglSpToc = true;
    public $minTglSp;
    public $noAman = null;

    public $formUpload = [];
    public $dtLok = [];
    public $dtError = [];

    public $msgLokasi;
    public $editId;
    public $dtEdit;
    public $hasTagihan = true;

    public function rules()
    {
        return [
            "dt.master_unit_id" => "required",
            "dt.khs_induk_id" => "required",
            "dt.khs_amandemen_id" => "",
            "dt.mitra_id" => "required",
            "dt.no_sp" => 'required|unique:sp_amandemens,no_sp,'.$this->editId.',id,deleted_at,NULL',
            "dt.tgl_sp" => "required",
            "dt.tgl_toc" => "required",
            "dt.nama_pekerjaan" => "required",
            "dt.file_sp" => "nullable|mimes:pdf|max:2048",
            "dt.ppn" => "required|numeric|max:100",
        ];
    }

    protected $validationAttributes = [
        "dt.master_unit_id" => "Jenis Pekerjaan",
        "dt.khs_induk_id" => "KHS Induk",
        "dt.mitra_id" => "Mitra",
        "dt.no_sp" => "Nomor SP",
        "dt.tgl_sp" => "Tgl. SP",
        "dt.tgl_toc" => "Tgl. TOC",
        "dt.nama_pekerjaan" => "Nama Pekerjaan",
        "dt.file_sp" => "File SP",
        "dt.ppn" => "PPN",
        "formUpload.jumlah" => "Jumlah Lokasi",
        "formUpload.file" => "File Lokasi",
    ];

    // ==========================

    public function submit()
    {
        $this->reset('msgLokasi');
        $this->validate();
        if(count($this->dtLok)==0){
            $this->msgLokasi = 'Data Lokasi belum valid, pastikan anda sudah upload data lokasi dan sudah tidak ada error lokasi';
        }else{
            if(isset($this->dt['file_sp'])){
                if(Storage::exists(str_replace('storage/','public/', $this->dtEdit['file_sp']))){
                    Storage::delete(str_replace('storage/','public/', $this->dtEdit['file_sp']));
                    $this->dt['file_sp'] = str_replace('public/','storage/',$this->dt['file_sp']->store('public/sp_aman'));
                }
            }

            if(isset($this->dt['file_lokasi'])){
                if(Storage::exists(str_replace('storage/','public/', $this->dtEdit['file_lokasi']))){
                    Storage::delete(str_replace('storage/','public/', $this->dtEdit['file_lokasi']));
                    $this->dt['file_lokasi'] = str_replace('public/','storage/',$this->dt['file_lokasi']->store('public/sp_aman'));
                }
            }
            unset(
                $this->dt['mitra_id'],
                $this->dt['khs_induk_id'],
                $this->dt['khs_amandemen_id'],
                $this->dt['auth_login_id'],
            );
            SpAmandemen::find($this->editId)->update($this->dt);
            session()->flash('message', 'Data Amandemen SP berhasil diperbaharui.');
            return redirect()->to('/sp/index');
        }
    }

    public function uploadLokasi()
    {
        $this->validate([
            "formUpload.jumlah" => "required",
            "formUpload.file" => "required|mimes:xls,xlsx|max:2048",
        ]);

        $this->dt['file_lokasi'] = $this->formUpload['file'];

        if(is_null($this->dt['khs_amandemen_id'])){
            $dtDesigAcuan = (KhsIndukDesignator::query()
                ->where('khs_induk_id',$this->dt['khs_induk_id'])
                ->get())
                ->map(function ($item) {
                        unset(
                            $item['id'],
                            $item['khs_induk_id'],
                            $item['created_at'],
                            $item['updated_at'],
                            $item['deleted_at'],
                        );
                        return $item;
                    })
                ->toArray();   
        }else{
            $dtDesigAcuan = (KhsAmandemenDesignator::query()
                ->where('khs_amandemen_id', $this->dt['khs_amandemen_id'])
                ->get())
                ->map(function ($item) {
                        unset(
                            $item['id'],
                            $item['khs_amandemen_id'],
                            $item['created_at'],
                            $item['updated_at'],
                            $item['deleted_at'],
                        );
                        return $item;
                    })
                ->toArray();
        }

        $callback = function ($data) {
            $this->dtLok = $data['dtLok'];
            $this->dtError = $data['dtError'];
            $dtJson['dtLokasi'] = $data['dtLok'];
            $this->dt['json'] = json_encode($dtJson);
        };

        $import = new LokasiImport($callback, $this->formUpload['jumlah'], $dtDesigAcuan);
        Excel::import($import, $this->formUpload['file']);
    }
    public function mount($data)
    {
        $this->editId = $data['key'];

        $this->dtEdit = (SpAmandemen::where('id',$this->editId)
                ->with([
                    'sp_induks.khs_induks.auth_logins.master_users',
                    'sp_induks.khs_amandemens',
                ])
                ->orderBy('id','desc')
                ->get())
                ->map(function($item){
                    $item['json'] = json_decode($item['json'], true);
                    $item['sp_induks']['khs_induks']['json'] = json_decode($item['sp_induks']['khs_induks']['json'], true);
                    $item['khs_induks'] = ($item['sp_induks']['khs_induks'])->toArray();
                    $item['khs_amandemens'] = $item['sp_induks']['khs_amandemens'];
                    $item['status'] = $item['sp_induks']['khs_induks']['status'];
                    $item['khs_induk_id'] = $item['sp_induks']['khs_induk_id'];
                    unset(
                        $item['sp_induks'],
                        $item['id'],
                        $item['created_at'],
                        $item['deleted_at'],
                        $item['updated_at'],
                    );
                    return $item;
                })
                ->first()
                ->toArray();
        
        if(!is_null($this->dtEdit['khs_amandemens'])){
            $this->noAman = $this->dtEdit['khs_amandemens']['no'];
        }

        $this->dt = $this->dtEdit;
        $this->dt['mitra_id'] = $this->dtEdit['khs_induks']['auth_login_id'];
        $this->dt['json'] = json_encode($this->dt['json']);
        unset(
            $this->dt['khs_induks'],
            $this->dt['status_label'],
            $this->dt['status'],
            $this->dt['file_sp'],
            $this->dt['file_lokasi'],
            $this->dt['khs_amandemens'],
        );

        if($this->dtEdit['status']==1){
            $this->mitras = MasterUser::query()
                ->where('auth_role_id', 4)
                ->get()->toArray();
        }
        $this->units = MasterUnit::query()
            ->where('id', '>', 1)
            ->where('id', '<', 4)
            ->get()->toArray();
        $this->dt['auth_login_id'] = Auth::id();

        $this->genKhs();
        $this->dtLok = $this->dtEdit['json']['dtLokasi'];

        // dd($this->all());
    }

    public function genKhs()
    {
        $this->dtKhs = (KhsInduk::query()
                ->where('auth_login_id', $this->dt['mitra_id'])
                ->with([
                    "khs_amandemens",
                ])
                ->get()
            )->map(function ($item) {
                    $item['json'] = json_decode($item['json'],true);
                    unset(
                        $item['created_at'],
                        $item['updated_at'],
                        $item['deleted_at'],
                        $item['json'],
                    );

                    foreach ($item->khs_amandemens as $key => $value) {
                        $value['json'] = json_decode($value['json'],true);
                        unset(
                            $value['created_at'],
                            $value['updated_at'],
                            $value['deleted_at'],
                            $value['json'],
                        );
                    }
                    return $item;
                }
            )->toArray();

        $this->dispatch('editspatc-generateKhs', data: $this->dtKhs);
    }

    #[On('editsp-pickMitra')]
    public function pickMitra()
    {
        $this->reset(
            'dtKhs',
            'dt.tgl_sp',
            'dt.tgl_toc',
            'noAman',
            'openTglSpToc',
        );

        $this->genKhs();
            
        $this->dispatch('editspatc-generateKhs', data: $this->dtKhs);
    }

    #[On('editsp-pickKhs')] 
    public function pickKhs()
    {
        $this->reset(
            'noAman',
            'dt.tgl_sp',
            'dt.tgl_toc'
        );

        $this->openTglSpToc = true;
        $this->minTglSp = KhsInduk::select('tgl_berlaku')
            ->where('id', $this->dt['khs_induk_id'])
            ->value('tgl_berlaku');
    }

    public function changeTglSp()
    {
        $this->reset(
            'dt.tgl_toc',
            'dt.khs_amandemen_id',
        );

        $selKhs = (collect($this->dtKhs))
            ->where('id', $this->dt['khs_induk_id'])
            ->first();

        $this->dt['khs_amandemen_id'] = null;
        $this->noAman = null;
        if(count($selKhs['khs_amandemens'])>0){
            $dtAmanFilter = (collect($selKhs['khs_amandemens']))
                ->where('tgl_berlaku','<=', $this->dt['tgl_sp'])
                ->sortByDesc('tgl_berlaku')
                ->values()
                ->toArray();
            if(count($dtAmanFilter)>0){
                $this->noAman = $dtAmanFilter[0]['no'];
                $this->dt['khs_amandemen_id'] = $dtAmanFilter[0]['id'];
            }
        }
    }

    public function changeTab($tab)
    {
        $this->tab = $tab;
        $this->dData = 'd-none';
        $this->dDesig = 'd-none';
        if($tab=='data'){
            $this->dData = '';
        }
        if($tab=='desig'){
            $this->dDesig= '';
        }

    }

    public function render()
    {
        return view('mods.sp.aman_edit_sp');
    }
}
