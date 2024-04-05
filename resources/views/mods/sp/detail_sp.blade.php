<div>
    <div class="loading-50" wire:loading><div class="loader"></div></div>
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a wire:click="changeTab('induk','')" class="nav-link {{ $activeTab=="induk"?'active':null }}" data-toggle="tab" href="#content" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-file-archive"></i></span>
                                <span class="d-none d-sm-block">SP Induk</span>    
                            </a>
                        </li>
                        
                        @foreach ($dtAman as $i => $item)
                        <li class="nav-item">
                            <a wire:click="changeTab('aman',{{$item['id']}})" class="nav-link {{ $activeTab=="aman".$item['id']?'active':null }}" data-toggle="tab" href="#content" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-file-alt"></i></span>
                                <span class="d-none d-sm-block">Amandemen {{ $i+1 }}</span>    
                            </a>
                        </li>
                        @endforeach
                        
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-pane active" id="content" role="tabpanel">
                        <div class="tab-content p-3 text-muted">
                            @if (strstr($activeTab, 'aman') == true)
                                @if ($allowEditDelete)
                                    <a href="{{ route('sp.editAman', $dtSp['id']) }}" class="btn btn-sm btn-warning mb-2">Edit</a>
                                @endif

                                @if ($allowEditDelete)
                                    @php
                                        unset($dtJson);
                                        $dtJson['msg'] = 'menghapus data Amandemen SP '.$dtSp['no_sp'];
                                        $dtJson['attr'] = $dtSp['no_sp'];
                                        $dtJson['id'] = $dtSp['id'];
                                        $dtJson['callback'] = "detailsp-delete";
                                        $dtJson = json_encode($dtJson);
                                    @endphp     
                                    <a class="btn btn-danger btn-sm mb-2" data-emit="modalconfirm-prepare" data-toggle="modal" data-target="#modalConfirm" href="javascript:void(0);" data-json="{{$dtJson}}"><i class="fas fa-trash-alt fa-fw"></i> Hapus</a>
                                @endif
                                
                            @endif
                            <div>
                                <h6 class="bg-light p-1 text-center">
                                    <span>DATA SURAT PESANAN</span>
                                </h6>
                                <div class="row">
                                    <div class="form-group mb-0 col-12 col-md-4">
                                        <h6>File SP</h6>
                                        <a class="btn btn-success btn-sm" target="_blank" href="{{ asset($dtSp['file_sp']) }}">Download File</a>
                                    </div>
                                    <div class="form-group mb-0 col-12 col-md-4">
                                        <h6>No SP</h6>
                                        <p>{{ $dtSp['no_sp'] }}</p>
                                    </div>
                                    <div class="form-group mb-0 col-12 col-md-4">
                                        <h6>Tujuan Mitra</h6>
                                        <p>{{ $dtSp['khs_induks']['auth_logins']['master_users']['nama'] }}</p>
                                    </div>

                                    <div class="form-group mb-0 col-12 col-md-6">
                                        <h6>KHS Induk</h6>
                                        <p>{{ $dtSp['khs_induks']['no'] }}</p>
                                    </div>
                                    <div class="form-group mb-0 col-12 col-md-6">
                                        <h6>Amandemen KHS</h6>
                                        <p>{{ is_null($dtSp['khs_amandemens'])?'-':$dtSp['khs_amandemens']['no'] }}</p>
                                    </div>

                                    <div class="form-group mb-0 col-12 col-md-3">
                                        <h6>Tgl.SP</h6>
                                        <p>{{ Carbon\Carbon::parse($dtSp['tgl_sp'])->isoFormat('DD MMMM Y') }}</p>
                                    </div>
                                    <div class="form-group mb-0 col-12 col-md-3">
                                        <h6>Tgl.TOC</h6>
                                        <p>{{ Carbon\Carbon::parse($dtSp['tgl_toc'])->isoFormat('DD MMMM Y') }}</p>
                                    </div>
                                    <div class="form-group mb-0 col-12 col-md-3">
                                        <h6>Jenis Pekerjaan</h6>
                                        <p>{{ $dtSp['master_units']['nama'] }}</p>
                                    </div>
                                    <div class="form-group mb-0 col-12 col-md-3">
                                        <h6>PPN</h6>
                                        <p>{{ $dtSp['ppn'] }}</p>
                                    </div>

                                    <div class="form-group mb-0 col-12 col-md-3">
                                        <h6>Nama Pekerjaan</h6>
                                        <p>{{ $dtSp['nama_pekerjaan'] }}</p>
                                    </div>

                                </div>

                                <h6 class="bg-light p-1 text-center">
                                    <span>DATA LOKASI</span>
                                </h6>
                                <div class="row">
                                    <div class="col">
                                        <table class="w-100">
                                            <tr class="text-center bg-soft-success">
                                                <td class="border border-success p-1">
                                                    <h4 class="card-title m-0">Jumlah Lokasi</h4>
                                                    <span>{{count($dtSp['json']['dtLokasi']['lokasi'])}}</span>
                                                </td>
                                                <td class="border border-success p-1">
                                                    <h4 class="card-title m-0">Grand Total Material SP</h4>
                                                    <span>{{number_format($dtSp['json']['dtLokasi']['grand_total_material'],0,',','.')}}</span>
                                                </td>
                                                <td class="border border-success p-1">
                                                    <h4 class="card-title m-0">Grand Total Jasa SP</h4>
                                                    <span>{{number_format($dtSp['json']['dtLokasi']['grand_total_jasa'],0,',','.')}}</span>
                                                </td>
                                                <td class="border border-success p-1">
                                                    <h4 class="card-title m-0">Grand Total SP</h4>
                                                    <span>{{number_format($dtSp['json']['dtLokasi']['grand_total'],0,',','.')}}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                @foreach ($dtSp['json']['dtLokasi']['lokasi'] as $iLok => $vLok)
            
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
                                                    <h4 class="card-title m-0">Nama Pekerjaan</h4>
                                                    <span>{{$vLok['id_project']}}</span>
                                                </td>
                                            </tr>
                                            <tr class="text-center bg-soft-warning">
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Total Material</h4>
                                                    <span>{{number_format($vLok['total_material_lokasi'],0,',','.')}}</span>
                                                </td>
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Total Jasa</h4>
                                                    <span>{{number_format($vLok['total_jasa_lokasi'],0,',','.')}}</span>
                                                </td>
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Total</h4>
                                                    <span>{{number_format($vLok['total_lokasi'],0,',','.')}}</span>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="lh-80 small table table-sm m-0 table-bordered table-striped nowrap">
                                            <thead class="bg-light text-center">
                                                <tr>
                                                    <th rowspan="2">No</th>
                                                    <th colspan="3">Quality Enhancement (QE) Akses</th>
                                                    <th colspan="2">Harga Satuan</th>
                                                    <th rowspan="2">Vol</th>
                                                    <th colspan="3">Total Harga</th>
                                                </tr>
                                                <tr>
                                                    <th>Material <br> Designator</th>
                                                    <th>Jasa <br> Designator</th>
                                                    <th>Item Designator</th>
                                                    <th>Material</th>
                                                    {{-- <th>Item <br> Mitra</th> --}}
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
                                                        {{-- <td class="text-right">{!!$vDes['material_mitra']?'<i class="fas fa-check"></i>':''!!}</td> --}}
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

                                @endforeach
                                
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</div>
