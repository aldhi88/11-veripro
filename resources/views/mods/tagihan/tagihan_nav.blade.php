<ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
    @if ($status==9 || $status==11)
    <li class="nav-item" wire:click="changeTab(-4)"  style="cursor: pointer">
        <a class="nav-link {{ $tab==-4?'active':null }}">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">Approvement</span> 
        </a>
    </li>
    @endif

    @if (
        $status==3 || 
        $status==6 || 
        $status==10
    )
    <li class="nav-item" wire:click="changeTab(0)"  style="cursor: pointer">
        <a class="nav-link {{ $tab==0?'active':null }}">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">Revisi</span> 
        </a>
    </li>
    @endif

    @if ($status>=8)
    <li class="nav-item" wire:click="changeTab(-3)"  style="cursor: pointer">
        <a class="nav-link {{ $tab==-3?'active':null }}">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">Invoice</span> 
        </a>
    </li>
    @endif
    
    @if ($status!=6)
    <li class="nav-item" wire:click="changeTab(-2)"  style="cursor: pointer">
        <a class="nav-link {{ $tab==-2?'active':null }}">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">BAST</span> 
        </a>
    </li>
    @endif
    @if ($status!=3)
    <li class="nav-item" wire:click="changeTab(-1)"  style="cursor: pointer">
        <a class="nav-link {{ $tab==-1?'active':null }}">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">Nodin</span> 
        </a>
    </li>
    @endif
    <li class="nav-item" wire:click="changeTab(1)"  style="cursor: pointer">
        <a class="nav-link {{ $tab==1?'active':null }}">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">Tagihan</span> 
        </a>
    </li>
    <li class="nav-item" wire:click="changeTab(2)" style="cursor: pointer">
        <a class="nav-link {{ $tab==2?'active':null }}">
            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
            <span class="d-none d-sm-block">Lokasi</span>   
        </a>
    </li>
    <li class="nav-item" wire:click="changeTab(3)"  style="cursor: pointer">
        <a class="nav-link {{ $tab==3?'active':null }}">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">Turnkey</span> 
        </a>
    </li>
    <li class="nav-item" wire:click="changeTab(4)"  style="cursor: pointer">
        <a class="nav-link {{ $tab==4?'active':null }}">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">Pejabat</span> 
        </a>
    </li>
    <li class="nav-item" wire:click="changeTab(5)"  style="cursor: pointer">
        <a class="nav-link {{ $tab==5?'active':null }}">
            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-block">Gudang</span> 
        </a>
    </li>
</ul>