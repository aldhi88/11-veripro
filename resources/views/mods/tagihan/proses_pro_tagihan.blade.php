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


                    @include('mods.tagihan.tagihan_nav')

                    
                    <div class="tab-content text-muted pt-4">

                        {{-- proses --}}
                        @include('mods.tagihan.tagihan_bast')

                        {{-- nodin --}}
                        @include('mods.tagihan.tagihan_nodin_readonly')
                        
                        {{-- data --}}
                        @include('mods.tagihan.tagihan_data_readonly')

                        {{-- lokasi --}}
                        @include('mods.tagihan.tagihan_lokasi_readonly')

                        {{-- turnkey --}}
                        @include('mods.tagihan.tagihan_turnkey_readonly')

                        {{-- pejabat --}}
                        @include('mods.tagihan.tagihan_pejabat_readonly')

                        {{-- gudang --}}
                        @include('mods.tagihan.tagihan_gudang_readonly')
                        
                        
                    </div>
    
                </div>

            </div>
        </div>
    </div>

    @include('mods.tagihan.atc.proses_pro_tagihan_atc')

</div>