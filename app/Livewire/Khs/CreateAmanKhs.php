<?php

namespace App\Livewire\Khs;

use App\Imports\DesignatorKhsAmanImport;
use App\Models\KhsAmandemen;
use App\Models\KhsAmandemenDesignator;
use App\Models\KhsInduk;
use App\Models\KhsIndukDesignator;
use App\Models\MasterUser;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CreateAmanKhs extends Component
{
    use WithFileUploads;

    public $desigFile;
    public $khsId;
    public $dtEdit;
    public $amanKe = 1;
    public $dtDesig;
    
    public function rules()
    {
        return [
            "dtEdit.no" => "required",
            "dtEdit.tgl_berlaku" => "required",
            "dtEdit.judul" => "required",
            "dtEdit.json.direktur" => "required",
            "dtEdit.json.bank" => "required",
            "dtEdit.json.rekening" => "required",
            "dtEdit.json.cabang" => "required",
            "dtEdit.json.nama_rekening" => "required",
            "dtEdit.json.alamat" => "required",
            // "desigFile" => "nullable|mimes:xlsx|max:2048",
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
        $qDtAman = KhsAmandemen::where('khs_induk_id',$this->khsId)
            ->withCount(['khs_induks as auth_login_id' => function (Builder $query) {
                $query->select(DB::raw("auth_login_id as login"));
            }])
            ->orderBy('tgl_berlaku', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();

        if(count($qDtAman)==0){
            $this->dtEdit = KhsInduk::find($this->khsId)->toArray();
            $this->dtEdit['json'] = json_decode($this->dtEdit['json'], true);
            $this->dtDesig = (
                KhsIndukDesignator::where('khs_induk_id',$data['key'])->get()
            )->map(function ($item) {
                    unset(
                        $item['id'],
                        $item['khs_induk_id'],
                        $item['created_at'],
                        $item['updated_at'],
                        $item['deleted_at'],
                    );
                    return $item;
                }
            )->toArray();
        }else{
            $this->dtEdit = $qDtAman[0];
            $this->dtEdit['json'] = json_decode($this->dtEdit['json'], true);
            $this->amanKe = count($qDtAman)+1;
            $this->dtDesig = (
                    KhsAmandemenDesignator::where('khs_amandemen_id',$this->dtEdit['id'])->get()
                )->map(function ($item) {
                    unset(
                        $item['id'],
                        $item['khs_induk_id'],
                        $item['created_at'],
                        $item['updated_at'],
                        $item['deleted_at'],
                    );
                    return $item;
                })->toArray();
        }

        unset(
            $this->dtEdit['id'],
        );
        $this->dtEdit['khs_induk_id'] = $data['key'];
    }

    public function submit()
    {
        $this->validate();
        $dt = $this->dtEdit;
        $dt['json'] = json_encode($dt['json']);
        $authLoginId =  $dt['auth_login_id'];
        unset($dt['auth_login_id']);
        $q = KhsAmandemen::create($dt);
        MasterUser::where('auth_login_id', $authLoginId)
            ->update(['detail'=>$dt['json']]);
        $khsId = $this->khsId;
        if(!is_null($this->desigFile)){
            $import = new DesignatorKhsAmanImport($q->id);
            // Excel::import($import, $this->desigFile);
           
            if(($import->runCallBack())!="pass"){
                KhsAmandemen::where('id',$q->id)->forceDelete();
                $this->dispatch('alert', data:['type' => 'error',  'message' => 'Amandemen gagal dibuat, format designator tidak valid, '.$import->runCallBack()]);
            }else{
                $this->dispatch('alert', data:['type' => 'success',  'message' => 'Data Amandemen '.$this->amanKe.' dengan designator baru berhasil dibuat.']);
                $this->reset();
                $this->mount(['key' => $khsId]);
            }
        }else{
            $this->dtDesig = (collect($this->dtDesig))->map(function ($item) use($q) {
                $item['khs_amandemen_id'] = $q->id;
                $item['created_at'] = Carbon::now();
                $item['updated_at'] = Carbon::now();
                return $item;
            })->toArray();

            KhsAmandemenDesignator::insert($this->dtDesig);
            $this->dispatch('alert', data:['type' => 'success',  'message' => 'Data Amandemen '.$this->amanKe.' berhasil dibuat  menggunakan designator sebelumnya.']);
            $this->reset();
            $this->mount(['key' => $khsId]);
        }

    }

    public function render()
    {
        return view('mods.khs.create_aman_khs');
    }
}
