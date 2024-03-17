<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\BeforeSheet;

class DesigImport implements WithMultipleSheets
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

    public function sheets(): array
    {
        $callback = function ($index, $data) {
            if($index==$this->jlhLokasi){
                call_user_func($this->callback, $data);
            }
        };

        session()->forget(['dtLok', 'dtError']);

        for ($i=0; $i < $this->jlhLokasi; $i++) { 
            $data[$i] = new DesigImportPerSheet($callback, $i,$this->dtDesigAcuan);
        }

        return $data;
        
    }

}
