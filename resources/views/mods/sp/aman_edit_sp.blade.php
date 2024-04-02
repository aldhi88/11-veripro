<div>
    <div class="loading-50" wire:loading><div class="loader"></div></div>
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        <div class="col text-right">
            <a href="{{ route('sp.index') }}" class="btn btn-success btn-sm">Data SP Induk</a>
        </div>
    </div><hr>


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">


                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item" wire:click="changeTab('data')"  style="cursor: pointer">
                            <a class="nav-link {{ $tab=='data'?'active':null }}">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Data Amandemen SP</span> 
                            </a>
                        </li>
                        
                        <li class="nav-item" wire:click="changeTab('desig')" style="cursor: pointer">
                            <a class="nav-link {{ $tab=='desig'?'active':null }}">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Designator</span>   
                            </a>
                        </li>
                        
                    </ul>
                        


                    <div class="tab-content text-muted pt-4 px-3">

                        <div class="tab-pane active" id="tab1" role="tabpanel">
                            <div class="{{$dData}}">
                                @include('mods.sp.aman_edit_sp_tab_data')
                            </div>
                            
                            <div class="{{$dDesig}}">
                                @include('mods.sp.aman_edit_sp_tab_desig')
                            </div>
                        </div>

                    </div>

                    <hr>
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" wire:click="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @include('mods.sp.atc.aman_edit_sp_atc')
    
</div>