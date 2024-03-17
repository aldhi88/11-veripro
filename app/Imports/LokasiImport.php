<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class LokasiImport implements ToCollection
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
        dd($row->toArray());
    }
}
