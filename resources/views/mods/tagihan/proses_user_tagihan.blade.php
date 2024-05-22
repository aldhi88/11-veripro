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
                            
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Tgl. Uji Terima</label>
                                        <input disabled type="date" wire:model="dt.dt_tagihan.tgl_ut" class="bg-light form-control @error('tgl_ut') is-invalid @enderror">
                                        @error('tgl_ut')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>No. Uji Terima</label>
                                        <input disabled type="text" wire:model="dt.dt_tagihan.no_ut" class="bg-light form-control @error('no_ut') is-invalid @enderror">
                                        @error('no_ut')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Tgl. Berita Acara Uji Terima</label>
                                        <input disabled type="date" wire:model="dt.dt_tagihan.tgl_baut" class="bg-light form-control @error('tgl_baut') is-invalid @enderror">
                                        @error('tgl_baut')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Tgl. Lamp Acara Uji Terima</label>
                                        <input disabled type="date" wire:model="dt.dt_tagihan.tgl_laut" class="bg-light form-control @error('tgl_laut') is-invalid @enderror">
                                        @error('tgl_laut')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Tgl. Permohonan Rekon</label>
                                        <input disabled type="date" wire:model="dt.dt_tagihan.tgl_mohon" class="bg-light form-control @error('tgl_mohon') is-invalid @enderror">
                                        @error('tgl_mohon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>No. Permohonan Rekon</label>
                                        <input disabled type="text" wire:model="dt.dt_tagihan.no_mohon" class="bg-light form-control @error('no_mohon') is-invalid @enderror">
                                        @error('no_mohon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Tgl. BA Rekon</label>
                                        <input disabled type="date" wire:model="dt.dt_tagihan.tgl_ba_rekon" class="bg-light form-control @error('tgl_ba_rekon') is-invalid @enderror">
                                        @error('tgl_ba_rekon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Tgl. Turnkey</label>
                                        <input disabled type="date" wire:model="dt.dt_tagihan.dt_turnkey.tgl_turnkey" class="bg-light form-control @error('tgl_turnkey') is-invalid @enderror">
                                        @error('tgl_turnkey')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Tgl. BA Gambar</label>
                                        <input disabled type="date" wire:model="dt.dt_tagihan.tgl_ba_gambar" class="bg-light form-control @error('tgl_ba_gambar') is-invalid @enderror">
                                        @error('tgl_ba_gambar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        {{-- turnkey --}}
                        <div class="tab-pane {{ $tab==4?'active':null }}" id="tab4" role="tabpanel">
                                
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label>Tgl. Turnkey</label>
                                        <input disabled ="date" wire:model="dt.dt_tagihan.dt_turnkey.tgl_turnkey" class="bg-light form-control @error('dt.dt_tagihan.dt_turnkey.tgl_turnkey') is-invalid @enderror">
                                        @error('dt.dt_tagihan.dt_turnkey.tgl_turnkey')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-3">
                                <div class="col">
                                    <h4 class="card-title">Rincian Serah Terima</h4>
                                    <p class="card-title-desc">Beri centang terhadap rincian berikut:</p>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead class="text-center">
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">Dokumen</th>
                                                    <th colspan="2">Keterangan</th>
                                                </tr>
                                                <tr>
                                                    <th>Ada</th>
                                                    <th width="100">Tdk Ada</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                @php $index = 0; @endphp
                                                @foreach ($doc as $i=>$item)
                                                    @if (is_array($item))
                                                        @foreach ($item as $iSub=>$itemSub)
                                                            @php $index = $index+$iSub; @endphp
                                                            <tr>
                                                                @if ($iSub==0) <td rowspan="2">{{$i+1}}</td> @endif
                                                                <td class="text-left">{{$itemSub}} {{$index}}</td>
                                                                <td><input disabled type="radio" wire:model="dt.dt_tagihan.dt_turnkey.rincian.{{$index}}" value="1" {{ $dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==1?"cheked":null }}></td>
                                                                <td><input type="radio" disabled wire:model="dt.dt_tagihan.dt_turnkey.rincian.{{$index}}" value="0" {{ $dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==0?"cheked":null }}></td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td>{{ $i+1 }}</td>
                                                            <td class="text-left">{{ $item }} {{$index}}</td>
                                                            <td><input type="radio" disabled wire:model="dt.dt_tagihan.dt_turnkey.rincian.{{$index}}" value="1" {{ $dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==1?"cheked":null }}></td>
                                                            <td><input type="radio" disabled wire:model="dt.dt_tagihan.dt_turnkey.rincian.{{$index}}" value="0" {{ $dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==0?"cheked":null }}></td>
                                                        </tr>
                                                    @endif
                                                    @php $index +=1; @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
    
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        {{-- lokasi --}}
                        <div class="tab-pane {{ $tab==2?'active':null }}" id="tab2" role="tabpanel">
                            
                            <div class="row mb-2 text-dark">
                                <div class="col">
                                    <table class="w-100">
                                        <tr class="text-center bg-soft-success">
                                            <td class="border border-success p-1 bg-success">
                                                <h5 class="mb-0">SP</h5>
                                            </td>
                                            <td class="border border-success p-1">
                                                <h4 class="card-title m-0">Jumlah Lokasi</h4>
                                                <span>{{count($dt['dt_sp']['json']['dtLokasi']['lokasi'])}}</span>
                                            </td>
                                            <td class="border border-success p-1">
                                                <h4 class="card-title m-0">Grand Total Material</h4>
                                                <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material'],0,',','.')}}</span>
                                            </td>
                                            <td class="border border-success p-1">
                                                <h4 class="card-title m-0">Grand Total Jasa</h4>
                                                <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa'],0,',','.')}}</span>
                                            </td>
                                            <td class="border border-success p-1">
                                                <h4 class="card-title m-0">Grand Total</h4>
                                                <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total'],0,',','.')}}</span>
                                            </td>
                                        </tr>
                                        <tr class="text-center bg-soft-warning">
                                            <td class="border border-warning p-1 bg-warning">
                                                <h5 class="mb-0">Rekon</h5>
                                            </td>
                                            <td class="border border-warning p-1">
                                                <h4 class="card-title m-0">Jumlah Lokasi</h4>
                                                <span>{{count($dt['dt_tagihan']['dt_lokasi']['lokasi'])}}</span>
                                            </td>
                                            <td class="border border-warning p-1">
                                                <h4 class="card-title m-0">Grand Total Material Rekon</h4>
                                                <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon'],0,',','.')}}</span>
                                            </td>
                                            <td class="border border-warning p-1">
                                                <h4 class="card-title m-0">Grand Total Jasa Rekon</h4>
                                                <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon'],0,',','.')}}</span>
                                            </td>
                                            <td class="border border-warning p-1">
                                                <h4 class="card-title m-0">Grand Total Rekon</h4>
                                                <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'],0,',','.')}}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <br>
                            <h6 class="bg-secondary text-light p-1 text-center">
                                <span>DATA LOKASI</span>
                            </h6>
                            @foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $iLok => $vLok)

                                <div class="table-responsive mb-2">
                                    <table class="w-100">
                                        <tr class="text-center bg-soft-secondary">
                                            <td colspan="3" class="border border-secondary p-1">
                                                <h4 class="card-title m-0">Lokasi {{$iLok+1}}</h4>
                                            </td>
                                        </tr>
                                        <tr class="text-center bg-soft-secondary">
                                            <td class="border border-secondary p-1">
                                                <h4 class="card-title m-0">Nama Lokasi</h4>
                                                <span>{{$vLok['nama_lokasi']}}</span>
                                            </td>
                                            <td class="border border-secondary p-1">
                                                <h4 class="card-title m-0">Nama STO</h4>
                                                <span>{{$vLok['sto']}}</span>
                                            </td>
                                            <td class="border border-secondary p-1">
                                                <h4 class="card-title m-0">ID Project</h4>
                                                <span>{{$vLok['id_project']}}</span>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="w-100 mt-1">
                                        <tr class="text-center bg-soft-success">
                                            <td class="border border-success p-1 bg-success">
                                                <h5 class="mb-0">SP</h5>
                                            </td>
                                            <td class="border border-success p-1">
                                                <h4 class="card-title m-0">Total Material</h4>
                                                <span>{{number_format($vLok['total_material_lokasi'],0,',','.')}}</span>
                                            </td>
                                            <td class="border border-success p-1">
                                                <h4 class="card-title m-0">Total Jasa</h4>
                                                <span>{{number_format($vLok['total_jasa_lokasi'],0,',','.')}}</span>
                                            </td>
                                            <td class="border border-success p-1">
                                                <h4 class="card-title m-0">Total</h4>
                                                <span>{{number_format($vLok['total_lokasi'],0,',','.')}}</span>
                                            </td>
                                        </tr>
                                        <tr class="text-center bg-soft-warning">
                                            <td class="border border-warning p-1 bg-warning">
                                                <h5 class="mb-0">Rekon</h5>
                                            </td>
                                            <td class="border border-warning p-1">
                                                <h4 class="card-title m-0">Total Material</h4>
                                                <span>{{number_format($vLok['total_material_lokasi_rekon'],0,',','.')}}</span>
                                            </td>
                                            <td class="border border-warning p-1">
                                                <h4 class="card-title m-0">Total Jasa</h4>
                                                <span>{{number_format($vLok['total_jasa_lokasi_rekon'],0,',','.')}}</span>
                                            </td>
                                            <td class="border border-warning p-1">
                                                <h4 class="card-title m-0">Total</h4>
                                                <span>{{number_format($vLok['total_lokasi_rekon'],0,',','.')}}</span>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="table-responsive mt-1">
                                        <table class="lh-80 small td-middle table table-sm table-bordered table-striped m-0">
                                            <thead class="bg-light text-center">
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th colspan="3">Quality Enhancement (QE) Akses</th>
                                                    <th colspan="2">Harga Satuan</th>
                                                    <th rowspan="2" class="bg-soft-success">Vol <br> SP</th>
                                                    <th colspan="3" class="bg-soft-success">Total Harga SP</th>
                                                    <th rowspan="2" class="bg-soft-warning">Vol <br> Re <br> Kon</th>
                                                    <th colspan="3" class="bg-soft-warning">Total Harga Rekon</th>
                                                </tr>
                                                <tr>
                                                    <th>Material <br> Designator</th>
                                                    <th>Jasa <br> Designator</th>
                                                    <th>Item Designator</th>
                                                    <th>Material</th>
                                                    <th>Jasa</th>
                                                    <th>Material</th>
                                                    <th>Jasa</th>
                                                    <th>Total</th>
                                                    <th>Material</th>
                                                    <th>Jasa</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($vLok['desig_items'] as $iDes=>$vDes)
                                                    <tr>
                                                        <td class="text-center">{{$iDes+1}}</td>
                                                        <td class="text-center">{{$vDes['nama_material']}}</td>
                                                        <td class="text-center">{{$vDes['nama_jasa']}}</td>
                                                        <td class="text-center">{{$vDes['nama_designator']}}</td>
                                                        <td class="text-right">{{number_format($vDes['material'],0,',','.')}}</td>
                                                        <td class="text-right">{{number_format($vDes['jasa'],0,',','.')}}</td>
                                                        <td class="text-right">{{number_format($vDes['vol'],0,',','.')}}</td>
                                                        <td class="text-right">{{number_format($vDes['total_material'],0,',','.')}}</td>
                                                        <td class="text-right">{{number_format($vDes['total_jasa'],0,',','.')}}</td>
                                                        <td class="text-right">{{number_format($vDes['total'],0,',','.')}}</td>
                                                        <td class="text-right">{{number_format($vDes['volume_rekon'],0,',','.')}}</td>
                                                        <td class="text-right">{{number_format($vDes['total_material_rekon'],0,',','.')}}</td>
                                                        <td class="text-right">{{number_format($vDes['total_jasa_rekon'],0,',','.')}}</td>
                                                        <td class="text-right">{{number_format($vDes['total_rekon'],0,',','.')}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            @endforeach
                            
                        </div>

                        {{-- pejabat --}}
                        <div class="tab-pane {{ $tab==5?'active':null }}" id="tab5" role="tabpanel">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col">
                                                <label>GM. Telkom Akses (Pejabat)</label>
                                                <select disabled wire:model="dt.dt_tagihan.dt_ttd.gm_ta_pejabat" class="bg-light form-control @error('dt.dt_tagihan.dt_ttd.gm_ta_pejabat') is-invalid @enderror">
                                                    <option value="">Pilih nama</option>
                                                    @foreach ($pejabat['gm_ta']['value']['nama'] as $item)
                                                    <option value="{{ $item }}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                @error('dt.dt_tagihan.dt_ttd.gm_ta_pejabat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label>GM. Telkom Akses (Jabatan)</label>
                                                <select wire:model="dt.dt_tagihan.dt_ttd.gm_ta_jabatan" disabled class="bg-light form-control @error('dt.dt_tagihan.dt_ttd.gm_ta_jabatan') is-invalid @enderror">
                                                    <option value="">Pilih jabatan</option>
                                                    @foreach ($pejabat['gm_ta']['value']['jabatan'] as $item)
                                                    <option value="{{ $item }}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                @error('dt.dt_tagihan.dt_ttd.gm_ta_jabatan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label>Mgr. {{$dt['dt_sp']['master_units']['nama']}} (Pejabat)</label>
                                                <select wire:model="dt.dt_tagihan.dt_ttd.mgr_unit_pejabat" disabled class="bg-light form-control @error('dt.dt_tagihan.dt_ttd.mgr_unit_pejabat') is-invalid @enderror">
                                                    <option value="">Pilih nama</option>
                                                    
                                                    @foreach ($pejabat['mgr_'.strtolower($dt['dt_sp']['master_units']['nama'])]['value']['nama'] as $item)
                                                    <option value="{{ $item }}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                @error('dt.dt_tagihan.dt_ttd.mgr_unit_pejabat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label>Mgr. {{$dt['dt_sp']['master_units']['nama']}} (Jabatan)</label>
                                                <select wire:model="dt.dt_tagihan.dt_ttd.mgr_unit_jabatan" disabled class="bg-light form-control @error('dt.dt_tagihan.dt_ttd.mgr_unit_jabatan') is-invalid @enderror">
                                                    <option value="">Pilih jabatan</option>
                                                    
                                                    @foreach ($pejabat['mgr_'.strtolower($dt['dt_sp']['master_units']['nama'])]['value']['jabatan'] as $item)
                                                    <option value="{{ $item }}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                @error('dt.dt_tagihan.dt_ttd.mgr_unit_jabatan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label>SM. {{$dt['dt_sp']['master_units']['nama']}} (Pejabat)</label>
                                                <select wire:model="dt.dt_tagihan.dt_ttd.sm_unit_pejabat" disabled class="bg-light form-control @error('dt.dt_tagihan.dt_ttd.sm_unit_pejabat') is-invalid @enderror">
                                                    <option value="">Pilih nama</option>@foreach ($pejabat['sm_'.strtolower($dt['dt_sp']['master_units']['nama'])]['value']['nama'] as 
                                                    $item)
                                                    <option value="{{ $item }}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                @error('dt.dt_tagihan.dt_ttd.sm_unit_pejabat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label>SM. {{$dt['dt_sp']['master_units']['nama']}} (Jabatan)</label>
                                                <select wire:model="dt.dt_tagihan.dt_ttd.sm_unit_jabatan" disabled class="bg-light form-control @error('dt.dt_tagihan.dt_ttd.sm_unit_jabatan') is-invalid @enderror">
                                                    <option value="">Pilih jabatan</option>@foreach ($pejabat['sm_'.strtolower($dt['dt_sp']['master_units']['nama'])]['value']['jabatan'] as 
                                                    $item)
                                                    <option value="{{ $item }}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                @error('dt.dt_tagihan.dt_ttd.sm_unit_jabatan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label>Mgr. Shared Service (Pejabat)</label>
                                                <select wire:model="dt.dt_tagihan.dt_ttd.mgr_shared_pejabat" disabled class="bg-light form-control @error('dt.dt_tagihan.dt_ttd.mgr_shared_pejabat') is-invalid @enderror">
                                                    <option value="">Pilih nama</option>
                                                    @foreach ($pejabat['mgr_shared']['value']['nama'] as $item)
                                                    <option value="{{ $item }}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                @error('dt.dt_tagihan.dt_ttd.mgr_shared_pejabat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label>Mgr. Shared Service (Jabatan)</label>
                                                <select wire:model="dt.dt_tagihan.dt_ttd.mgr_shared_jabatan" disabled class="bg-light form-control @error('dt.dt_tagihan.dt_ttd.mgr_shared_jabatan') is-invalid @enderror">
                                                    <option value="">Pilih jabatan</option>
                                                    @foreach ($pejabat['mgr_shared']['value']['jabatan'] as $item)
                                                    <option value="{{ $item }}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                @error('dt.dt_tagihan.dt_ttd.mgr_shared_jabatan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label>Waspang (Pejabat)</label>
                                                <select wire:model="dt.dt_tagihan.dt_ttd.waspang_pejabat" disabled class="bg-light form-control @error('dt.dt_tagihan.dt_ttd.waspang_pejabat') is-invalid @enderror">
                                                    <option value="">Pilih nama</option>
                                                    @foreach ($pejabat['waspang']['value']['nama'] as $item)
                                                    <option value="{{ $item }}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                @error('dt.dt_tagihan.dt_ttd.waspang_pejabat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label>Waspang (Jabatan)</label>
                                                <select wire:model="dt.dt_tagihan.dt_ttd.waspang_jabatan" disabled class="bg-light form-control @error('dt.dt_tagihan.dt_ttd.waspang_jabatan') is-invalid @enderror">
                                                    <option value="">Pilih jabatan</option>
                                                    @foreach ($pejabat['waspang']['value']['jabatan'] as $item)
                                                    <option value="{{ $item }}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                @error('dt.dt_tagihan.dt_ttd.waspang_jabatan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label>Petugas Gudang (Pejabat)</label>
                                                <select wire:model="dt.dt_tagihan.dt_ttd.gudang_pejabat" disabled class="bg-light form-control @error('dt.dt_tagihan.dt_ttd.gudang_pejabat') is-invalid @enderror">
                                                    <option value="">Pilih nama</option>
                                                    @foreach ($pejabat['gudang']['value']['nama'] as $item)
                                                    <option value="{{ $item }}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                @error('dt.dt_tagihan.dt_ttd.gudang_pejabat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col">
                                                <label>Petugas Gudang (Jabatan)</label>
                                                <select wire:model="dt.dt_tagihan.dt_ttd.gudang_jabatan" disabled class="bg-light form-control @error('dt.dt_tagihan.dt_ttd.gudang_jabatan') is-invalid @enderror">
                                                    <option value="">Pilih jabatan</option>
                                                    @foreach ($pejabat['gudang']['value']['jabatan'] as $item)
                                                    <option value="{{ $item }}">{{$item}}</option>
                                                    @endforeach
                                                </select>
                                                @error('dt.dt_tagihan.dt_ttd.gudang_jabatan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane {{ $tab==3?'active':null }}" id="tab3" role="tabpanel">
                            <div class="row">
                                <div class="col">
                                    
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <h6>MATERIAL YANG DIAMBIL</h6>
                                            <table class="table-bordered lh-80 small table table-sm m-0 table-bordered table-striped nowrap middle-text">
                                                <thead class="bg-light text-center">
                                                    <tr>
                                                        <th rowspan="2">No</th>
                                                        <th rowspan="2">No. RFC</th>
                                                        <th rowspan="2" width="130">Tgl. RFC</th>
                                                        @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                                                        <th>
                                                            <div class="verticalTableHeader">{{$vDes['nama_material']}}</div>
                                                        </th>
                                                        @endforeach
                                                        
                                                    </tr>
                                                    <tr>
                                                        @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                                                        <th width="60">{{$vDes['satuan']}}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
    
                                                <tbody>
                                                    <tr><td></td></tr>
                                                    @foreach ($dt['dt_tagihan']['dt_gudang']['ambil']['data'] as $iRowAmbil=>$vRowAmbil)
                                                        <tr class="text-center">
                                                            <td>{{$iRowAmbil+1}}</td>
                                                            <td>{{$vRowAmbil['no_rfc']}}</td>
                                                            <td>{{$vRowAmbil['tgl_rfc']}}</td>
                                                            @foreach ($vRowAmbil['nilai'] as $iNilaiAmbil=>$vNilaiAmbil)
                                                            <td>{{$vNilaiAmbil}}</td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tr><td colspan="{{ count($dt['dt_tagihan']['dt_gudang']['all_desig'])+3 }}"><hr class="m-0 p-0"></td></tr>
                                                <tfoot class="bg-light">
                                                    <tr class="text-dark">
                                                        <th colspan="3">TOTAL MATERIAL</th>
                                                        @foreach ($dt['dt_tagihan']['dt_gudang']['ambil']['total'] as $iNilaiAmbil=>$vNilaiAmbil)
                                                        <th class="text-center">{{$vNilaiAmbil}}</th>
                                                        @endforeach
                                                    </tr>
                                                </tfoot>
                                            </table>
    
                                            
                                        </div>
                                    </div>

                                    <hr> 
                                    <div class="row">
                                        <div class="col">
                                            <h6>MATERIAL YANG DIPAKAI</h6>
                                            <table class="lh-80 small table table-sm m-0 table-bordered table-striped nowrap middle-text">
                                                <thead class="bg-light text-center">
                                                    <tr>
                                                        <th rowspan="2" width="50">No</th>
                                                        <th rowspan="2">Nama Lokasi</th>
                                                        <th rowspan="2" width="130">ID Project</th>
                                                        @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                                                        <th>
                                                            <div class="verticalTableHeader">{{$vDes['nama_material']}}</div>
                                                        </th>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                                                        <th width="60">{{$vDes['satuan']}}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $iLok=>$vLok)
                                                        <tr class="text-center">
                                                            <td>{{$iLok+1}}</td>
                                                            <td>{{$vLok['nama_lokasi']}}</td>
                                                            <td>{{$vLok['id_project']}}</td>
                                                            @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDesMat=>$vDesMat)
                                                            <td>{{$dt['dt_tagihan']['dt_gudang']['pakai']['data'][$iLok][$iDesMat]}}</td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tr><td colspan="{{ count($dt['dt_tagihan']['dt_gudang']['all_desig'])+3 }}"><hr class="m-0 p-0"></td></tr>
                                                <tfoot class="bg-light">
                                                    <tr class="text-dark">
                                                        <th colspan="3">TOTAL MATERIAL</th>
                                                        @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDesMat=>$vDesMat)
                                                        <th class="text-center">{{$dt['dt_tagihan']['dt_gudang']['pakai']['total'][$iDesMat]}}</th>
                                                        @endforeach
                                                    </tr>
                                                </tfoot>
                                            </table>

                                            
                                        </div>
                                    </div>

                                    <hr> 
                                    <div class="row">
                                        <div class="col">
                                            <h6>PENGEMBALIAN MATERIAL</h6>
                                            <table class="table-bordered lh-80 small table table-sm m-0 table-bordered table-striped nowrap middle-text">
                                                <thead class="bg-light text-center">
                                                    <tr>
                                                        <th rowspan="2">No</th>
                                                        <th rowspan="2">ID Pengembalian</th>
                                                        <th rowspan="2" width="130">Tgl. RFR</th>
                                                        @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                                                        <th><div class="verticalTableHeader">{{$vDes['nama_material']}}</div></th>
                                                        @endforeach
                                                        
                                                    </tr>
                                                    <tr>
                                                        @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                                                        <th width="60">{{$vDes['satuan']}}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr><td></td></tr>
                                                    @foreach ($dt['dt_tagihan']['dt_gudang']['kembali']['data'] as $iRowKembali=>$vRowKembali)
                                                        <tr class="text-center">
                                                            <td>{{$iRowKembali+1}}</td>
                                                            <td>{{$vRowKembali['id_kembali']}}</td>
                                                            <td>{{$vRowKembali['tgl_rfr']}}</td>
                                                            @foreach ($vRowKembali['nilai'] as $iNilaiKembali=>$vNilaiKembali)
                                                            <td>{{$vNilaiKembali}}</td>
                                                            @endforeach
                                                            
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tr><td colspan="{{ count($dt['dt_tagihan']['dt_gudang']['all_desig'])+3 }}"><hr class="m-0 p-0"></td></tr>
                                                <tfoot class="bg-light">
                                                    <tr class="text-dark">
                                                        <th colspan="3">TOTAL PENGEMBALIAN MATERIAL</th>
                                                        @foreach ($dt['dt_tagihan']['dt_gudang']['kembali']['total'] as $iNilaiKembali=>$vNilaiKembali)
                                                        <th class="text-center">{{$vNilaiKembali}}</th>
                                                        @endforeach
                                                    </tr>
                                                    <tr><td colspan="{{ count($dt['dt_tagihan']['dt_gudang']['all_desig'])+3 }}"><hr class="mb-0 bg-warning"></td></tr>
                                                    <tr class="text-dark bg-soft-warning">
                                                        <th colspan="3" class="border border-warning">GRAND TOTAL SISA MATERIAL</th>
                                                        @foreach ($dt['dt_tagihan']['dt_gudang']['grand_total'] as $iGt=>$vGt)
                                                        <th class="border border-warning text-center">{{$vGt}}</th>
                                                        @endforeach
                                                    </tr>
                                                </tfoot>
                                                
                                            </table>

                                            
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <h6>Keterangan:</h6>
                                            <table class="w-100">
                                                @foreach ($dt['dt_tagihan']['dt_gudang']['kembali']['ket'] as $i=>$v)
                                                <tr>
                                                    <td class="pl-4">{{$v}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <hr> 
                                            <div class="row">
                                                <div class="col">
                                                    <h6>HASIL REKON MATERIAL</h6>
                                                    <table class="lh-80 small table table-sm m-0 table-bordered table-striped nowrap middle-text">
                                                        <thead class="bg-light text-center">
                                                            <tr>
                                                                <th rowspan="2" width="40">No</th>
                                                                <th rowspan="2">Nama Barang</th>
                                                                <th rowspan="2">Nama Barang <br> Alista</th>
                                                                <th rowspan="2" width="60">Hasil <br> Rekon</th>
                                                                <th colspan="3">Pemakaian Material</th>
                                                                <th rowspan="2">Keterangan</th>
                                                            </tr>
                                                            <tr>
                                                                <th width="70">TA</th>
                                                                <th width="70">Mitra</th>
                                                                <th width="60">Pengembalian</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @php $no=1; @endphp
                                                            @foreach ($dt['dt_tagihan']['dt_gudang']['rekon'] as $iDr => $vDr)
                                                            @if ($vDr['sum_rekon'] > 0)
                                                            <tr>
                                                                <td>{{ $no++ }}</td>
                                                                <td>{{$vDr['nama_barang_alista']}}</td>
                                                                <td class="text-center">{{$vDr['nama_barang']}}</td>
                                                                <td class="text-center">{{$vDr['sum_rekon']}}</td>
                                                                <td class="text-center">{{$vDr['v_ta']}}</td>
                                                                <td class="text-center">{{$vDr['v_mitra']}}</td>
                                                                <td class="text-center">{{$vDr['v_back']}}</td>
                                                                <td class="text-center">{{$vDr['ket']}}</td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            
                                                        </tbody>
                                                    </table>
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <h6>Keterangan Material Lokasi:</h6>
                                                            <table class="w-100">
                                                                @foreach ($dt['dt_tagihan']['dt_gudang']['rekon'] as $iDr => $vDr)
                                                                @if ($vDr['sum_rekon'] > 0)
                                                                <tr>
                                                                    <td class="pl-4">{{$vDr['ket_matlok']}}</td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </div>
                        
                        
                    </div>
    
                </div>

            </div>
        </div>
    </div>

    @include('mods.tagihan.atc.proses_user_tagihan_atc')

</div>