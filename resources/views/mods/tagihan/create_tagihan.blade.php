<div>
    
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        <div class="col text-right">
            <a href="{{ route('sp.indexMitra') }}" class="btn btn-success btn-sm">Data SP</a>
        </div>
    </div><hr>


    @if (session()->has('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <form wire:submit="submit">

                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item" wire:click="changeTab(1)"  style="cursor: pointer">
                                <a class="nav-link {{ $tab==1?'active':null }}">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Data Tagihan</span> 
                                </a>
                            </li>
                            <li class="nav-item" wire:click="changeTab(2)" style="cursor: pointer">
                                <a class="nav-link {{ $tab==2?'active':null }}">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">Designator</span>   
                                </a>
                            </li>
                            <li class="nav-item" wire:click="changeTab(4)"  style="cursor: pointer">
                                <a class="nav-link {{ $tab==4?'active':null }}">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Turnkey</span> 
                                </a>
                            </li>
                            <li class="nav-item" wire:click="changeTab(5)"  style="cursor: pointer">
                                <a class="nav-link {{ $tab==5?'active':null }}">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Pejabat</span> 
                                </a>
                            </li>
                            <li class="nav-item" wire:click="changeTab(3)"  style="cursor: pointer">
                                <a class="nav-link {{ $tab==3?'active':null }}">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">Gudang</span> 
                                </a>
                            </li>
                        </ul>
                        
                        <div class="tab-content text-muted pt-4">
                            
                            {{-- data tagihan --}}
                            <div class="tab-pane {{ $tab==1?'active':null }}" id="tab1" role="tabpanel">
                                @include('mods.tagihan.create_tagihan_data')
                            </div>

                            {{-- designator Rekon --}}
                            <div class="tab-pane {{ $tab==2?'active':null }}" id="tab2" role="tabpanel">
                                @include('mods.tagihan.create_tagihan_lokasi')
                            </div>

                            {{-- turnkey --}}
                            <div class="tab-pane {{ $tab==4?'active':null }}" id="tab4" role="tabpanel">
                                @include('mods.tagihan.create_tagihan_turnkey')
                            </div>


                            {{-- pejabat --}}
                            <div class="tab-pane {{ $tab==5?'active':null }}" id="tab5" role="tabpanel">
                                @include('mods.tagihan.create_tagihan_pejabat')
                            </div>

                            
                            {{-- gudang --}}
                            <div class="tab-pane {{ $tab==3?'active':null }}" id="tab3" role="tabpanel">
                                @include('mods.tagihan.create_tagihan_gudang')
                            </div>
                            
                        </div>
    
                        <hr>
                        {{--  --}}

                        <div class="row">
                            <div class="col-12">
                                @if (count($errors)>0)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Masih terdapat error pada input form, silahkan cek kembali
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                @endif
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-light">Reset Semua Form</button>
                            </div>
                            <div class="col text-right">
                                
                                <button type="submit" class="btn btn-primary">Kirim Tagihan</button>
                            </div>
                        </div>

                    </form>


                </div>

            </div>
        </div>
    </div>

    @include('mods.tagihan.atc.create_tagihan_atc')

</div>