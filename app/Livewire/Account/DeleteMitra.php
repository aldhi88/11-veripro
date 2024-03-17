<?php

namespace App\Livewire\Account;

use App\Models\AuthLogin;
use App\Models\MasterUser;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteMitra extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div>
            {{-- Be like water. --}}
        </div>
        HTML;
    }

    #[On('deletemitra-delete')] 
    public function delete($data)
    {
        AuthLogin::where('id', $data['id'])->delete();
        MasterUser::where('auth_login_id', $data['id'])->delete();
        $this->dispatch('reloadDT',data:'dtTable');
        $this->dispatch('alert', data:['type' => 'success',  'message' => 'Akun '.$data['attr'].' telah berhasil dihapus']);
        $this->dispatch('mainmenu-mount');
    }
}
