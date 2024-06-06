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
    public function render()
    {
        return view('mods.ba.form_file_ba');
    }

    public function mount($data)
    {
        $this->dtFileBa = Tagihan::dtFileBa();
        $this->dtTitleBa = Tagihan::dtTitleBa();
    }

    #[On('fileba-setup')]
    public function setup($data)
    {
        $this->tagihanId = $data;
        $this->statusTagihan = Tagihan::select('status')->where('id',$this->tagihanId)
            ->first()->getAttribute('status');
        if($this->statusTagihan == 8){
            $ary = [];
            foreach ($this->dtFileBa as $key => $value) {

                if($key <= 13){
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
                if($key!=6 || $key!=5){
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
