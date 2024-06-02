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
                        <div class="tab-pane {{ $tab==0?'active':null }}">
                            <div class="row">
                                
                                <div class="col col-md-6">
                                    @php
                                        $dtJes1['msg'] = 'menyetujui data tagihan ini ';
                                        $dtJes1['attr'] = '';
                                        $dtJes1['id'] = $dtTagih['id'];
                                        $dtJes1['callback'] = "prosesprotagihan-submit";
                                        $dtJes1 = json_encode($dtJes1);
                                    @endphp
                                    <button class="btn btn-success btn-lg" type="button" data-toggle="modal" data-emit="modalpassword-prepare" data-target="#modalPassword" data-json='{{$dtJes1}}'>Setujui Tagihan Akhir</button>
                                </div>
                                

                            </div>

                            <hr>

                            <div class="row" wire:ignore>
                                <div class="col-12">
                                    <h4 class="card-title">Pesan Revisi</h4>
                                    <p class="card-title-desc">Tulis pesan revisi anda disini.</p>
    
                                    <input id="{{ $trixId }}" type="hidden" name="content" value="{{ $dtTagih['revisi'] }}">
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

                        {{-- invoice --}}
                        @include('mods.tagihan.tagihan_invoice_readonly')

                        {{-- bast --}}
                        @include('mods.tagihan.tagihan_bast_edit')

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
    
                </div>

            </div>
        </div>
    </div>

    @include('mods.tagihan.atc.proses2_pro_tagihan_atc')

</div>