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
                                    <span class="d-none d-sm-block">Designator</span>   
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
                                                    <span>{{count($dt['dt_sp']['json']['lokasi'])}}</span>
                                                </td>
                                                <td class="border border-success p-1">
                                                    <h4 class="card-title m-0">Grand Total Material</h4>
                                                    <span>{{number_format($dt['dt_tagihan']['grand_total_material'],0,',','.')}}</span>
                                                </td>
                                                <td class="border border-success p-1">
                                                    <h4 class="card-title m-0">Grand Total Jasa</h4>
                                                    <span>{{number_format($dt['dt_tagihan']['grand_total_jasa'],0,',','.')}}</span>
                                                </td>
                                                <td class="border border-success p-1">
                                                    <h4 class="card-title m-0">Grand Total</h4>
                                                    <span>{{number_format($dt['dt_tagihan']['grand_total_all'],0,',','.')}}</span>
                                                </td>
                                            </tr>
                                            <tr class="text-center bg-soft-warning">
                                                <td class="border border-warning p-1 bg-warning">
                                                    <h5 class="mb-0">REKON</h5>
                                                </td>
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0"></i> Jumlah Lokasi</h4>
                                                    <span>{{count($dt['dt_tagihan']['dt_lokasi'])}}</span>
                                                </td>
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Grand Total Material</h4>
                                                    <span>{{number_format($dt['dt_tagihan']['grand_total_material_rekon'],0,',','.')}}</span>
                                                </td>
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Grand Total Jasa</h4>
                                                    <span>{{number_format($dt['dt_tagihan']['grand_total_jasa_rekon'],0,',','.')}}</span>
                                                </td>
                                                <td class="border border-warning p-1">
                                                    <h4 class="card-title m-0">Grand Total</h4>
                                                    <span>{{number_format($dt['dt_tagihan']['grand_total_all_rekon'],0,',','.')}}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                @for ($a=0;$a<count($dt['dt_tagihan']['dt_lokasi']);$a++)
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="bg-soft-secondary border border-secondary p-1 text-center">
                                                @if ($a+1>1)
                                                    <a class="float-left" wire:click="delLoc({{$a}})" href="javascript:void(0)"><i class="fas fa-trash-alt text-danger"></i></a>
                                                @endif
                                                <h4 class="card-title m-0">Lokasi {{$a+1}}</h4>
                                            </div>
                                        </div>
                                        <div class="col-12 my-1">
                                            <div class="row">
                                                <div class="col-9 pr-0">
                                                    <div class="border border-secondary p-1">
                                                        <input placeholder="Ketik Nama Lokasi" wire:model="dt.dt_tagihan.dt_lokasi.{{$a}}.nama_lokasi" type="text" class="w-100 border-0 @error('dt.dt_tagihan.dt_lokasi.'.strval($a).'.nama_lokasi') bg-soft-danger @enderror">
                                                    </div>
                                                </div>
                                                <div class="col pl-0">
                                                    <div class="border border-secondary border-left-0 p-1">
                                                        <input placeholder="Ketik Nama STO" wire:model="dt.dt_tagihan.dt_lokasi.{{$a}}.nama_sto" type="text" class="w-100 border-0 @error('dt.dt_tagihan.dt_lokasi.'.strval($a).'.nama_sto') bg-soft-danger @enderror">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 pr-1">
                                            <div class="row">
                                                <div class="col-12 mb-1">
                                                    <div class="bg-soft-success border border-success p-1 text-center">
                                                        <h4 class="card-title m-0">SP</h4>
                                                    </div>
                                                </div>
                                                <div class="col-4 pr-1">
                                                    <div class="border border-success p-1 text-center">
                                                        <h4 class="card-title m-0">Total Material</h4>
                                                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi'][$a]['total_material_lokasi'],0,',','.')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-4 px-1">
                                                    <div class="border border-success p-1 text-center">
                                                        <h4 class="card-title m-0">Total Jasa</h4>
                                                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi'][$a]['total_jasa_lokasi'],0,',','.')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-4 pl-1">
                                                    <div class="border border-success p-1 text-center">
                                                        <h4 class="card-title m-0">Total</h4>
                                                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi'][$a]['total_lokasi'],0,',','.')}}</span>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="col-6 pl-1">
                                            <div class="row">
                                                <div class="col-12 mb-1">
                                                    <div class="bg-soft-warning border border-warning p-1 text-center">
                                                        <h4 class="card-title m-0">Rekon</h4>
                                                    </div>
                                                </div>
                                                <div class="col-4 pr-1">
                                                    <div class="border border-warning p-1 text-center">
                                                        <h4 class="card-title m-0">Total Material</h4>
                                                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi'][$a]['total_material_lokasi_rekon'],0,',','.')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-4 px-1">
                                                    <div class="border border-warning p-1 text-center">
                                                        <h4 class="card-title m-0">Total Jasa</h4>
                                                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi'][$a]['total_jasa_lokasi_rekon'],0,',','.')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-4 pl-1">
                                                    <div class="border border-warning p-1 text-center">
                                                        <h4 class="card-title m-0">Total</h4>
                                                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi'][$a]['total_lokasi_rekon'],0,',','.')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive mt-1">
                                        <table class="lh-80 small td-middle table table-sm table-bordered table-striped m-0">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th rowspan="2" width="40" class="text-center"></th>
                                                    <th rowspan="2" width="40" class="text-center">No</th>
                                                    <th rowspan="2" class="text-center" style="min-width: 250px">Designator</th>
                                                    <th colspan="4" class="text-center text-dark bg-soft-secondary ">Harga Satuan</th>
                                                    <th colspan="4" class="text-center bg-success text-dark">Data SP</th>
                                                    <th colspan="4" class="text-center bg-warning text-dark">Data Rekon</th>
                                                    
                                                </tr>
                                                <tr>
                                                    <th class="bg-light text-center" style="min-width: 120px">Material</th>
                                                    <th class="bg-light text-center" style="max-width: 10px"></th>
                                                    <th class="bg-light text-center" style="min-width: 120px">Jasa</th>
                                                    <th class="bg-light text-center" style="max-width: 10px"></th>
                                                    <th class="bg-soft-success text-center">Vol</th>
                                                    <th class="bg-soft-success text-center">Material</th>
                                                    <th class="bg-soft-success text-center">Jasa</th>
                                                    <th class="bg-soft-success text-center">Total</th>
                                                    <th class="bg-soft-warning text-center" style="min-width: 90px">Vol</th>
                                                    <th class="bg-soft-warning text-center" style="min-width: 110px">Material</th>
                                                    <th class="bg-soft-warning text-center" style="min-width: 110px">Jasa</th>
                                                    <th class="bg-soft-warning text-center" style="min-width: 110px">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            @for ($i=0;$i<count($dt['dt_tagihan']['dt_lokasi'][$a]['desig_items']);$i++)

                                                <tr class="text-center">

                                                    <td class="text-center">
                                                        @if ($i > 0)
                                                            <a wire:click="delDesig({{$a}},{{$i}})" href="javascript:void(0)" class="btn btn-sm btn-danger"><i class="fas fa-times fa-fw"></i></a>
                                                        @else
                                                            <a wire:click="initDesig({{$a}},{{ count($dt['dt_tagihan']['dt_lokasi'][$a]['desig_items']) }})" href="javascript:void(0)" class="btn btn-sm btn-success"><i class="fas fa-plus fa-fw"></i></a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{$i+1}}</td>
                                                    
                                                    <td class="text-left">
                                                        <div wire:ignore class="text-left">
                                                            <select data-lokasi="{{$a}}" data-row="{{$i}}" id="select_{{($a)."_".($i)}}" class="item-desig form-control form-control-sm w-100">
                                                            </select>
                                                        </div>
                                                        @error('dt_lokasi.'.strval($a).'.desig_items.'.strval($i).'.id')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </td>
                                                    <td class="text-right">
                                                        @if (
                                                            $dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['fix_price'] === null ||  
                                                            $dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['fix_price'] == 1 ||  
                                                            $dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['boxmat_rekon'] === "" 
                                                        )
                                                            {{ number_format($dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['material_b_rekon'],0,',','.') }}
                                                        @else
                                                            <input min="0" 
                                                                class="form-control form-control-sm text-center" 
                                                                wire:model="dt.dt_tagihan.dt_lokasi.{{$a}}.desig_items.{{$i}}.material_b_rekon" 
                                                                wire:change="reTotal({{$a}},{{$i}})" 
                                                                type="number">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input id="boxmat_rekon_{{($a)."_".($i)}}" type="checkbox" 
                                                            wire:change="checkMatJas({{$a}},{{$i}},'{{$dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['boxmat_rekon']}}', 'material_rekon')" 
                                                            {{ $dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['boxmat_rekon'] }}>
                                                    </td>
                                                    <td class="text-right">
                                                        @if (
                                                            $dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['fix_price'] === null || 
                                                            $dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['fix_price'] == 1 ||  
                                                            $dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['boxjas_rekon'] === "" 
                                                        )
                                                            {{ number_format($dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['jasa_b_rekon'],0,',','.') }}
                                                        @else
                                                            <input min="0"  
                                                                class="form-control form-control-sm text-center" 
                                                                wire:model="dt.dt_tagihan.dt_lokasi.{{$a}}.desig_items.{{$i}}.jasa_b_rekon" 
                                                                wire:change="reTotal({{$a}},{{$i}})" 
                                                                type="number">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <input id="boxjas_rekon_{{($a)."_".($i)}}" type="checkbox" 
                                                            wire:change="checkMatJas({{$a}},{{$i}},'{{$dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['boxjas_rekon']}}', 'jasa_rekon')" 
                                                            {{ $dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['boxjas_rekon'] }}>
                                                    </td>
                                                    <td>{{ $dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['volume'] }}</td>
                                                    <td class="text-right">{{ number_format($dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['total_material'],0,',','.') }}</td>
                                                    <td class="text-right">{{ number_format($dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['total_jasa'],0,',','.') }}</td>
                                                    <td class="text-right">{{ number_format($dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['total'],0,',','.') }}</td>

                                                    <td>
                                                        <input min="0" wire:change="reTotal({{$a}},{{$i}})" class="form-control form-control-sm text-center" wire:model="dt.dt_tagihan.dt_lokasi.{{$a}}.desig_items.{{$i}}.volume_rekon" type="number">
                                                    </td>
                                                    <td class="text-right">{{ number_format($dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['total_material_rekon'],0,',','.') }}</td>
                                                    <td class="text-right">{{ number_format($dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['total_jasa_rekon'],0,',','.') }}</td>
                                                    <td class="text-right">{{ number_format($dt['dt_tagihan']['dt_lokasi'][$a]['desig_items'][$i]['total_rekon'],0,',','.') }}</td>
                                                    
                                                </tr>
                                                
                                            @endfor

                                            </tbody>
                                        </table>

                                        @if ($a+1 == count($dt['dt_tagihan']['dt_lokasi']))
                                            <hr>
                                            <button wire:click="initLoc({{ count($dt['dt_tagihan']['dt_lokasi']) }})" type="button" class="rounded-0 btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Lokasi</button>
                                        @endif
                    
                                    </div>
                                @endfor
                                
                            </div>

                            <div class="tab-pane {{ $tab==3?'active':null }}" id="tab3" role="tabpanel">
                                
                                {{-- diambil --}}
                                <div class="row">
                                    <div class="col">
                                        <h6>MATERIAL YANG DIAMBIL</h6>
                                        <table class="table-bordered lh-80 small table table-sm m-0 table-bordered table-striped nowrap middle-text">
                                            <thead class="bg-light text-center">
                                                <tr>
                                                    <th rowspan="2" width="50">
                                                        <a wire:click="addAmbil({{count($dt['dt_tagihan']['dt_gudang']['ambil']['data'])}})" href="javascript:void(0)" class="btn btn-sm btn-success"><i class="fas fa-plus fa-fw"></i></a>
                                                    </th>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">No. RFC</th>
                                                    <th rowspan="2" width="130">Tgl. RFC</th>
                                                    @foreach ($allDesigs as $item)
                                                    <th>
                                                        <div class="verticalTableHeader">{{$item['nama']}}</div>
                                                    </th>
                                                    @endforeach
                                                    
                                                </tr>
                                                <tr>
                                                    @foreach ($allDesigs as $item)
                                                    <th width="60">{{$item['satuan']}}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr><td></td></tr>
                                                @foreach ($dt['dt_tagihan']['dt_gudang']['ambil']['data'] as $iRowAmbil=>$vRowAmbil)
                                                    <tr class="text-center">
                                                        <td>
                                                            <a wire:click="delAmbil({{$iRowAmbil}})" href="javascript:void(0)" class="btn btn-sm btn-danger"><i class="fas fa-times fa-fw"></i></a>
                                                        </td>
                                                        <td>{{$iRowAmbil+1}}</td>
                                                        <td>
                                                            <input class="w-100" type="text" wire:model="dt.dt_tagihan.dt_gudang.ambil.data.{{$iRowAmbil}}.no_rfc">
                                                        </td>
                                                        <td>
                                                            <input class="w-100" type="date" wire:model="dt.dt_tagihan.dt_gudang.ambil.data.{{$iRowAmbil}}.tgl_rfc">
                                                        </td>
                                                        @foreach ($vRowAmbil['nilai'] as $iNilaiAmbil=>$vNilaiAmbil)
                                                        <td>
                                                            <input id="{{rand()}}" wire:change="reTotalAmbil()" min="0" style="width: 60px" class="w-100" type="number" wire:model="dt.dt_tagihan.dt_gudang.ambil.data.{{$iRowAmbil}}.nilai.{{$iNilaiAmbil}}">
                                                        </td>
                                                        @endforeach
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tr><td colspan="{{ count($allDesigs)+4 }}"><hr class="m-0 p-0"></td></tr>
                                            <tfoot class="bg-light">
                                                <tr class="text-dark">
                                                    <th colspan="4">TOTAL MATERIAL</th>
                                                    @foreach ($dt['dt_tagihan']['dt_gudang']['ambil']['total'] as $iNilaiAmbil=>$vNilaiAmbil)
                                                    <th class="text-center">{{$vNilaiAmbil}}</th>
                                                    @endforeach
                                                </tr>
                                            </tfoot>
                                        </table>

                                        
                                    </div>
                                </div>

                                {{-- dipakai --}}
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
                                                    @foreach ($allDesigs as $item)
                                                    <th>
                                                        <div class="verticalTableHeader">{{$item['nama']}}</div>
                                                    </th>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    @foreach ($allDesigs as $item)
                                                    <th width="60">{{$item['satuan']}}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($dt['dt_tagihan']['dt_lokasi'] as $iLok=>$vLok)
                                                    <tr class="text-center">
                                                        <td>{{$iLok+1}}</td>
                                                        <td>{{$vLok['nama_lokasi']}}</td>
                                                        <td>{{$dt['dt_sp']['json']['id_project']}}</td>
                                                        @foreach ($allDesigs as $iDesMat=>$vDesMat)
                                                        <td>
                                                            <input wire:change="reTotalPakai()" style="width: 60px" type="number" min="0" wire:model="dt.dt_tagihan.dt_gudang.pakai.data.{{$iLok}}.{{$iDesMat}}">
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tr><td colspan="{{ count($allDesigs)+3 }}"><hr class="m-0 p-0"></td></tr>
                                            <tfoot class="bg-light">
                                                <tr class="text-dark">
                                                    <th colspan="3">TOTAL MATERIAL</th>
                                                    @foreach ($allDesigs as $iDesMat=>$vDesMat)
                                                    <th class="text-center">{{$dt['dt_tagihan']['dt_gudang']['pakai']['total'][$iDesMat]}}</th>
                                                    @endforeach
                                                </tr>
                                            </tfoot>
                                        </table>

                                        
                                    </div>
                                </div>

                                {{-- kembali --}}
                                <hr> 
                                <div class="row">
                                    <div class="col">
                                        <h6>PENGEMBALIAN MATERIAL</h6>
                                        <table class="table-bordered lh-80 small table table-sm m-0 table-bordered table-striped nowrap middle-text">
                                            <thead class="bg-light text-center">
                                                <tr>
                                                    <th rowspan="2" width="50">
                                                        <a wire:click="addKembali({{count($dt['dt_tagihan']['dt_gudang']['kembali']['data'])}})" href="javascript:void(0)" class="btn btn-sm btn-success"><i class="fas fa-plus fa-fw"></i></a>
                                                    </th>
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">ID Pengembalian</th>
                                                    <th rowspan="2" width="130">Tgl. RFR</th>
                                                    @foreach ($allDesigs as $item)
                                                    <th><div class="verticalTableHeader">{{$item['nama']}}</div></th>
                                                    @endforeach
                                                    
                                                </tr>
                                                <tr>
                                                    @foreach ($allDesigs as $item)
                                                    <th width="60">{{$item['satuan']}}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr><td></td></tr>
                                                @foreach ($dt['dt_tagihan']['dt_gudang']['kembali']['data'] as $iRowKembali=>$vRowKembali)
                                                    <tr class="text-center">
                                                        <td>
                                                            <a wire:click="delKembali({{$iRowKembali}})" href="javascript:void(0)" class="btn btn-sm btn-danger"><i class="fas fa-times fa-fw"></i></a>
                                                        </td>
                                                        <td>{{$iRowKembali+1}}</td>
                                                        <td>
                                                            <input class="w-100" type="text" wire:model="dt.dt_tagihan.dt_gudang.kembali.data.{{$iRowKembali}}.id_kembali">
                                                        </td>
                                                        <td>
                                                            <input class="w-100" type="date" wire:model="dt.dt_tagihan.dt_gudang.kembali.data.{{$iRowKembali}}.tgl_rfr">
                                                        </td>
                                                        @foreach ($vRowKembali['nilai'] as $iNilaiKembali=>$vNilaiKembali)
                                                        <td>
                                                            <input id="{{rand()}}" wire:change="reTotalKembali()" min="0" style="width: 60px" class="w-100" type="number" wire:model="dt.dt_tagihan.dt_gudang.kembali.data.{{$iRowKembali}}.nilai.{{$iNilaiKembali}}">
                                                        </td>
                                                        @endforeach
                                                        
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tr><td colspan="{{ count($allDesigs)+4 }}"><hr class="m-0 p-0"></td></tr>
                                            <tfoot class="bg-light">
                                                <tr class="text-dark">
                                                    <th colspan="4">TOTAL PENGEMBALIAN MATERIAL</th>
                                                    @foreach ($dt['dt_tagihan']['dt_gudang']['kembali']['total'] as $iNilaiKembali=>$vNilaiKembali)
                                                    <th class="text-center">{{$vNilaiKembali}}</th>
                                                    @endforeach
                                                </tr>
                                                <tr><td colspan="{{ count($allDesigs)+4 }}"><hr class="mb-0 bg-warning"></td></tr>
                                                <tr class="text-dark bg-soft-warning">
                                                    <th colspan="4" class="border border-warning">GRAND TOTAL SISA MATERIAL</th>
                                                    @foreach ($dt['dt_tagihan']['dt_gudang']['grand_total'] as $iGt=>$vGt)
                                                    <th class="border border-warning text-center">{{$vGt}}</th>
                                                    @endforeach
                                                </tr>
                                            </tfoot>
                                            
                                        </table>

                                        
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col">
                                        <h6>Keterangan: 
                                            <a wire:click="addKetKembali()" href="javascript:void(0)" class="btn btn-sm btn-success"><i class="fas fa-plus fa-fw"></i></a>
                                        </h6>
                                        <table class="w-100">
                                            @foreach ($dt['dt_tagihan']['dt_gudang']['kembali']['ket'] as $i=>$v)
                                            <tr>
                                                <td width="20"><i wire:click="delKetKembali({{$i}})" class="fas fa-times text-danger float-left"></i></td>
                                                <td><input class="w-100" type="text" wire:model="dt.dt_tagihan.dt_gudang.kembali.ket.{{$i}}"></td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>

                                {{-- rekon material --}}
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
                                                    <td><textarea class="w-100" wire:model="dt.dt_tagihan.dt_gudang.rekon.{{$iDr}}.nama_barang_alista" rows="3"></textarea></td>
                                                    <td class="text-center">{{$vDr['nama_barang']}}</td>
                                                    <td class="text-center">{{$vDr['sum_rekon']}}</td>
                                                    <td><input style="width: 70px" type="number" min="0" wire:model="dt.dt_tagihan.dt_gudang.rekon.{{$iDr}}.v_ta" wire:change="rePemakaian({{$iDr}},'v_ta')" max="{{$vDr['v_ta']+$vDr['v_mitra']}}"></td>
                                                    <td><input style="width: 70px" type="number" min="0" wire:model="dt.dt_tagihan.dt_gudang.rekon.{{$iDr}}.v_mitra" wire:change="rePemakaian({{$iDr}},'v_mitra')" max="{{$vDr['v_ta']+$vDr['v_mitra']}}"></td>
                                                    <td class="text-center">{{$vDr['v_back']}}</td>
                                                    <td><textarea class="w-100" wire:model="dt.dt_tagihan.dt_gudang.rekon.{{$iDr}}.ket" rows="3"></textarea></td>
                                                </tr>
                                                @endif
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <h6>Keterangan Material Lokasi: 
                                                </h6>
                                                <table class="w-100">
                                                    @foreach ($dt['dt_tagihan']['dt_gudang']['rekon'] as $iDr => $vDr)
                                                    @if ($vDr['sum_rekon'] > 0)
                                                    <tr>
                                                        <td><input class="w-100" type="text" wire:model="dt.dt_tagihan.dt_gudang.rekon.{{$iDr}}.ket_matlok"></td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>

                                
                            </div>

                            <div class="tab-pane {{ $tab==5?'active':null }}" id="tab5" role="tabpanel">
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col">
                                                    <label>GM. Telkom Akses</label>
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.gm_ta" class="form-control @error('dt.dt_tagihan.dt_ttd.gm_ta') is-invalid @enderror">
                                                        <option value="">Pilih nama</option>
                                                        @foreach ($pejabat['gm_ta']['value'] as $item)
                                                        <option value="{{ $item }}">{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('dt.dt_tagihan.dt_ttd.gm_ta')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <label>Mgr. {{$dt['dt_sp']['master_units']['nama']}}</label>
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.mgr_unit" class="form-control @error('dt.dt_tagihan.dt_ttd.mgr_unit') is-invalid @enderror">
                                                        <option value="">Pilih nama</option>@foreach ($pejabat['mgr_'.strtolower($dt['dt_sp']['master_units']['nama'])]['value'] as 
                                                        $item)
                                                        <option value="{{ $item }}">{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('dt.dt_tagihan.dt_ttd.mgr_unit')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <label>SM. {{$dt['dt_sp']['master_units']['nama']}}</label>
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.sm_unit" class="form-control @error('dt.dt_tagihan.dt_ttd.sm_unit') is-invalid @enderror">
                                                        <option value="">Pilih nama</option>@foreach ($pejabat['sm_'.strtolower($dt['dt_sp']['master_units']['nama'])]['value'] as 
                                                        $item)
                                                        <option value="{{ $item }}">{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('dt.dt_tagihan.dt_ttd.sm_unit')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <label>Mgr. Shared Service</label>
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.mgr_shared" class="form-control @error('dt.dt_tagihan.dt_ttd.mgr_shared') is-invalid @enderror">
                                                        <option value="">Pilih nama</option>
                                                        @foreach ($pejabat['mgr_shared']['value'] as $item)
                                                        <option value="{{ $item }}">{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('dt.dt_tagihan.dt_ttd.mgr_shared')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <label>Waspang</label>
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.wapang" class="form-control @error('dt.dt_tagihan.dt_ttd.wapang') is-invalid @enderror">
                                                        <option value="">Pilih nama</option>
                                                        @foreach ($pejabat['wapang']['value'] as $item)
                                                        <option value="{{ $item }}">{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('dt.dt_tagihan.dt_ttd.wapang')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <label>Petugas Gudang</label>
                                                    <select wire:model="dt.dt_tagihan.dt_ttd.gudang" class="form-control @error('dt.dt_tagihan.dt_ttd.gudang') is-invalid @enderror">
                                                        <option value="">Pilih nama</option>
                                                        @foreach ($pejabat['gudang']['value'] as $item)
                                                        <option value="{{ $item }}">{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('dt.dt_tagihan.dt_ttd.gudang')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
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

    @include('mods.tagihan.atc.create_tagihan_atc')

</div>