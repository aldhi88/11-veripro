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

                        @include('mods.tagihan.tagihan_nav')
                        
                        <div class="tab-content text-muted pt-4">

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

    @include('mods.tagihan.atc.edit_tagihan_atc')

</div>