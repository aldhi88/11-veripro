<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LokasiImport implements ToCollection, WithHeadingRow
{
    private $callback;
    private $jlhLokasi;
    private $dtDesigAcuan = [];

    public function __construct($callback, $jlhLokasi, $dtDesigAcuan)
    {
        $this->callback = $callback;
        $this->jlhLokasi = $jlhLokasi;
        $this->dtDesigAcuan = $dtDesigAcuan;
    }

    public function collection(Collection $row)
    {
        $row = $row->toArray();
        // dump($this->jlhLokasi,$this->dtDesigAcuan);
        $iLok=0;
        $grand_total_material=0;
        $grand_total_jasa=0;
        $grand_total=0;
        for ($i=9; $i < (9+$this->jlhLokasi); $i++) { 
            $data['lokasi'][$iLok]['sto'] = $row[0][$i];
            $data['lokasi'][$iLok]['id_project'] = $row[1][$i];
            $data['lokasi'][$iLok]['nama_lokasi'] = $row[2][$i];

            $iDes=0;
            $total_material_lokasi=0;
            $total_jasa_lokasi=0;
            $total_lokasi=0;
            foreach ($row as $iRow => $vRow) {

                if($vRow[0]=='ZZ'){ break; }

                if($iRow>=5){
                    if(!is_null($vRow[$i])){
                        $data['lokasi'][$iLok]['desigs'][$iDes]['nama_material'] = $vRow['nama_material'];
                        $data['lokasi'][$iLok]['desigs'][$iDes]['nama_jasa'] = $vRow['nama_jasa'];
                        $data['lokasi'][$iLok]['desigs'][$iDes]['nama_designator'] = $vRow['nama_designator'];
                        $data['lokasi'][$iLok]['desigs'][$iDes]['uraian'] = $vRow['uraian'];
                        $data['lokasi'][$iLok]['desigs'][$iDes]['satuan'] = $vRow['satuan'];
                        $data['lokasi'][$iLok]['desigs'][$iDes]['material'] = $vRow['material'];
                        $data['lokasi'][$iLok]['desigs'][$iDes]['jasa'] = $vRow['jasa'];
                        $data['lokasi'][$iLok]['desigs'][$iDes]['vol'] = $vRow[$i];
                        $data['lokasi'][$iLok]['desigs'][$iDes]['total_material'] = $vRow['material']*$vRow[$i];
                        $data['lokasi'][$iLok]['desigs'][$iDes]['total_jasa'] = $vRow['jasa']*$vRow[$i];
                        $data['lokasi'][$iLok]['desigs'][$iDes]['total'] = ($vRow['material']*$vRow[$i])+($vRow['jasa']*$vRow[$i]);

                        $total_material_lokasi = $total_material_lokasi + 
                            $data['lokasi'][$iLok]['desigs'][$iDes]['total_material'];
                        $total_jasa_lokasi = $total_jasa_lokasi + 
                            $data['lokasi'][$iLok]['desigs'][$iDes]['total_jasa'];
                        $total_lokasi = $total_lokasi + 
                            $data['lokasi'][$iLok]['desigs'][$iDes]['total'];

                        $iDes++;
                    }
                }
            }

            $data['lokasi'][$iLok]['total_material_lokasi'] = $total_material_lokasi;
            $data['lokasi'][$iLok]['total_jasa_lokasi'] = $total_jasa_lokasi;
            $data['lokasi'][$iLok]['total_lokasi'] = $total_lokasi;

            $grand_total_material = $grand_total_material + $total_material_lokasi;
            $grand_total_jasa = $grand_total_jasa + $total_jasa_lokasi;
            $grand_total = $grand_total + $total_lokasi;

            $data['grand_total_material'] = $grand_total_material;
            $data['grand_total_jasa'] = $grand_total_jasa;
            $data['grand_total'] = $grand_total;

            $iLok++;
        }

        $dt['dtLok'] = $data;
        $dt['dtError'] = [];
        call_user_func($this->callback, $dt);
        // dd($data);
    }
}
