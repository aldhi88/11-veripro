<?php

namespace App\Livewire\Sp;

use App\Imports\DesigImport;
use App\Models\KhsAmandemenDesignator;
use App\Models\KhsInduk;
use App\Models\KhsIndukDesignator;
use App\Models\MasterUnit;
use App\Models\MasterUser;
use App\Models\SpAmandemen;
use App\Models\SpInduk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class AmanCreateSp extends Component
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
    public $amanKe;
    public $amanId;

    public function rules()
    {
        return [
            "dt.master_unit_id" => "required",
            "dt.khs_induk_id" => "required",
            "dt.khs_amandemen_id" => "",
            "dt.mitra_id" => "required",
            "dt.no_sp" => 'required|unique:sp_amandemens,no_sp,'.$this->amanId.',id,deleted_at,NULL',
            "dt.tgl_sp" => "required",
            "dt.tgl_toc" => "required",
            "dt.nama_pekerjaan" => "required",
            "dt.file_sp" => "required|mimes:pdf|max:2048",
            "dt.ppn" => "required|numeric",
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
            $this->dt['file_sp'] = str_replace('public/','storage/',$this->dt['file_sp']->store('public/sp_aman'));

            if(isset($this->dt['file_lokasi'])){
                $this->dt['file_lokasi'] = str_replace('public/','storage/',$this->dt['file_lokasi']->store('public/sp_aman'));
            }else{
                if($this->amanKe == 1){
                    Storage::copy(
                        str_replace('storage/','public/', $this->dtEdit['file_lokasi']),
                        str_replace('/sp','/sp_aman',str_replace('storage/','public/', $this->dtEdit['file_lokasi']))
                    );
                    $newFileName = str_replace('/sp','/sp_aman',str_replace('storage/','public/', $this->dtEdit['file_lokasi']));
                }else{
                    $oldFile = str_replace('storage/','public/', $this->dtEdit['file_lokasi']);
                    $pathInfo = pathinfo($oldFile);
                    $fileExt = '.'.$pathInfo['extension'];
                    $newFileName = 'public/sp_aman/'.md5($pathInfo['filename']).$fileExt;
                    Storage::copy($oldFile,$newFileName);
                }
                $this->dt['file_lokasi'] = $newFileName;
            }
            SpAmandemen::create($this->dt);
            session()->flash('message', 'Data Amandemen SP baru berhasil dibuat.');
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
            $this->dtLok = $data['data'];
            $this->dtError = $data['error'];

            $dtJson['dtLokasi'] = $data['data'];
            $this->dt['json'] = json_encode($dtJson);
        };

        $import = new DesigImport($callback, $this->formUpload['jumlah'], $dtDesigAcuan);
        Excel::import($import, $this->formUpload['file']);
    }
    public function mount($data)
    {
        $this->editId = $data['key'];
        $dtAmans = (SpAmandemen::where('sp_induk_id',$this->editId)
            ->orderBy('tgl_sp', 'desc')
            ->orderBy('created_at', 'desc')
            ->with([
                'sp_induks'=>function($q){
                    $q->select('id','mitra_id');
                },
                'khs_amandemens',
                'khs_induks'
            ])
            ->get())
            ->map(function($item){
                $item['json'] = json_decode($item['json'],true);
                unset(
                    $item['created_at'],
                    $item['created_at'],
                    $item['deleted_at'],
                    $item['updated_at'],
                    $item['khs_induks']['created_at'],
                    $item['khs_induks']['deleted_at'],
                    $item['khs_induks']['updated_at'],
                );
                return $item;
            })->toArray();
            
        $this->amanKe = count($dtAmans)+1;
        if($this->amanKe>1){
            $this->amanId = $dtAmans[0]['id'];
            $this->dtEdit = $dtAmans[0];
            $this->dtEdit['khs_induks']['json'] = json_decode($this->dtEdit['khs_induks']['json'],true);
            $mitraId = $this->dtEdit['sp_induks']['mitra_id'];
            $this->dt = $this->dtEdit;
            unset(
                $this->dt['id'],
                $this->dt['file_sp'],
                $this->dt['file_lokasi'],
                $this->dt['khs_amandemens'],
                $this->dt['khs_induks'],
                $this->dt['sp_induks'],
            );
            // dd($this->dt);

        }else{

            $this->dtEdit = (SpInduk::where('id',$this->editId)
                ->with(['khs_induks','khs_amandemens'])
                ->get())
                ->map(function($item){
                    $item['json'] = json_decode($item['json'], true);
                    $item['khs_induks']['json'] = json_decode($item['khs_induks']['json'], true);
                    unset(
                        $item['id'],
                        $item['created_at'],
                        $item['deleted_at'],
                        $item['updated_at'],
                        $item['khs_induks']['created_at'],
                        $item['khs_induks']['deleted_at'],
                        $item['khs_induks']['updated_at'],
                    );
                    return $item;
                })
                ->first()
                ->toArray();
            $mitraId = $this->dtEdit['mitra_id'];
            $this->amanId = $this->editId;
            $this->dt = $this->dtEdit;
            unset(
                $this->dt['khs_induks'],
                $this->dt['status_label'],
                $this->dt['status'],
                $this->dt['file_sp'],
                $this->dt['file_lokasi'],
                $this->dt['khs_amandemens'],
            );

        }

        
        if(!is_null($this->dtEdit['khs_amandemens'])){
            $this->noAman = $this->dtEdit['khs_amandemens']['no'];
        }
        $this->dt['json'] = json_encode($this->dt['json']);

        $this->units = MasterUnit::query()
            ->where('id', '>', 1)
            ->where('id', '<', 4)
            ->get()->toArray();
        $this->dt['auth_login_id'] = Auth::id();
        $this->dt['sp_induk_id'] = $this->editId;

        $this->genKhs($mitraId);
        $this->dtLok = $this->dtEdit['json']['dtLokasi'];
    }

    public function genKhs($mitraId)
    {
        $this->dtKhs = (KhsInduk::query()
                ->where('auth_login_id', $mitraId)
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
    }

    #[On('createsp-pickKhs')] 
    public function pickKhs()
    {
        $this->reset(
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
            'dtLok',
            'dtError',
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
        return view('mods.sp.aman_create_sp');
    }
}
