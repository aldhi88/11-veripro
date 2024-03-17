<?php

namespace App\Livewire\Account;

use App\Models\AuthLogin;
use Livewire\Attributes\On;
use Livewire\Component;

class ApproveMitra extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div>
            {{-- Stop trying to control. --}}
        </div>
        HTML;
    }

    #[On('approvemitra-approve')] 
    public function approve($data)
    {
        AuthLogin::where('id', $data['id'])->update(['status' => 1]);
        $this->dispatch('reloadDT',data:'dtTable');
        $this->dispatch('alert', data:['type' => 'success',  'message' => 'Akun '.$data['attr'].' telah disetuji']);
        $this->dispatch('mainmenu-mount');
    }
}
