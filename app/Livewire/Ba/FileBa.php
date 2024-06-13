<?php

namespace App\Livewire\Ba;

use App\Models\Tagihan;
use Livewire\Attributes\On;
use Livewire\Component;

class FileBa extends Component
{
    public $dtFileBa;
    public $dtTitleBa;
    public $file = [];
    public $isChecked = null;
    public $url = null;
    public $tagihanId = null;
    public $statusTagihan = null;
    public $dtTagihan;
    public function render()
    {
        return view('mods.ba.form_file_ba');
    }

    public function mount($data)
    {
        $this->dtFileBa = Tagihan::dtFileBa();
        $this->dtTitleBa = Tagihan::dtTitleBa();
        // dd($this->all());
    }

    #[On('fileba-setup')]
    public function setup($data)
    {
        $this->tagihanId = $data;
        $this->dtTagihan = Tagihan::query()
            ->where('id',$this->tagihanId)
            ->first()
            ->toArray();

        $this->statusTagihan = $this->dtTagihan['status'];
        $this->dtTagihan['json'] = json_decode($this->dtTagihan['json'],true);

        if(
            isset($this->dtTagihan['json']['dt_tagihan']['dt_turnkey']['tgl_turnkey']) ||
            is_null($this->dtTagihan['json']['dt_tagihan']['dt_turnkey']['tgl_turnkey']) ||
            $this->dtTagihan['json']['dt_tagihan']['dt_turnkey']['tgl_turnkey'] == ""
        ){
            $ary = [];
            foreach ($this->dtFileBa as $key => $value) {

                if(
                    $value != '9_surat_pernyataan_material_turnkey' &&
                    $value != '10_ba_legalitas'
                ){
                    $ary[$key] = $value;
                }
            }
            $this->dtFileBa = $ary;
        }

        if($this->statusTagihan <= 8){
            $ary = [];
            foreach ($this->dtFileBa as $key => $value) {
                if(
                    $value != '14_surat_permohonan_bayar' &&
                    $value != '15_invoice' &&
                    $value != '16_kwitansi'
                ){
                    $ary[$key] = $value;
                }
            }
            $this->dtFileBa = $ary;
        }

        if(
            !isset($this->dtTagihan['json']['dt_tagihan']['aman_penutup']) ||
            is_null($this->dtTagihan['json']['dt_tagihan']['aman_penutup']) ||
            $this->dtTagihan['json']['dt_tagihan']['aman_penutup'] == ""
        ){
            $ary = [];
            foreach ($this->dtFileBa as $key => $value) {
                if(
                    $value != '12_amandemen_penutup'
                ){
                    $ary[$key] = $value;
                }
            }
            $this->dtFileBa = $ary;
        }

        if(count($this->dtTagihan['json']['dt_tagihan']['dt_gudang']['all_desig'])==0){
            $ary = [];
            foreach ($this->dtFileBa as $key => $value) {
                if(
                    $value != '5_ba_penggunaan_material'
                ){
                    $ary[$key] = $value;
                }
            }
            $this->dtFileBa = $ary;
        }
        // dd($this->dtFileBa);
    }

    public function makeUrl()
    {
        // dd($this->all());
        $this->url = null;
        foreach ($this->file as $key => $value) {
            if($key>0){
                $this->url .= ',';
            }
            $this->url .= $value;
        }
    }

    public function checkUncheck()
    {
        if(is_null($this->isChecked)){
            $this->isChecked = 'checked';
            foreach ($this->dtFileBa as $key => $value) {
                if($key!=6){
                    $this->file[] = $key;
                }
            }


        }else{
            $this->isChecked = null;
            $this->file = [];
        }



        $this->makeUrl();
        // dd($this->all());
    }


}
