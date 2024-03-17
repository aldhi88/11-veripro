<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DesigImportPerSheet implements ToCollection
{
    private $callback;

    private $index;
    private $dtDesigAcuan = [];
    private $return = [];

    public function __construct($callback, $index, $dtDesigAcuan) {
        $this->callback = $callback;
        $this->index = $index;
        $this->dtDesigAcuan = $dtDesigAcuan;
    }

    public function collection(Collection $collection)
    {
        $dtAcuan = collect($this->dtDesigAcuan);
        $data = $collection->toArray();
        $dtError = null;
        $dtLok['total_material_all'] = 0;
        $dtLok['total_jasa_all'] = 0;
        $dtLok['total_all'] = 0;
        if (session()->has('dtLok')) {
            $dtLok['total_material_all'] = session('dtLok')['total_material_all'];
            $dtLok['total_jasa_all'] = session('dtLok')['total_jasa_all'];
            $dtLok['total_all'] = session('dtLok')['total_all'];
        }

        $dtLok['lokasi'][$this->index]['nama_lokasi'] = $data[1][1];
        $dtLok['lokasi'][$this->index]['nama_sto'] = $data[1][2];
        $dtLok['lokasi'][$this->index]['id_project'] = $data[1][3];
        $dtLok['lokasi'][$this->index]['total_material_lokasi'] = 0;
        $dtLok['lokasi'][$this->index]['total_jasa_lokasi'] = 0;
        $dtLok['lokasi'][$this->index]['total_lokasi'] = 0;

        $dtLok['lokasi'][$this->index]['desigs'] = [];
        
        $iDtLok=0;
        $iDtError=0;
        foreach ($data as $key => $value) {
            if($key >= 4 && !is_null($value[7])){
                $cek = $dtAcuan->where('nama_material', $value[1])
                    ->where('nama_jasa', $value[2])
                    ->where('nama', $value[3])
                    ->values()
                    ->toArray();
                if(count($cek)==1){
                    $desigAcuan = $cek[0];
                    $dtLok['lokasi'][$this->index]['desigs'][$iDtLok] = $desigAcuan;
                    $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['material'] = $desigAcuan['fix_price']==1?$desigAcuan['material']:$value[4];
                    $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['material_mitra'] = $value[5]=='ya'?true:false;
                    $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['jasa'] = $desigAcuan['fix_price']==1?$desigAcuan['jasa']:$value[6];
                    $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['vol'] = $value[7];
                    $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['total_material'] = 
                        $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['material']*
                        $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['vol'];
                    $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['total_jasa'] = 
                        $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['jasa']*
                        $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['vol'];
                    $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['total'] = 
                        $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['total_material']+
                        $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['total_jasa'];

                    $dtLok['lokasi'][$this->index]['total_material_lokasi'] = 
                        $dtLok['lokasi'][$this->index]['total_material_lokasi']+
                        $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['total_material'];
                    $dtLok['lokasi'][$this->index]['total_jasa_lokasi'] = 
                        $dtLok['lokasi'][$this->index]['total_jasa_lokasi']+
                        $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['total_jasa'];
                    $dtLok['lokasi'][$this->index]['total_lokasi'] = 
                        $dtLok['lokasi'][$this->index]['total_lokasi']+
                        $dtLok['lokasi'][$this->index]['desigs'][$iDtLok]['total'];
                    $iDtLok++;
                }else{
                    $dtError[$this->index][$iDtError]['row'] = $key-3;
                    $iDtError++;
                }
            }
        }

        $dtLok['total_material_all'] = 
            $dtLok['total_material_all']+
            $dtLok['lokasi'][$this->index]['total_material_lokasi'];
        $dtLok['total_jasa_all'] = 
            $dtLok['total_jasa_all']+
            $dtLok['lokasi'][$this->index]['total_jasa_lokasi'];
        $dtLok['total_all'] = 
            $dtLok['total_all']+
            $dtLok['lokasi'][$this->index]['total_lokasi'];

        if (session()->has('dtLok')) {
            $dtSesLok = collect(session('dtLok')['lokasi']);
            $dtLok['lokasi'] = $dtSesLok->merge($dtLok['lokasi'])->toArray();
        }
        if (session()->has('dtError') && !is_null(session()->has('dtError'))) {
            $dtErrorSes = collect(session('dtError'));
            $dtError = $dtErrorSes->merge($dtError)->toArray();
        }
        session([
            'dtLok' => $dtLok,
            'dtError' => $dtError,
        ]);

        $this->return['data'] = $dtLok;
        $this->return['error'] = $dtError;

        // dump($this->return);
        call_user_func($this->callback, $this->index+1, $this->return);
    }

}
