<?php

namespace App\Livewire\Tagihan;

use App\Models\SpInduk;
use App\Models\Tagihan;
use App\Models\TagihanHistory;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteTagihan extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div>
            {{-- The whole world belongs to you. --}}
        </div>
        HTML;
    }

    #[On('deletetagihan-delete')]
    public function delete($data)
    {
        $spId = Tagihan::select('sp_induk_id')->first()->getAttribute('sp_induk_id');
        TagihanHistory::where('tagihan_id', $data['id'])->delete();
        Tagihan::where('id', $data['id'])->delete();
        SpInduk::find($spId)->update(['status' => 1]);
        $this->dispatch('reloadDT',data:'dtTable');
        $this->dispatch('alert', data:['type' => 'success',  'message' => 'Tagihan '.$data['attr'].' telah berhasil dihapus']);
    }
}
