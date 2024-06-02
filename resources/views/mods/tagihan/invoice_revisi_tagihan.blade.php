<div>
    
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        <div class="col text-right">
            <a href="{{ route('tagihan.indexUser') }}" class="btn btn-success btn-sm">Data Tagihan</a>
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

                        @include('mods.tagihan.tagihan_nav')
                        
                        <div class="tab-content text-muted pt-4">

                            {{-- revisi --}}
                            <div class="tab-pane {{ $tab==0?'active':null }}">
                                <div class="card border border-danger">
                                    <div class="card-header bg-transparent border-danger">
                                        <h5 class="my-0 text-danger"><i class="mdi mdi-block-helper mr-3"></i>Revisi</h5>
                                    </div>
                                    <div class="card-body mt-0 pt-0">
                                        {!! $dtEdit['revisi'] !!}
                                    </div>
                                </div>
                            </div>

                            {{-- invoice --}}
                            @include('mods.tagihan.tagihan_invoice')

                            {{-- BAST --}}
                            @include('mods.tagihan.tagihan_bast_readonly')

                            {{-- nodin --}}
                            @include('mods.tagihan.tagihan_nodin_readonly')
                            
                            {{-- data --}}
                            @include('mods.tagihan.tagihan_data')

                            {{-- lokasi --}}
                            @include('mods.tagihan.tagihan_lokasi')

                            {{-- turnkey --}}
                            @include('mods.tagihan.tagihan_turnkey')

                            {{-- pejabat --}}
                            @include('mods.tagihan.tagihan_pejabat')
                            
                            {{-- gudang --}}
                            @include('mods.tagihan.tagihan_gudang')
                            
                            
                        </div>
        
                        <hr>
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

</div>