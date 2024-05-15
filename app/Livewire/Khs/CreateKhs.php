<?php

namespace App\Livewire\Khs;

use App\Imports\DesignatorKhsIndukImport;
use App\Models\KhsInduk;
use App\Models\MasterUser;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CreateKhs extends Component
{
    use WithFileUploads;

    public $dt = [];
    public $mitras = [];
    public $desig;
    public $rand = 1;

    public function rules()
    {
        return [
            "dt.auth_login_id" => "required",
            "dt.no" => "required|unique:khs_induks,no,NULL,id,deleted_at,NULL",
            "dt.tgl_berlaku" => "required",
            "dt.judul" => "required",
            "dt.json.alamat" => "required",
            "dt.json.direktur" => "required",
            "dt.json.bank" => "required",
            "dt.json.rekening" => "required",
            "dt.json.cabang" => "required",
            "dt.json.nama_rekening" => "required",
            // "desig" => "required|mimes:xlsx|max:2048",
        ];
    }

    protected $validationAttributes = [
        "dt.auth_login_id" => "Mitra",
        "dt.no" => "Nomor",
        "dt.tgl_berlaku" => "Tgl.Berlaku",
        "dt.judul" => "Judul",
        "dt.json.alamat" => "Alamat",
        "dt.json.direktur" => "Direktur",
        "dt.json.bank" => "Nama Bank",
        "dt.json.rekening" => "No.Rekening",
        "dt.json.cabang" => "Kantor Cabang Bank",
        "dt.json.nama_rekening" => "Nama Pemilik Rekening",
        // "desig" => "File Designator",
    ];

    public function mount()
    {
        $this->mitras = (
            MasterUser::select('id','auth_login_id','auth_role_id','detail')
                ->where('auth_role_id',4)
                ->get()
            )->map(function ($item) {
                    $item['detail'] = json_decode($item['detail'],true);
                    return $item;
                }
            )->toArray();    
    }

    public function insertKhs()
    {
        $this->validate();
        $dt = $this->dt;
        $dt['json'] = json_encode($dt['json']);
        $q = KhsInduk::create($dt);
        MasterUser::where('auth_login_id', $dt['auth_login_id'])
            ->update(['detail'=>$dt['json']]);
        $import = new DesignatorKhsIndukImport($q->id);
        // Excel::import($import, $this->desig);
        $this->reset();
        $this->rand++;
        
        if(($import->runCallBack())=="pass"){
            $this->dispatch('alert', data:['type' => 'success',  'message' => 'Data KHS Induk baru berhasil dibuat.']);
        }else{
            $this->dispatch('alert', data:['type' => 'error',  'message' => 'Data designator gagal diimport, '.$import->runCallBack()]);
            KhsInduk::where('id',$q->id)->forceDelete();
        }
    }

    #[On('createkhs-pickMitra')]
    public function pickMitra()
    {
        $dtMitra = (collect($this->mitras))->where('auth_login_id',$this->dt['auth_login_id'])
            ->first();
        $this->dt['json'] = $dtMitra['detail'];
        $this->dt['json']['direktur'] = $dtMitra['detail']['direktur'];
        $this->dt['json']['alamat'] = $dtMitra['detail']['alamat'];
    }

    public function render()
    {
        return view('mods.khs.create_khs');
    }


}

