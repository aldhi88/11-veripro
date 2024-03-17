<?php

namespace App\Livewire\Khs;

use App\Models\KhsInduk;
use App\Models\KhsIndukDesignator;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteKhs extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div>
            {{-- Be like water. --}}
        </div>
        HTML;
    }

    #[On('deletekhs-delete')] 
    public function delete($data)
    {
        KhsInduk::where('id', $data['id'])->delete();
        KhsIndukDesignator::where('khs_induk_id', $data['id'])->forceDelete();
        $this->dispatch('reloadDT',data:'dtTable');
        $this->dispatch('alert', data:['type' => 'success',  'message' => 'KHS '.$data['attr'].' telah berhasil dihapus']);
    }
}
