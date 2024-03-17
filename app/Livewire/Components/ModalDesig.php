<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class ModalDesig extends Component
{
    public $data;
    public $route = null;
    public $desigs = [];
    public $result = [];
    public $nama = "";
    public $nama_material = "";
    public $nama_jasa = "";

    public function render()
    {
        return view('components.modal.modal_desig');
    }

    #[On('modaldesig-prepare')] 
    public function prepare($data)
    {
        $this->data = $data;
        $this->desigs = $data['desigs'];
        $this->result = $this->desigs;
        $this->dispatch('reinit-dt');
        
    }

    public function updating($property, $value)
    {
        // $this->search($value);
        if($property === 'nama'){
            $this->result = collect($this->desigs);
            $this->collectionWhereLike($this->result, 'nama', $value);
        }
        // $this->result = collect($this->desigs);
        
        // if($value != ''){
        //     $filter = $this->collectionWhereLike($this->result, 'nama', $this->nama);
        //     $this->result = $filter->toArray();
        // }

        // dump($filter);
        
    }


    public function collectionWhereLike($collection, $key, $term)
    {
        $filtered = $collection->filter(fn ($item) => Str::contains($item[$key], $term));
        $filtered->all();
        $this->result = array_values($filtered->toArray());
    }

    
}
