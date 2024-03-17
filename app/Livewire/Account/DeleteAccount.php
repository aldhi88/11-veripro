<?php

namespace App\Livewire\Account;

use App\Models\AuthLogin;
use App\Models\MasterUser;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteAccount extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div>
            {{-- Because she competes with no one, no one can compete with her. --}}
        </div>
        HTML;
    }


    #[On('deleteaccount-delete')] 
    public function delete($data)
    {
        AuthLogin::where('id', $data['id'])->delete();
        MasterUser::where('auth_login_id', $data['id'])->delete();
        $this->dispatch('reloadDT',data:'dtTable');
        $this->dispatch('alert', data:['type' => 'success',  'message' => 'Akun '.$data['attr'].' telah berhasil dihapus']);
    }
}
