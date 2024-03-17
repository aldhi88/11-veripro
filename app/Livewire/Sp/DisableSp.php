<?php

namespace App\Livewire\Sp;

use App\Models\SpInduk;
use Livewire\Attributes\On;
use Livewire\Component;

class DisableSp extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div>
            {{-- Be like water. --}}
        </div>
        HTML;
    }

    #[On('disablesp-disable')] 
    public function disable($data)
    {
        SpInduk::where('id', $data['id'])->update(['status' => 0]);
        $this->dispatch('reloadDT',data:'dtTable');
        $this->dispatch('alert', data:['type' => 'success',  'message' => 'SP '.$data['attr'].' telah berhasil dihapus']);
    }
}
