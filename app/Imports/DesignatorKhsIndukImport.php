<?php

namespace App\Imports;

use App\Models\KhsIndukDesignator;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;


class DesignatorKhsIndukImport implements ToCollection, WithHeadingRow
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
        $row = $row->toArray();
        $fieldList = [
            'nama_material',
            'nama_jasa',
            'nama_designator',
            'uraian',
            'satuan',
            'material',
            'jasa'
        ];

        $fieldFile = array_keys($row[0]);
        $cek = empty(array_diff($fieldList, $fieldFile));

        if(!$cek){
            $this->status = "nama kolom pada excel tidak sesuai template.";
        }else{

            $index=0;
            $open = true;
            foreach ($row as $i => $v) {
                if (
                    $v['vol']=='Z' && 
                    $v['material']=='Z' && 
                    $v['jasa']=='Z'
                ) {
                    $open = false;
                    break;
                }
    
                if($open){
                    if (
                        !is_null($v['vol']) && 
                        !is_null($v['material']) && 
                        !is_null($v['jasa']) 
                    ) {
                        $data[$index]['khs_induk_id'] = $this->khsId;
                        $v['nama_material'] = $v['nama_material']==''?'-':$v['nama_material'];
                        $v['nama_jasa'] = $v['nama_jasa']==''?'-':$v['nama_jasa'];
                        $v['nama_designator'] = $v['nama_designator']==''?'-':$v['nama_designator'];
        
                        $data[$index]['nama_material'] = $v['nama_material'];
                        $data[$index]['nama_jasa'] = $v['nama_jasa'];
                        $data[$index]['nama'] = $v['nama_designator'];
                        $data[$index]['uraian'] = $v['uraian'];
                        $data[$index]['satuan'] = $v['satuan'];
        
                        $v['material'] = str_replace(".", "", $v['material']);
                        $v['jasa'] = str_replace(".", "", $v['jasa']);
        
                        if(!is_numeric($v['material']) || is_null($v['material'])){
                            $v['material'] = 0;
                        }
                        if(!is_numeric($v['jasa']) || is_null($v['jasa'])){
                            $v['jasa'] = 0;
                        }
                        $data[$index]['material'] = $v['material'];
                        $data[$index]['jasa'] = $v['jasa'];
                        $index++;
                    }
                }
            }
            // dd($data);
            if($this->status == "pass"){
                KhsIndukDesignator::where('khs_induk_id', $this->khsId)->forceDelete();
                KhsIndukDesignator::insert($data);
            }
        }
        
        
    }

    public function runCallBack()
    {
        return $this->status;
    }
}
