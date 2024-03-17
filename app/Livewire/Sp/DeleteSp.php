<?php

namespace App\Livewire\Sp;

use App\Models\SpInduk;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteSp extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div>
            {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
        </div>
        HTML;
    }

    #[On('deletesp-delete')] 
    public function delete($data)
    {
        SpInduk::where('id', $data['id'])->delete();
        $this->dispatch('reloadDT',data:'dtTable');
        $this->dispatch('alert', data:['type' => 'success',  'message' => 'SP '.$data['attr'].' telah berhasil dihapus']);
    }
}
