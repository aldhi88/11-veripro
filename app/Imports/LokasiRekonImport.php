<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LokasiRekonImport implements ToCollection, WithHeadingRow
{
    private $callback;
    private $jlhLokasi;
    private $lokasiSp;
    private $error;
    private $call;

    public function __construct($callback, $jlhLokasi, $lokasiSp)
    {
        $this->callback = $callback;
        $this->jlhLokasi = $jlhLokasi;
        $this->lokasiSp = $lokasiSp;
        $this->error = 'pass';
        $this->call = 1;
        
    }

    public function collection(Collection $row)
    {
        if($this->call == 1){
            $row = $row->toArray();

            $data = $this->lokasiSp;
            // dump($this->lokasiSp);
    
            $iLok=0;
            
            $grand_total_material=0;
            $grand_total_jasa=0;
            $grand_total=0;
            
            // dump($data);
            for ($i=9; $i < (9+$this->jlhLokasi); $i++) { 
                $lokMatTambah = 0;
                $lokJasTambah = 0;
                $lokMatKurang = 0;
                $lokJasKurang = 0;
                $lokTambah = 0;
                $lokKurang = 0;
                
                if(
                    $this->lokasiSp['lokasi'][$iLok]['sto'] != $row[0][$i] || 
                    $this->lokasiSp['lokasi'][$iLok]['id_project'] != $row[1][$i] || 
                    $this->lokasiSp['lokasi'][$iLok]['nama_lokasi'] != $row[2][$i]
                ){
                    $this->error = [
                        'Terjadi perubahahan lokasi, 
                        pastikan menggunakan file excel dari procurement. 
                        Untuk perubahan lokasi silahkan hubungi procurement'
                    ];
                    break;
                }else{
                    $data['lokasi'][$iLok]['sto'] = $row[0][$i];
                    $data['lokasi'][$iLok]['id_project'] = $row[1][$i];
                    $data['lokasi'][$iLok]['nama_lokasi'] = $row[2][$i];
                    unset($data['lokasi'][$iLok]['desig_items']);
                }
    
                $iDes=0;
                $total_material_lokasi=0;
                $total_jasa_lokasi=0;
                $total_lokasi=0;

                $lokCek = collect($this->lokasiSp['lokasi'][$iLok]['desig_items']);
                foreach ($row as $iRow => $vRow) {
                    if($vRow[0]=='ZZ'){ break; }
    
                    if($iRow>=5){
                        if(!is_null($vRow[$i])){
                            
                            $result = $lokCek->first(function ($value, $key) use($vRow) {
                                return $value['nama_material'] === $vRow['nama_material'] && 
                                    $value['nama_jasa'] === $vRow['nama_jasa'] && 
                                    $value['nama_designator'] === $vRow['nama_designator'];
                            });

                            if(!is_null($result)){
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['nama_material'] = $result['nama_material'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['nama_jasa'] = $result['nama_jasa'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['nama_designator'] = $result['nama_designator'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['uraian'] = $result['uraian'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['satuan'] = $result['satuan'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['material'] = $result['material'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['jasa'] = $result['jasa'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['vol'] = $result['vol'];
                            }else{
                                $vRow['nama_material'] = ($vRow['nama_material']==''||$vRow['nama_material']=='-')?null:$vRow['nama_material'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['nama_material'] = $vRow['nama_material'];
                                $vRow['nama_jasa'] = ($vRow['nama_jasa']==''||$vRow['nama_jasa']=='-')?null:$vRow['nama_jasa'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['nama_jasa'] = $vRow['nama_jasa'];
                                $vRow['nama_designator'] = ($vRow['nama_designator']==''||$vRow['nama_designator']=='-')?null:$vRow['nama_designator'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['nama_designator'] = $vRow['nama_designator'];

                                $data['lokasi'][$iLok]['desig_items'][$iDes]['uraian'] = $vRow['uraian'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['satuan'] = $vRow['satuan'];
                                $vRow['material'] = ($vRow['material']=='-'||$vRow['material']=='')?0:$vRow['material'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['material'] = $vRow['material'];
                                $vRow['jasa'] = ($vRow['jasa']=='-'||$vRow['jasa']=='')?0:$vRow['jasa'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['jasa'] = $vRow['jasa'];
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['vol'] = 0;
                            }
                            
                            $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material'] = 
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['material'] * 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['vol'];
                                
                            $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa'] = 
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['jasa'] * 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['vol'];

                            $data['lokasi'][$iLok]['desig_items'][$iDes]['total'] = 
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material'] + 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa'];
                                
                            $data['lokasi'][$iLok]['desig_items'][$iDes]['volume_rekon'] = $vRow[$i];
                            $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material_rekon'] = $vRow['material']*$vRow[$i];
                            $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa_rekon'] = $vRow['jasa']*$vRow[$i];
                            $data['lokasi'][$iLok]['desig_items'][$iDes]['total_rekon'] = ($vRow['material']*$vRow[$i])+($vRow['jasa']*$vRow[$i]);

                            $data['lokasi'][$iLok]['desig_items'][$iDes]['volume_tambah'] = 0;
                            $data['lokasi'][$iLok]['desig_items'][$iDes]['volume_kurang'] = 0;

                            if(
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['vol'] < 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['volume_rekon']
                            ){
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['volume_tambah'] = 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['volume_rekon'] - 
                                        $data['lokasi'][$iLok]['desig_items'][$iDes]['vol'];
                            }else if(
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['vol'] > 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['volume_rekon']
                            ){
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['volume_kurang'] = 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['vol'] - 
                                        $data['lokasi'][$iLok]['desig_items'][$iDes]['volume_rekon'];
                            }

                            $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material_tambah'] = 0;
                            $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa_tambah'] = 0;
                            $data['lokasi'][$iLok]['desig_items'][$iDes]['total_tambah'] = 0;
                            $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material_kurang'] = 0;
                            $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa_kurang'] = 0;
                            $data['lokasi'][$iLok]['desig_items'][$iDes]['total_kurang'] = 0;

                            if(
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material'] < 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material_rekon']
                            ){
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material_tambah'] = 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material_rekon'] - 
                                        $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material'];
                            }else if(
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material'] > 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material_rekon']
                            ){
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material_kurang'] = 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material'] - 
                                        $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material_rekon'];
                            }
                
                            if(
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa'] < 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa_rekon']
                            ){
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa_tambah'] = 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa_rekon'] - 
                                        $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa'];
                            }else if(
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa'] > 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa_rekon']
                            ){
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa_kurang'] = 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa'] - 
                                        $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa_rekon'];
                            }
                            
                            if(
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total'] < 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total_rekon']
                            ){
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_tambah'] = 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total_rekon'] - 
                                        $data['lokasi'][$iLok]['desig_items'][$iDes]['total'];
                            }else if(
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total'] > 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total_rekon']
                            ){
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_kurang'] = 
                                    $data['lokasi'][$iLok]['desig_items'][$iDes]['total'] - 
                                        $data['lokasi'][$iLok]['desig_items'][$iDes]['total_rekon'];
                            }

                            $total_material_lokasi = $total_material_lokasi + 
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material_rekon'];
                            $total_jasa_lokasi = $total_jasa_lokasi + 
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa_rekon'];
                            $total_lokasi = $total_lokasi + 
                                $data['lokasi'][$iLok]['desig_items'][$iDes]['total_rekon'];

                            $lokMatTambah = $lokMatTambah + $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material_tambah'];
                            $lokJasTambah = $lokJasTambah + $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa_tambah'];
                            $lokMatKurang = $lokMatKurang + $data['lokasi'][$iLok]['desig_items'][$iDes]['total_material_kurang'];
                            $lokJasKurang = $lokJasKurang + $data['lokasi'][$iLok]['desig_items'][$iDes]['total_jasa_kurang'];
                            $lokTambah = $lokTambah + $data['lokasi'][$iLok]['desig_items'][$iDes]['total_tambah'];
                            $lokKurang = $lokKurang + $data['lokasi'][$iLok]['desig_items'][$iDes]['total_kurang'];
    
                            $iDes++;
                        }
                    }
                }
    
                $data['lokasi'][$iLok]['total_material_lokasi_rekon'] = $total_material_lokasi;
                $data['lokasi'][$iLok]['total_jasa_lokasi_rekon'] = $total_jasa_lokasi;
                $data['lokasi'][$iLok]['total_lokasi_rekon'] = $total_lokasi;

                $data['lokasi'][$iLok]['total_material_lokasi_tambah'] = $lokMatTambah;
                $data['lokasi'][$iLok]['total_jasa_lokasi_tambah'] = $lokJasTambah;
                $data['lokasi'][$iLok]['total_material_lokasi_kurang'] = $lokMatKurang;
                $data['lokasi'][$iLok]['total_jasa_lokasi_kurang'] = $lokJasKurang;
                $data['lokasi'][$iLok]['total_lokasi_tambah'] = $lokTambah;
                $data['lokasi'][$iLok]['total_lokasi_kurang'] = $lokKurang;

                $grand_total_material = $grand_total_material + $total_material_lokasi;
                $grand_total_jasa = $grand_total_jasa + $total_jasa_lokasi;
                $grand_total = $grand_total + $total_lokasi;
                $data['grand_total_material_rekon'] = $grand_total_material;
                $data['grand_total_jasa_rekon'] = $grand_total_jasa;
                $data['grand_total_rekon'] = $grand_total;
    
                $iLok++;
            }

            if(
                $data['grand_total_material'] < 
                    $data['grand_total_material_rekon']
            ){
                $data['grand_total_material_tambah'] = 
                    $data['grand_total_material_rekon'] - 
                        $data['grand_total_material'];
            }else if(
                $data['grand_total_material'] > 
                    $data['grand_total_material_rekon']
            ){
                $data['grand_total_material_kurang'] = 
                    $data['grand_total_material'] - 
                        $data['grand_total_material_rekon'];
            }
    
            if(
                $data['grand_total_jasa'] < 
                    $data['grand_total_jasa_rekon']
            ){
                $data['grand_total_jasa_tambah'] = 
                    $data['grand_total_jasa_rekon'] - 
                        $data['grand_total_jasa'];
            }else if(
                $data['grand_total_jasa'] > 
                    $data['grand_total_jasa_rekon']
            ){
                $data['grand_total_jasa_kurang'] = 
                    $data['grand_total_jasa'] - 
                        $data['grand_total_jasa_rekon'];
            }
    
            if(
                $data['grand_total'] < 
                    $data['grand_total_rekon']
            ){
                $data['grand_total_tambah'] = 
                    $data['grand_total_rekon'] - 
                        $data['grand_total'];
            }else if(
                $data['grand_total'] > 
                    $data['grand_total_rekon']
            ){
                $data['grand_total_kurang'] = 
                    $data['grand_total'] - 
                        $data['grand_total_rekon'];
            }
            // dd($data);
    
            $dt['dtLok'] = $data;
            $dt['dtError'] = $this->error;
            call_user_func($this->callback, $dt);
            $this->call = 2;

        }
    }
}
