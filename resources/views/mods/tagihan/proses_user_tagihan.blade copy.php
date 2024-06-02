<div>
    
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        <div class="col text-right">
            <a href="{{ route('tagihan.indexUser') }}" class="btn btn-success btn-sm">Data Tagihan</a>
        </div>
    </div><hr>


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item" wire:click="changeTab(0)"  style="cursor: pointer">
                            <a class="nav-link {{ $tab==0?'active':null }}">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Proses</span> 
                            </a>
                        </li>
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

                        <li class="nav-item" wire:click="changeTab(4)" style="cursor: pointer">
                            <a class="nav-link {{ $tab==4?'active':null }}">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
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

                        <div class="tab-pane {{ $tab==0?'active':null }}" id="tab0" role="tabpanel">

                            <div class="row">
                                <div class="col-12">
                                    <h4 class="card-title">Data Nota Dinas</h4>
                                    <p class="card-title-desc">Lengkapi data jika anda ingin menyetujui tagihan ini.</p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Nota Dinas</label>
                                        <input type="text" wire:model="dt.dt_tagihan.no_nodin" class="form-control @error('dt.dt_tagihan.no_nodin') is-invalid @enderror">
                                        @error('dt.dt_tagihan.no_nodin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Nota Dinas</label>
                                        <input type="date" wire:model="dt.dt_tagihan.tgl_nodin" class="form-control @error('dt.dt_tagihan.tgl_nodin') is-invalid @enderror">
                                        @error('dt.dt_tagihan.tgl_nodin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    @php
                                        $dtJes1['msg'] = 'menyetujui data tagihan ini ';
                                        $dtJes1['attr'] = '';
                                        $dtJes1['id'] = $dtTagih['id'];
                                        $dtJes1['callback'] = "prosesusertagihan-submit";
                                        $dtJes1 = json_encode($dtJes1);
                                    @endphp
                                    <button class="btn btn-success" type="button" data-toggle="modal" data-emit="modalpassword-prepare" data-target="#modalPassword" data-json='{{$dtJes1}}'>Setujui Tagihan</button>
                                </div>
                                

                            </div>

                            <hr>

                            <div class="row" wire:ignore>
                                <div class="col-12">
                                    <h4 class="card-title">Pesan Revisi</h4>
                                    <p class="card-title-desc">Tulis pesan revisi anda disini.</p>
    
                                    <input id="{{ $trixId }}" type="hidden" name="content" value="{{ $dtTagih['revisi'] }}">
                                    <trix-editor style="height: 200px" input="{{ $trixId }}"></trix-editor>
                                    
                                </div> 
                                <div class="col-12 mt-2">

                                    @php
                                        $dtJes2['msg'] = 'mengirimkan revisi pada tagihan ini ';
                                        $dtJes2['attr'] = '';
                                        $dtJes2['id'] = $dtTagih['id'];
                                        $dtJes2['callback'] = "prosesusertagihan-revisi";
                                        $dtJes2 = json_encode($dtJes2);
                                    @endphp

                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-emit="modalpassword-prepare" data-target="#modalPassword" data-json='{{$dtJes2}}'>Kirim Data Revisi</button>
                                </div>
                            </div> 

                        </div>
                        
                        {{-- tagihan --}}
                        <div class="tab-pane {{ $tab==1?'active':null }}" id="tab1" role="tabpanel">
                            @include('mods.tagihan.proses_tagihan_data')
                        </div>

                        {{-- turnkey --}}
                        <div class="tab-pane {{ $tab==4?'active':null }}" id="tab4" role="tabpanel">
                            @include('mods.tagihan.proses_tagihan_turnkey')
                        </div>

                        {{-- lokasi --}}
                        <div class="tab-pane {{ $tab==2?'active':null }}" id="tab2" role="tabpanel">
                            @include('mods.tagihan.proses_tagihan_lokasi')
                        </div>

                        {{-- pejabat --}}
                        <div class="tab-pane {{ $tab==5?'active':null }}" id="tab5" role="tabpanel">
                            @include('mods.tagihan.proses_tagihan_pejabat')
                        </div>

                        {{-- gudang --}}
                        <div class="tab-pane {{ $tab==3?'active':null }}" id="tab3" role="tabpanel">
                            @include('mods.tagihan.proses_tagihan_gudang')
                        </div>
                        
                        
                    </div>
    
                </div>

            </div>
        </div>
    </div>

    @include('mods.tagihan.atc.proses_user_tagihan_atc')

</div>