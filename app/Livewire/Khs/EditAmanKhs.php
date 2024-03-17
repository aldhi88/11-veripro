<?php

namespace App\Livewire\Khs;

use App\Imports\DesignatorKhsAmanImport;
use App\Models\KhsAmandemen;
use App\Models\KhsAmandemenDesignator;
use App\Models\KhsInduk;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class EditAmanKhs extends Component
{
    use WithFileUploads;

    public $desigFile;
    public $khsId;
    public $dtEdit;
    public $amanKe = 1;
    public $dtDesig;
    public $rand;
    public $tgl_before;
    
    public function rules()
    {
        return [
            "dtEdit.no" => 'required|unique:khs_amandemens,no,'.$this->khsId.',id,deleted_at,NULL',
            "dtEdit.tgl_berlaku" => "required",
            "dtEdit.judul" => "required",
            "dtEdit.json.direktur" => "required",
            "dtEdit.json.bank" => "required",
            "dtEdit.json.rekening" => "required",
            "dtEdit.json.cabang" => "required",
            "dtEdit.json.nama_rekening" => "required",
            "dtEdit.json.alamat" => "required",
            "desigFile" => "nullable|mimes:xlsx|max:2048",
        ];
    }

    protected $validationAttributes = [
        "dtEdit.no" => "No. Amandemen",
        "dtEdit.tgl_berlaku" => "Tgl. Amandemen",
        "dtEdit.judul" => "Judul Amandemen",
        "dtEdit.json.direktur" => "Nama Direktur",
        "dtEdit.json.bank" => "Nama Bank",
        "dtEdit.json.rekening" => "No. Rekening",
        "dtEdit.json.cabang" => "Nama Cabang Bank",
        "dtEdit.json.nama_rekening" => "Nama Pemilik Rekening",
        "dtEdit.json.alamat" => "Alamat",
    ];

    public function mount($data)
    {
        $this->khsId = $data['key'];
        $dtAman = KhsAmandemen::where('id',$this->khsId)->get();
        $this->amanKe = $dtAman->count();
        $this->dtEdit = ($dtAman)->map(function ($item) {
                    $item['json'] = json_decode($item['json'],true);
                    return $item;
                })
                ->first()
                ->toArray();
        if($this->amanKe == 1){
            $this->tgl_before = KhsInduk::select('tgl_berlaku')
                ->where('id',$this->dtEdit['khs_induk_id'])
                ->value('tgl_berlaku');
        }else{
            $q = (collect($dtAman))
                ->sortByDesc('tgl_berlaku')
                ->toArray();
            $this->tgl_before = $q[1]['tgl_berlaku'];
        }
        unset(
            $this->dtEdit['id'],
        );
    }

    public function submit()
    {
        $this->validate();
        KhsAmandemen::find($this->khsId)->update($this->dtEdit);
        
        if(!is_null($this->desigFile)){
            $import = new DesignatorKhsAmanImport($this->khsId);
            Excel::import($import, $this->desigFile);
            if(($import->runCallBack())!="pass"){
                $this->dispatch('alert', data:['type' => 'error',  'message' => 'Format designator tidak valid, '.$import->runCallBack()]);
            }else{
                $this->dispatch('alert', data:['type' => 'success',  'message' => 'Import designator baru berhasil']);
            }
            $this->rand++;
        }

        $this->dispatch('alert', data:['type' => 'success',  'message' => 'Data Amandemen KHS berhasil diperbaharui.']);
    }

    public function render()
    {
        return view('mods.khs.edit_aman_khs');
    }

}

