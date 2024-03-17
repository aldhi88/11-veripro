<?php

namespace App\Livewire\Dashboard;

use App\Models\Tagihan;
use Livewire\Component;

class TableDashboard extends Component
{
    public function render()
    {
        return view('mods.dashboard.table');
    }

    public $status;
    public function mount()
    {
        $this->status = Tagihan::dtStatus();
    }
}
