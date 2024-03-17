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
        // dd(count($row));
        $index=0;
        foreach ($row as $i => $v) {
            
            if (
                !is_null($v['vol']) && 
                !is_null($v['material']) && 
                !is_null($v['jasa']) && 
                $v['vol']!='x' && 
                $v['material']!='x' && 
                $v['jasa']!='x'
            ) {
                $data[$index]['khs_induk_id'] = $this->khsId;
                $v['material_designator'] = $v['material_designator']==''?'-':$v['material_designator'];
                $v['jasa_designator'] = $v['jasa_designator']==''?'-':$v['jasa_designator'];
                $v['item_designator_osp_fo'] = $v['item_designator_osp_fo']==''?'-':$v['item_designator_osp_fo'];

                $data[$index]['nama_material'] = $v['material_designator'];
                $data[$index]['nama_jasa'] = $v['jasa_designator'];
                $data[$index]['nama'] = $v['item_designator_osp_fo'];
                $data[$index]['uraian'] = $v['uraian_pekerjaan'];
                $data[$index]['satuan'] = $v['satuan'];

                if(!is_numeric($v['material'] || is_null($v['material']))){
                    // $this->status = "harga pada kolom material tidak valid (baris ke-".($i).")";
                    $v['material'] = 0;
                }
                if(!is_numeric($v['jasa'] || is_null($v['jasa']))){
                    // $this->status = "harga pada kolom jasa tidak valid (baris ke-".($i).")";
                    $v['jasa'] = 0;
                }
                $data[$index]['material'] = $v['material'];
                $data[$index]['jasa'] = $v['jasa'];
                $index++;
            }elseif (
                $v['vol']=='x' && 
                $v['material']=='x' && 
                $v['jasa']=='x'
            ) {
                break;
            }

        }
        // dd($data);
        if($this->status == "pass"){
            KhsIndukDesignator::where('khs_induk_id', $this->khsId)->forceDelete();
            KhsIndukDesignator::insert($data);
        }
        
    }

    public function runCallBack()
    {
        return $this->status;
    }
}
