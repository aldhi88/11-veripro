<?php

namespace App\Livewire\Sp;

use App\Imports\LokasiImport;
use App\Models\KhsAmandemenDesignator;
use App\Models\KhsInduk;
use App\Models\KhsIndukDesignator;
use App\Models\MasterUnit;
use App\Models\MasterUser;
use App\Models\SpInduk;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CreateSp extends Component
{
    use WithFileUploads;

    public $tab = 'data';
    public $dData = '';
    public $dDesig = 'd-none';

    public $mitras = [];
    public $units = [];
    public $dt = [];
    public $dtKhs = [];
    public $openTglSpToc = false;
    public $minTglSp;
    public $noAman = null;

    public $formUpload = [];
    public $dtLok = [];
    public $dtError = [];

    public $msgLokasi;

    public function rules()
    {
        return [
            "dt.master_unit_id" => "required",
            "dt.khs_induk_id" => "required",
            "dt.khs_amandemen_id" => "",
            "dt.mitra_id" => "required",
            "dt.no_sp" => "required|unique:sp_induks,no_sp,NULL,id,deleted_at,NULL",
            "dt.tgl_sp" => "required",
            "dt.tgl_toc" => "required",
            "dt.nama_pekerjaan" => "required",
            "dt.file_sp" => "required|mimes:pdf|max:2048",
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
        // dd($this->dt);
        if(count($this->dtLok)==0){
            $this->msgLokasi = 'Data Lokasi belum valid, pastikan anda sudah upload data lokasi dan sudah tidak ada error lokasi';
        }else{
            unset($this->dt['mitra_id']);
            $this->dt['file_sp'] = str_replace('public/','storage/',$this->dt['file_sp']->store('public/sp'));
            $this->dt['file_lokasi'] = str_replace('public/','storage/',$this->dt['file_lokasi']->store('public/sp'));
            SpInduk::create($this->dt);
            session()->flash('message', 'Data SP baru berhasil di tambahkan.');
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
        $dtDesigAcuan = [];
        // if(is_null($this->dt['khs_amandemen_id'])){
        //     $dtDesigAcuan = (KhsIndukDesignator::query()
        //         ->where('khs_induk_id',$this->dt['khs_induk_id'])
        //         ->get())
        //         ->map(function ($item) {
        //                 unset(
        //                     $item['id'],
        //                     $item['khs_induk_id'],
        //                     $item['created_at'],
        //                     $item['updated_at'],
        //                     $item['deleted_at'],
        //                 );
        //                 return $item;
        //             })
        //         ->toArray();   
        // }else{
        //     $dtDesigAcuan = (KhsAmandemenDesignator::query()
        //         ->where('khs_amandemen_id', $this->dt['khs_amandemen_id'])
        //         ->get())
        //         ->map(function ($item) {
        //                 unset(
        //                     $item['id'],
        //                     $item['khs_amandemen_id'],
        //                     $item['created_at'],
        //                     $item['updated_at'],
        //                     $item['deleted_at'],
        //                 );
        //                 return $item;
        //             })
        //         ->toArray();
        // }

        $callback = function ($data) {
            // dd($data);
            $this->dtError = $data['dtError'];
            $this->dtLok = $data['dtLok'];
            if($data['dtError']!='pass'){
                session()->flash('message', $data['dtError']);
            }
            $dtJson['dtLokasi'] = $data['dtLok'];
            $this->dt['json'] = json_encode($dtJson);
            $this->dt['json_sp'] = json_encode($dtJson);
            session()->flash('msg-upload-ok','Upload Success');
        };

        $import = new LokasiImport($callback, $this->formUpload['jumlah'], $dtDesigAcuan);
        Excel::import($import, $this->formUpload['file']);
    }

    public function mount()
    {
        $this->mitras = MasterUser::query()
            ->where('auth_role_id', 4)
            ->get()->toArray();
        $this->units = MasterUnit::query()
            ->where('id', '>', 1)
            ->where('id', '<', 4)
            ->get()->toArray();
        $this->dt['auth_login_id'] = Auth::id();
    }

    #[On('createsp-pickMitra')]
    public function pickMitra()
    {
        $this->reset(
            'dtKhs',
            'dt.tgl_sp',
            'dt.tgl_toc',
            'openTglSpToc',
        );
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
            
            // dd($this->all());

        $this->dispatch('createspatc-generateKhs', data: $this->dtKhs);
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
        return view('mods.sp.create_sp');
    }
}
