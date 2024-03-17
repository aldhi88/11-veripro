<?php

namespace App\Imports;

use App\Models\KhsAmandemenDesignator;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
class DesignatorKhsAmanImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $khsId;
    private $status;


    public function __construct($khsId)
    {
        $this->khsId = $khsId;
        $this->status = "pass";
    }

    public function collection(Collection $row)
    {
        $fieldList = [
            'nama_material',
            'nama_jasa',
            'nama',
            'uraian',
            'satuan',
            'material',
            'jasa'
        ];

        $fieldFile = array_keys($row->toArray()[0]);
        if(($fieldList === $fieldFile) == false){
            $this->status = "nama kolom pada excel tidak sesuai template.";
        }else{
            foreach ($row->toArray() as $key => $value) {
                if(!is_numeric($value['material'])){
                    $this->status = "harga pada kolom material tidak valid (".$value['material'].")";
                    break;
                }
                if(!is_numeric($value['jasa'])){
                    $this->status = "harga pada kolom jasa tidak valid (".$value['jasa'].")";
                    break;
                }
                $value['nama_material'] = $value['nama_material']==''?'-':$value['nama_material'];
                $value['nama_jasa'] = $value['nama_jasa']==''?'-':$value['nama_jasa'];
                $value['nama'] = $value['nama']==''?'-':$value['nama'];
                
                $data[$key]['khs_amandemen_id'] = $this->khsId;
                $data[$key]['nama_material'] = $value['nama_material'];
                $data[$key]['nama_jasa'] = $value['nama_jasa'];
                $data[$key]['nama'] = $value['nama'];
                $data[$key]['uraian'] = $value['uraian'];
                $data[$key]['satuan'] = $value['satuan'];
                $data[$key]['material'] = $value['material'];
                $data[$key]['jasa'] = $value['jasa'];
                $data[$key]['created_at'] = Carbon::now();
                $data[$key]['updated_at'] = Carbon::now();
                
            }
            if($this->status == "pass"){
                KhsAmandemenDesignator::where('khs_amandemen_id', $this->khsId)->forceDelete();
                KhsAmandemenDesignator::insert($data);
            }

        }
    }
    public function runCallBack()
    {
        return $this->status;
    }
}
