<div>
    
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        {{-- <div class="col text-right">
            <a href="{{ route('sp.index') }}" class="btn btn-success btn-sm">Data SP Induk</a>
        </div> --}}
    </div><hr>


    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach ($dtAman as $i => $item)
                            <a class="nav-link mb-2 {{ $dtAman->count()-$i == $dtAman->count()?'active show':null }}" data-toggle="pill" href="#content_{{$i+1}}" role="tab">Amandemen {{ $dtAman->count()-$i }}</a>
                        @endforeach
                        <a class="nav-link mb-2 {{ $dtAman->count() > 0?null:'active' }}" data-toggle="pill" href="#home" role="tab">SP Induk</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            
            <div class="card">
                <div class="card-body">

                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">

                        <div class="tab-pane fade {{ $dtAman->count() > 0?null:'active show' }}" id="home">
                            <div class="row">
                                <div class="col">
                                    
                                    <h6>Data Surat Pesanan</h6>

                                    <table class="table table-striped table-bordered table-sm mb-0">
        
                                        <tbody>
                                            <tr>
                                                <th style="width: 200px">File SP</th>
                                                <td style="width: 10px">:</td>
                                                <td><a target="_blank" class="btn btn-sm btn-danger" href="{{asset(str_replace('public/','storage/',json_decode($dtSpInduk->json,true)['file_sp']))}}">Lihat</a></td>
                                            </tr>
                                            <tr>
                                                <th>Nomor SP</th>
                                                <td>:</td>
                                                <td>{{ $dtSpInduk->no_sp}}</td>
                                            </tr>
                                            <tr>
                                                <th>Tujuan Mitra</th>
                                                <td>:</td>
                                                <td>{{ json_decode($dtSpInduk->mitras->master_users->detail, true)['perusahaan'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>KHS Induk</th>
                                                <td>:</td>
                                                <td>{{ $dtSpInduk->khs_induks->no_khs }}</td>
                                            </tr>
                                            <tr>
                                                <th>KHS Amandemen</th>
                                                <td>:</td>
                                                <td>{{ json_decode($dtSpInduk->json, true)['no_aman'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal SP</th>
                                                <td>:</td>
                                                <td>{{ Carbon\Carbon::parse($dtSpInduk->tgl_sp)->format('d/m/Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal TOC</th>
                                                <td>:</td>
                                                <td>{{ Carbon\Carbon::parse($dtSpInduk->tgl_toc)->format('d/m/Y') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Pekerjaan</th>
                                                <td>:</td>
                                                <td>{{ $dtSpInduk->master_units->nama }}</td>
                                            </tr>
                                            <tr>
                                                <th>PPN %</th>
                                                <td>:</td>
                                                <td>{{ json_decode($dtSpInduk->original_json, true)['ppn'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>ID Project</th>
                                                <td>:</td>
                                                <td>{{ json_decode($dtSpInduk->original_json, true)['id_project'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Pekerjaan</th>
                                                <td>:</td>
                                                <td>{{ json_decode($dtSpInduk->original_json, true)['nama_pekerjaan'] }}</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    
                                    <div style="height: 30px"></div>
                
                                    <h6>Data Lokasi & Designator</h6>

                                    <div class="row">
                                    
                                        <div class="col text-center">
                                            <div class="bg-soft-success p-2 rounded border border-success">
                                                <h6 class="card-title">Jumlah Lokasi</h6>
                                                <span>{{count($dtJsonOri['lokasi'])}}</span>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="bg-soft-success p-2 rounded border border-success">
                                                <h6 class="card-title">Total Material</h6>
                                                <span>{{number_format($dtJsonOri['grand_total_material'],0,',','.')}}</span>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="bg-soft-success p-2 rounded border border-success">
                                                <h6 class="card-title">Total Jasa</h6>
                                                <span>{{number_format($dtJsonOri['grand_total_jasa'],0,',','.')}}</span>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="bg-soft-success p-2 rounded border border-success">
                                                <h6 class="card-title">Grand Total</h6>
                                                <span>{{number_format($dtJsonOri['grand_total_all'],0,',','.')}}</span>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <hr>
                
                                    @foreach ($dtJsonOri['lokasi'] as $key => $item)
                                        
                                        <div class="row mt-2">
                                            <div class="col">
                                                <table class="table table-striped table-bordered table-sm mb-1" style="font-size: 90%">
                                                    <tbody>
                                                        <tr class="text-center bg-soft-warning text-dark">
                                                            <td class="border border-warning">
                                                                <strong>Nama Lokasi {{$key+1}}</strong> <br> 
                                                                {{ $item['nama_lokasi'] }}
                                                            </td>
                                                            <td class="border border-warning">
                                                                <strong>Nama STO {{$key+1}}</strong> <br> 
                                                                {{ $item['nama_sto'] }}
                                                            </td>
                                                            <td class="border border-warning">
                                                                <strong>Total Material Lokasi {{$key+1}}</strong> <br>
                                                                {{ number_format($item['total_material_lokasi'] ,0,',','.') }}
                                                            </td>
                                                            <td class="border border-warning">
                                                                <strong>Total Jasa Lokasi {{$key+1}}</strong> <br>
                                                                {{ number_format($item['total_jasa_lokasi'] ,0,',','.') }}
                                                            </td>
                                                            <td class="border border-warning">
                                                                <strong>Total Lokasi {{$key+1}}</strong> <br>
                                                                {{ number_format($item['total_lokasi'] ,0,',','.') }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="table-responsive">

                                            <table class="table table-sm table-bordered table-striped" style="font-size: 95%">
                                                <thead>
                                                    <tr class="bg-light">
                                                        <td rowspan="2" widtd="40" class="text-center">No</td>
                                                        <td rowspan="2" class="text-center" widtd="150">Designator</td>
                                                        <td rowspan="2" class="text-center" widtd="150">Uraian</td>
                                                        <td rowspan="2" class="text-center">Satuan</td>
                                                        <td colspan="2" class="text-center text-dark bg-soft-secondary ">Harga Satuan</td>
                                                        <td rowspan="2" class="text-center" widtd="100">Volume</td>
                                                        <td colspan="3" class="text-center bg-soft-secondary text-dark">Total Harga</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-light text-center">Material</td>
                                                        <td class="bg-light text-center">Jasa</td>
                                                        <td class="bg-light text-center">Material</td>
                                                        <td class="bg-light text-center">Jasa</td>
                                                        <td class="bg-light text-center">Total</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($item['desig_items'] as $i=>$val)
                                                        <tr>
                                                            <td class="text-center">{{$i+1}}</td>
                                                            <td>{{ $val['nama'] }}</td>
                                                            <td>
                                                                <span title="{{$val['uraian']}}">
                                                                    <small>{{ Str::limit($val['uraian'], 20, '...') }}</small>
                                                                </span>
                                                            </td>
                                                            <td>{{ $val['satuan'] }}</td>
                                                            <td class="text-right">{{ number_format($val['material_b'] ,0,',','.')}}</td>
                                                            <td class="text-right">{{ number_format($val['jasa_b'] ,0,',','.')}}</td>
                                                            <td class="text-right">{{ number_format($val['volume'] ,0,',','.')}}</td>
                                                            <td class="text-right">{{ number_format($val['total_material'] ,0,',','.')}}</td>
                                                            <td class="text-right">{{ number_format($val['total_jasa'] ,0,',','.')}}</td>
                                                            <td class="text-right">{{ number_format($val['total_material']+$val['total_jasa'] ,0,',','.')}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            
                                        </div>

                
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        @foreach ($dtAman as $i => $item)
                            <div class="tab-pane fade {{ $dtAman->count()-$i == $dtAman->count()?'active show':null }}" id="content_{{$i+1}}">
                                <div class="row">
                                    <div class="col">
                                        {{-- <a href="{{ route('sp.editAman', $item->id) }}" class="btn btn-sm btn-warning mb-2">Edit</a> --}}
                                        
                                        @php
                                            unset($dtJson);
                                            $dtJson['msg'] = 'menghapus data Amandemen SP '.$item->no_sp;
                                            $dtJson['attr'] = $item->no_sp;
                                            $dtJson['id'] = $item->id;
                                            $dtJson['callback'] = "detailsp-delete";
                                            $dtJson = json_encode($dtJson);
                                        @endphp    
                                        
                                        @if(auth()->user()->master_users->auth_role_id <= 2)
                                        <a class="btn btn-danger btn-sm mb-2" data-emit="modalconfirm-prepare" data-toggle="modal" data-target="#modalConfirm" href="javascript:void(0);" data-json="{{$dtJson}}"><i class="fas fa-trash-alt fa-fw"></i> Hapus</a>
                                        @endif
                                        <hr>
                                        <h6>Data Surat Pesanan</h6>

                                        <table class="table table-striped table-bordered table-sm mb-0">
            
                                            <tbody>
                                                <tr>
                                                    <th style="width: 200px">File SP</th>
                                                    <td style="width: 10px">:</td>
                                                    <td><a target="_blank" class="btn btn-sm btn-danger" href="{{asset(str_replace('public/','storage/',json_decode($item->json,true)['file_sp']))}}">Lihat</a></td>
                                                </tr>
                                                <tr>
                                                    <th>Nomor SP</th>
                                                    <td>:</td>
                                                    <td>{{ $item->no_sp}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tujuan Mitra</th>
                                                    <td>:</td>
                                                    <td>{{ json_decode($item->sp_induks->mitras->master_users->detail, true)['perusahaan'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>KHS Induk</th>
                                                    <td>:</td>
                                                    <td>{{ $item->sp_induks->khs_induks->no_khs }}</td>
                                                </tr>
                                                <tr>
                                                    <th>KHS Amandemen</th>
                                                    <td>:</td>
                                                    <td>{{ json_decode($item->json, true)['no_aman'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal SP</th>
                                                    <td>:</td>
                                                    <td>{{ Carbon\Carbon::parse($item->tgl_sp)->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal TOC</th>
                                                    <td>:</td>
                                                    <td>{{ Carbon\Carbon::parse($item->tgl_toc)->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Pekerjaan</th>
                                                    <td>:</td>
                                                    <td>{{ $item->sp_induks->master_units->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <th>PPN %</th>
                                                    <td>:</td>
                                                    <td>{{ json_decode($item->json, true)['ppn'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>ID Project</th>
                                                    <td>:</td>
                                                    <td>{{ json_decode($item->json, true)['id_project'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Pekerjaan</th>
                                                    <td>:</td>
                                                    <td>{{ json_decode($item->json, true)['nama_pekerjaan'] }}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <th>Nomor BAUT</th>
                                                    <td>:</td>
                                                    <td>{{ json_decode($item->json, true)['no_baut'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nomor BA Rekon</th>
                                                    <td>:</td>
                                                    <td>{{ json_decode($item->json, true)['no_ba_rekon'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nomor BA Gambar</th>
                                                    <td>:</td>
                                                    <td>{{ json_decode($item->json, true)['no_ba_gambar'] }}</td>
                                                </tr> --}}
                                                
                                                
                                            </tbody>
                                        </table>
                                        
                                        <div style="height: 30px"></div>
                    
                                        <h6>Data Lokasi & Designator</h6>
                                        
                                        <div class="row">
                                            <div class="col text-center">
                                                <div class="bg-soft-success p-2 rounded border border-success">
                                                    <h6 class="card-title">Jumlah Lokasi</h6>
                                                    <span>{{count(json_decode($item->json, true)['lokasi'])}}</span>
                                                </div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="bg-soft-success p-2 rounded border border-success">
                                                    <h6 class="card-title">Total Material</h6>
                                                    <span>{{number_format(json_decode($item->json, true)['grand_total_material'],0,',','.')}}</span>
                                                </div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="bg-soft-success p-2 rounded border border-success">
                                                    <h6 class="card-title">Total Jasa</h6>
                                                    <span>{{number_format(json_decode($item->json, true)['grand_total_jasa'],0,',','.')}}</span>
                                                </div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="bg-soft-success p-2 rounded border border-success">
                                                    <h6 class="card-title">Grand Total</h6>
                                                    <span>{{number_format(json_decode($item->json, true)['grand_total_all'],0,',','.')}}</span>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <hr>
                    
                                        @foreach (json_decode($item->json, true)['lokasi'] as $key => $itemDesig)
                                            
                                            
                                            <div class="row">
                                                <div class="col">
                                                    <table class="table table-striped table-bordered table-sm mb-1">
                                                        <tbody>
                                                            {{-- <tr class="text-center" style="font-weight: bold">
                                                                <th>Nama Lokasi {{$key+1}}:  {{ $itemDesig['nama'] }}</th>
                                                                <th>STO: {{ $itemDesig['sto'] }}</th>
                                                                <th>Total: {{ number_format($itemDesig['total_sp_lokasi'] ,0,',','.') }}</th>
                                                            </tr> --}}

                                                            <tr class="text-center bg-soft-warning text-dark">
                                                                <td class="border border-warning">
                                                                    <strong>Nama Lokasi {{$key+1}}</strong> <br> 
                                                                    {{ $itemDesig['nama_lokasi'] }}
                                                                </td>
                                                                <td class="border border-warning">
                                                                    <strong>Nama STO {{$key+1}}</strong> <br> 
                                                                    {{ $itemDesig['nama_sto'] }}
                                                                </td>
                                                                <td class="border border-warning">
                                                                    <strong>Total Material Lokasi {{$key+1}}</strong> <br>
                                                                    {{ number_format($itemDesig['total_material_lokasi'] ,0,',','.') }}
                                                                </td>
                                                                <td class="border border-warning">
                                                                    <strong>Total Jasa Lokasi {{$key+1}}</strong> <br>
                                                                    {{ number_format($itemDesig['total_jasa_lokasi'] ,0,',','.') }}
                                                                </td>
                                                                <td class="border border-warning">
                                                                    <strong>Total Lokasi {{$key+1}}</strong> <br>
                                                                    {{ number_format($itemDesig['total_lokasi'] ,0,',','.') }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <table class="table table-sm table-bordered table-striped">
                                                <thead>
                                                    <tr class="bg-light">
                                                        <th rowspan="2" width="40" class="text-center">No</th>
                                                        <th rowspan="2" class="text-center" width="150">Designator</th>
                                                        <th rowspan="2" class="text-center" width="250">Uraian</th>
                                                        <th rowspan="2" class="text-center">Satuan</th>
                                                        <th colspan="2" class="text-center text-dark bg-soft-secondary ">Harga Satuan</th>
                                                        <th rowspan="2" class="text-center" width="100">Volume</th>
                                                        <th colspan="3" class="text-center bg-soft-secondary text-dark">Total Harga</th>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-light text-center">Material</th>
                                                        <th class="bg-light text-center">Jasa</th>
                                                        <th class="bg-light text-center">Material</th>
                                                        <th class="bg-light text-center">Jasa</th>
                                                        <th class="bg-light text-center">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($itemDesig['desig_items'] as $i=>$val)
                                                        <tr>
                                                            <td>{{$i+1}}</td>
                                                            <td>{{ $val['nama'] }}</td>
                                                            <td>
                                                                <span title="{{$val['uraian']}}">
                                                                    <small>{{ Str::limit($val['uraian'], 20, '...') }}</small>
                                                                </span>
                                                            </td>
                                                            <td>{{ $val['satuan'] }}</td>
                                                            <td class="text-right">{{ number_format($val['material_b'] ,0,',','.')}}</td>
                                                            <td class="text-right">{{ number_format($val['jasa_b'] ,0,',','.')}}</td>
                                                            <td class="text-right">{{ number_format($val['volume'] ,0,',','.')}}</td>
                                                            <td class="text-right">{{ number_format($val['total_material'] ,0,',','.')}}</td>
                                                            <td class="text-right">{{ number_format($val['total_jasa'] ,0,',','.')}}</td>
                                                            <td class="text-right">{{ number_format($val['total_material']+$val['total_jasa'] ,0,',','.')}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                    
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>