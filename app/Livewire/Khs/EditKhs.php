<?php

namespace App\Livewire\Khs;

use App\Imports\DesignatorKhsIndukImport;
use App\Models\KhsAmandemen;
use App\Models\KhsInduk;
use App\Models\MasterUser;
use App\Models\SpInduk;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class EditKhs extends Component
{
    use WithFileUploads;

    public $dt = [];
    public $mitras = [];
    public $desig;
    public $rand = 1;
    public $editId;
    
    public function rules()
    {
        return [
            "dt.auth_login_id" => "required",
            "dt.no" => 'required|unique:khs_induks,no,'.$this->editId.',id,deleted_at,NULL',
            "dt.tgl_berlaku" => "required",
            "dt.judul" => "required",
            "dt.json.alamat" => "required",
            "dt.json.direktur" => "required",
            "dt.json.bank" => "required",
            "dt.json.rekening" => "required",
            "dt.json.cabang" => "required",
            "dt.json.nama_rekening" => "required",
            "desig" => "nullable|mimes:xlsx|max:2048",
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
        "desig" => "File Designator",
    ];

    public function mount($data)
    {
        $this->editId = $data['key'];
        $this->dt = (
                KhsInduk::where('id',$data['key'])
                ->get()
            )->map(function ($item) {
                    $item['json'] = json_decode($item['json'],true);
                    return $item;
                }
            )->first()->toArray();   
        unset(
            $this->dt['id'],
            $this->dt['created_at'],
            $this->dt['updated_at'],
            $this->dt['deleted_at'],
        );

        $this->mitras = (
                MasterUser::select('id','auth_login_id','auth_role_id','detail')
                    ->where('auth_role_id',4)
                    ->get()
            )->map(function ($item) {
                    $item['detail'] = json_decode($item['detail'],true);
                    return $item;
                }
            )->toArray();
        // dd($this->all());
    }

    public function resetForm()
    {
        $this->mount($this->data);
    }

    public function updateKhs()
    {
        $this->validate();
        $dt = $this->dt;
        
        KhsInduk::find($this->editId)->update($dt);
        $this->dispatch('alert', data:['type' => 'success',  'message' => 'Data KHS Induk berhasil diupdate.']);
        if(!is_null($this->desig)){
            $import = new DesignatorKhsIndukImport($this->editId);
            Excel::import($import, $this->desig);
            $this->rand++;
            if(($import->runCallBack())=="pass"){
                $this->dispatch('alert', data:['type' => 'success',  'message' => 'Data designator berhasil diimport']);
            }else{
                $this->dispatch('alert', data:['type' => 'error',  'message' => 'Data designator gagal diimport, '.$import->runCallBack()]);
            }
        }
    }

    public function render()
    {
        $qSp = SpInduk::where('khs_induk_id',$this->editId)->get()->count();
        $qAman = KhsAmandemen::where('khs_induk_id',$this->editId)->get()->count();
        if($qSp > 0 || $qAman > 0){
            return redirect()->route('khs.index');
        }
        return view('mods.khs.edit_khs');
    }
}
