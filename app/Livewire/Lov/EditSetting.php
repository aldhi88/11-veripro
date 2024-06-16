<?php

namespace App\Livewire\Lov;

use App\Models\Lov;
use Livewire\Component;
use Livewire\Attributes\On;


class EditSetting extends Component
{
    public $keyword = '';
    public $value = '';
    public $dtEdit = [];

    public function rules()
    {
        return [
            "value" => "required",
            "keyword" => "required",
        ];
    }

    public $validationAttributes = [
        "value" => "Value",
    ];

    public function render()
    {
        return view("mods.lov.edit_setting");
    }

    public function edit()
    {
        $collection = collect($this->dtEdit);

        $collection['value'] = collect($collection['value'])->transform(function ($item) {
            if ($item['key'] === 'toc') {
                $item['value'] = $this->value;
            }
            return $item;
        });

        $data = $collection->toArray()['value'];

        Lov::where('key', 'setting')->update(['value' => json_encode($data)]);

        $this->dispatch('closeModal',id:'editModal');
        $this->dispatch('reloadDT',data:'dtTable');
        $this->dispatch('alert', data:['type' => 'success',  'message' => 'Data berhasil di perbaharui.']);

    }


    #[On('editlov-prepareEditModal')]
    public function prepareEditModal($param)
    {
        $this->keyword = $param;
        $this->resetValidation();
        $dt = Lov::select('id','key','value')
            ->where('key', 'setting')
            ->first()
            ->toArray();
        $this->dtEdit = $dt;
        $dt = collect($dt['value'])->where('key',$param)->toArray()[0];

        $this->value = $dt['value'];
    }
}
