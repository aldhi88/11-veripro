<div>
    
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        <div class="col text-right">
            <a href="{{ route('sp.indexMitra') }}" class="btn btn-success btn-sm">Data SP</a>
        </div>
    </div><hr>


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
                                    <span class="d-none d-sm-block">Designator SP</span>   
                                </a>
                            </li>
                            <li class="nav-item" wire:click="changeTab(6)" style="cursor: pointer">
                                <a class="nav-link {{ $tab==6?'active':null }}">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">Designator Rekon</span>   
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
                                
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>Tgl. Permohonan Uji Terima</label>
                                            <input type="date" wire:model="dt.dt_tagihan.tgl_ut" class="form-control @error('dt.dt_tagihan.tgl_ut') is-invalid @enderror">
                                            @error('dt.dt_tagihan.tgl_ut')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>No. Permohonan Uji Terima</label>
                                            <input type="text" wire:model="dt.dt_tagihan.no_ut" class="form-control @error('dt.dt_tagihan.no_ut') is-invalid @enderror">
                                            @error('dt.dt_tagihan.no_ut')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>Tgl. Berita Acara Uji Terima</label>
                                            <input type="date" wire:model="dt.dt_tagihan.tgl_baut" class="form-control @error('dt.dt_tagihan.tgl_baut') is-invalid @enderror">
                                            @error('dt.dt_tagihan.tgl_baut')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>Tgl. Lamp Acara Uji Terima</label>
                                            <input type="date" wire:model="dt.dt_tagihan.tgl_laut" class="form-control @error('dt.dt_tagihan.tgl_laut') is-invalid @enderror">
                                            @error('dt.dt_tagihan.tgl_laut')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>Tgl. Permohonan Rekon</label>
                                            <input type="date" wire:model="dt.dt_tagihan.tgl_mohon" class="form-control @error('dt.dt_tagihan.tgl_mohon') is-invalid @enderror">
                                            @error('dt.dt_tagihan.tgl_mohon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>No. Permohonan Rekon</label>
                                            <input type="text" wire:model="dt.dt_tagihan.no_mohon" class="form-control @error('dt.dt_tagihan.no_mohon') is-invalid @enderror">
                                            @error('dt.dt_tagihan.no_mohon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>Tgl. BA Rekon</label>
                                            <input type="date" wire:model="dt.dt_tagihan.tgl_ba_rekon" class="form-control @error('dt.dt_tagihan.tgl_ba_rekon') is-invalid @enderror">
                                            @error('dt.dt_tagihan.tgl_ba_rekon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>Tgl. BA Gambar</label>
                                            <input type="date" wire:model="dt.dt_tagihan.tgl_ba_gambar" class="form-control @error('dt.dt_tagihan.tgl_ba_gambar') is-invalid @enderror">
                                            @error('dt.dt_tagihan.tgl_ba_gambar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            {{-- designator SP --}}
                            <div class="tab-pane {{ $tab==2?'active':null }}" id="tab2" role="tabpanel">
                                <h6 class="bg-light p-1 text-center">
                                    <span>DATA GRAND TOTAL</span>
                                </h6>
                                <div class="row">
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
                                                    <h4 class="card-title m-0">Grand Total Material SP</h4>
                                                    <span>{{number_format($dt['dt_sp']['json']['dtLokasi']['grand_total_material'],0,',','.')}}</span>
                                                </td>
                                                <td class="border border-success p-1">
                                                    <h4 class="card-title m-0">Grand Total Jasa SP</h4>
                                                    <span>{{number_format($dt['dt_sp']['json']['dtLokasi']['grand_total_jasa'],0,',','.')}}</span>
                                                </td>
                                                <td class="border border-success p-1">
                                                    <h4 class="card-title m-0">Grand Total SP</h4>
                                                    <span>{{number_format($dt['dt_sp']['json']['dtLokasi']['grand_total'],0,',','.')}}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <h6 class="bg-light p-1 text-center">
                                    <span>DATA LOKASI</span>
                                </h6>
                                @foreach ($dt['dt_sp']['json']['dtLokasi']['lokasi'] as $iLok => $vLok)
            
                                    <div class="table-responsive mb-2">
                                        <table class="w-100">
                                            <tr class="text-center bg-success">
                                                <td colspan="3" class="border border-success p-1">
                                                    <h4 class="card-title m-0">Lokasi {{$iLok+1}}</h4>
                                                </td>
                                            </tr>
                                            <tr class="text-center bg-soft-success">
                                                <td class="border border-success p-1">
                                                    <h4 class="card-title m-0">Nama Lokasi</h4>
                                                    <span>{{$vLok['nama_lokasi']}}</span>
                                                </td>
                                                <td class="border border-success p-1">
                                                    <h4 class="card-title m-0">Nama STO</h4>
                                                    <span>{{$vLok['sto']}}</span>
                                                </td>
                                                <td class="border border-success p-1">
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
                                                    </tr>
                                                </thead>
    
                                                <tbody>
                                                    @foreach ($vLok['desigs'] as $iDes=>$vDes)
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
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                @endforeach
                                
                            </div>

                            {{-- designator Rekon --}}
                            <div class="tab-pane {{ $tab==6?'active':null }}" id="tab6" role="tabpanel">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="custom-file">
                                            <input type="file" wire:model="formUpload.file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Upload File Lokasi Rekon</label>
                                        </div>
                                        @error('formUpload.file')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <input type="number" min="1" value="1" placeholder="jumlah lokasi" wire:model="formUpload.jumlah" class="form-control">
                                            @error('formUpload.jumlah')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md">
                                        <button type="button" wire:click="uploadLokasi" class="btn btn-success">Upload & Proses File</button>
                                        <a href="{{ asset($dt['dt_sp']['file_lokasi']) }}" class="btn btn-danger">Download File Excel</a>
                                    </div>
                                </div>
                                <hr>

                                <h6 class="bg-light p-1 text-center">
                                    <span>DATA GRAND TOTAL</span>
                                </h6>
                                <div class="row">
                                    <div class="col">
                                        <table class="w-100">
                                            <tr class="text-center bg-soft-warning">
                                                <td class="border border-warning p-1 bg-warning">
                                                    <h5 class="mb-0">Rekon</h5>
                                                </td>
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Jumlah Lokasi</h4>
                                                    <span>{{count($dt['dt_tagihan']['dt_lokasi'])}}</span>
                                                </td>
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Grand Total Material SP</h4>
                                                    <span>{{number_format($dt['dt_tagihan']['grand_total_material_rekon'],0,',','.')}}</span>
                                                </td>
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Grand Total Jasa SP</h4>
                                                    <span>{{number_format($dt['dt_tagihan']['grand_total_jasa_rekon'],0,',','.')}}</span>
                                                </td>
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Grand Total SP</h4>
                                                    <span>{{number_format($dt['dt_tagihan']['grand_total_all_rekon'],0,',','.')}}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <h6 class="bg-light p-1 text-center">
                                    <span>DATA LOKASI</span>
                                </h6>
                                @foreach ($dt['dt_tagihan']['dt_lokasi'] as $iLok => $vLok)
            
                                    <div class="table-responsive mb-2">
                                        <table class="w-100">
                                            <tr class="text-center bg-warning">
                                                <td colspan="3" class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Lokasi {{$iLok+1}}</h4>
                                                </td>
                                            </tr>
                                            <tr class="text-center bg-soft-warning">
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Nama Lokasi</h4>
                                                    <span>{{$vLok['nama_lokasi']}}</span>
                                                </td>
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Nama STO</h4>
                                                    <span>{{$vLok['sto']}}</span>
                                                </td>
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">ID Project</h4>
                                                    <span>{{$vLok['id_project']}}</span>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="w-100 mt-1">
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

                            {{-- turnkey --}}
                            <div class="tab-pane {{ $tab==4?'active':null }}" id="tab4" role="tabpanel">
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-warning text-center" role="alert">
                                            Abaikan form ini jika tagihan tidak memiliki Turnkey
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label>Tgl. Turnkey</label>
                                            <input type="date" wire:model="dt.dt_tagihan.dt_turnkey.tgl_turnkey" class="form-control @error('dt.dt_tagihan.dt_turnkey.tgl_turnkey') is-invalid @enderror">
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
                                                                    <td><input type="radio" wire:model="dt.dt_tagihan.dt_turnkey.rincian.{{$index}}" value="1" {{ $dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==1?"cheked":null }}></td>
                                                                    <td><input type="radio" wire:model="dt.dt_tagihan.dt_turnkey.rincian.{{$index}}" value="0" {{ $dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==0?"cheked":null }}></td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td>{{ $i+1 }}</td>
                                                                <td class="text-left">{{ $item }} {{$index}}</td>
                                                                <td><input type="radio" wire:model="dt.dt_tagihan.dt_turnkey.rincian.{{$index}}" value="1" {{ $dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==1?"cheked":null }}></td>
                                                                <td><input type="radio" wire:model="dt.dt_tagihan.dt_turnkey.rincian.{{$index}}" value="0" {{ $dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==0?"cheked":null }}></td>
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


                            {{-- pejabat --}}
                            <div class="tab-pane {{ $tab==5?'active':null }}" id="tab5" role="tabpanel">
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label>GM. Telkom Akses (Pejabat)</label>
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.gm_ta_pejabat" class="form-control @error('dt.dt_tagihan.dt_ttd.gm_ta_pejabat') is-invalid @enderror">
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
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.gm_ta_jabatan" class="form-control @error('dt.dt_tagihan.dt_ttd.gm_ta_jabatan') is-invalid @enderror">
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
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.mgr_unit_pejabat" class="form-control @error('dt.dt_tagihan.dt_ttd.mgr_unit_pejabat') is-invalid @enderror">
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
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.mgr_unit_jabatan" class="form-control @error('dt.dt_tagihan.dt_ttd.mgr_unit_jabatan') is-invalid @enderror">
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
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.sm_unit_pejabat" class="form-control @error('dt.dt_tagihan.dt_ttd.sm_unit_pejabat') is-invalid @enderror">
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
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.sm_unit_jabatan" class="form-control @error('dt.dt_tagihan.dt_ttd.sm_unit_jabatan') is-invalid @enderror">
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
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.mgr_shared_pejabat" class="form-control @error('dt.dt_tagihan.dt_ttd.mgr_shared_pejabat') is-invalid @enderror">
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
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.mgr_shared_jabatan" class="form-control @error('dt.dt_tagihan.dt_ttd.mgr_shared_jabatan') is-invalid @enderror">
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
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.waspang_pejabat" class="form-control @error('dt.dt_tagihan.dt_ttd.waspang_pejabat') is-invalid @enderror">
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
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.waspang_jabatan" class="form-control @error('dt.dt_tagihan.dt_ttd.waspang_jabatan') is-invalid @enderror">
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
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.gudang_pejabat" class="form-control @error('dt.dt_tagihan.dt_ttd.gudang_pejabat') is-invalid @enderror">
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
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.gudang_jabatan" class="form-control @error('dt.dt_tagihan.dt_ttd.gudang_jabatan') is-invalid @enderror">
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

                            
                            {{--  --}}
                            
                        </div>
    
                        <hr>
                        {{--  --}}

                    </form>


                </div>

            </div>
        </div>
    </div>

    @include('mods.tagihan.atc.create_tagihan_atc')

</div>