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
                        <li class="nav-item" wire:click="changeTab(6)"  style="cursor: pointer">
                            <a class="nav-link {{ $tab==6?'active':null }}">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Proses</span> 
                            </a>
                        </li>

                        <li class="nav-item" wire:click="changeTab(0)"  style="cursor: pointer">
                            <a class="nav-link {{ $tab==0?'active':null }}">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Nota Dinas</span> 
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

                        {{-- proses --}}
                        <div class="tab-pane {{ $tab==6?'active':null }}" id="tab6" role="tabpanel">

                            <div class="row">
                                <div class="col-12">
                                    <h4 class="card-title">Data Berita Acara Serah Terima (BAST)</h4>
                                    <p class="card-title-desc">Lengkapi data jika anda ingin menyetujui tagihan ini.</p>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>No. Lamp Acara Uji Terima</label>
                                        <input type="text" wire:model="dt.dt_tagihan.no_laut" class="form-control @error('dt.dt_tagihan.no_laut') is-invalid @enderror">
                                        @error('dt.dt_tagihan.no_laut')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Nomor BAST</label>
                                        <input type="text" wire:model="dt.dt_tagihan.no_bast" class="form-control @error('dt.dt_tagihan.no_bast') is-invalid @enderror">
                                        @error('dt.dt_tagihan.no_bast')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Tanggal BAST</label>
                                        <input type="date" wire:model="dt.dt_tagihan.tgl_bast" class="form-control @error('dt.dt_tagihan.tgl_bast') is-invalid @enderror">
                                        @error('dt.dt_tagihan.tgl_bast')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md">
                                    <div class="form-group">
                                        <label>Nomor BAUT</label>
                                        <input type="text" wire:model="dt.dt_tagihan.no_baut" class="form-control @error('dt.dt_tagihan.no_baut') is-invalid @enderror">
                                        @error('dt.dt_tagihan.no_baut')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md">
                                    <div class="form-group">
                                        <label>Nomor BA Rekon</label>
                                        <input type="text" wire:model="dt.dt_tagihan.no_ba_rekon" class="form-control @error('dt.dt_tagihan.no_ba_rekon') is-invalid @enderror">
                                        @error('dt.dt_tagihan.no_ba_rekon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md">
                                    <div class="form-group">
                                        <label>Nomor BA Gambar</label>
                                        <input type="text" wire:model="dt.dt_tagihan.no_ba_gambar" class="form-control @error('dt.dt_tagihan.no_ba_gambar') is-invalid @enderror">
                                        @error('dt.dt_tagihan.no_ba_gambar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                @if ($isAmanPenutup)
                                    <div class="col-12 col-md">
                                        <div class="form-group">
                                            <label>Nomor Amandemen Penutup</label>
                                            <input type="text" wire:model="dt.dt_tagihan.aman_penutup" class="form-control @error('dt.dt_tagihan.aman_penutup') is-invalid @enderror">
                                            @error('dt.dt_tagihan.aman_penutup')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="col-12">
                                    @php
                                        $dtJes1['msg'] = 'menyetujui data tagihan ini ';
                                        $dtJes1['attr'] = '';
                                        $dtJes1['id'] = $dtTagih['id'];
                                        $dtJes1['callback'] = "prosesprotagihan-submit";
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
    
                                    <input id="{{ $trixId }}" type="hidden" name="content" value="{{$revisi}}">
                                    <trix-editor style="height: 200px" input="{{ $trixId }}"></trix-editor>
                                    
                                </div> <!-- end col -->
                                <div class="col-12 mt-2">

                                    @php
                                        $dtJes2['msg'] = 'mengirimkan revisi pada tagihan ini ';
                                        $dtJes2['attr'] = '';
                                        $dtJes2['id'] = $dtTagih['id'];
                                        $dtJes2['callback'] = "prosesprotagihan-revisi";
                                        $dtJes2 = json_encode($dtJes2);
                                    @endphp

                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-emit="modalpassword-prepare" data-target="#modalPassword" data-json='{{$dtJes2}}'>Kirim Data Revisi</button>
                                </div>
                            </div> <!-- end row -->

                        </div>


                        {{-- nodin --}}
                        <div class="tab-pane {{ $tab==0?'active':null }}" id="tab0" role="tabpanel">
                            @include('mods.tagihan.proses_tagihan_nodin')
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

    @include('mods.tagihan.atc.proses_pro_tagihan_atc')

</div>