<?php

namespace App\Livewire\Lov;

use App\Models\Lov;
use Livewire\Attributes\On;
use Livewire\Component;

class EditLov extends Component
{
    public $keyword;
    public $value;
    public $editId;
    
    public function rules()
    {
        return [
            "keyword" => "required",
            "value" => "required",
            "editId" => "required",
        ];
    }

    public $validationAttributes = [
        "value" => "Nilai",
    ];

    public function render()
    {
        return view("mods.lov.edit_lov");
    }

    public function edit()
    {
        $formData = $this->validate();
        $this->value['nama'] = array_filter($this->value['nama']);
        $this->value['jabatan'] = array_filter($this->value['jabatan']);

        Lov::find($this->editId)->update(['value' => json_encode($this->value)]);
        $this->dispatch('closeModal',id:'editModal');
        $this->dispatch('reloadDT',data:'dtTable');
        $this->dispatch('alert', data:['type' => 'success',  'message' => 'Data berhasil di perbaharui.']);
    }

    public function addList($i, $type)
    {
        $this->value[$type][$i] = '';
    }

    public function removeList($i, $type)
    {
        unset($this->value[$type][$i]);
        $this->value[$type] = array_values($this->value[$type]);
    }

    #[On('editlov-prepareEditModal')] 
    public function prepareEditModal($param)
    {
        $this->resetValidation();
        $dt = Lov::select('id','key','value')
            ->where('id', $param)
            ->first()
            ->toArray();
        $this->editId = $dt['id'];
        $this->keyword = $dt['key'];
        $this->value['nama'] = $dt['value']['nama'];
        $this->value['jabatan'] = $dt['value']['jabatan'];
    }


}