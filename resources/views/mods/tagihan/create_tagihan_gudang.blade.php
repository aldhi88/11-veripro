<div>
    <div class="row">
        <div class="col">
            <div class="alert alert-warning text-center" role="alert">
                Pastikan tidak ada perubahan data designator sebelum membuat data gudang.
            </div>
        </div>
    </div>
    {{-- diambil --}}
    <div class="row">
        <div class="col">
            <h6>MATERIAL YANG DIAMBIL</h6>
            <div class="table-responsive">

                <table class="table-bordered lh-80 small table table-sm m-0 table-bordered table-striped nowrap middle-text">
                    <thead class="bg-light text-center">
                        <tr>
                            <th rowspan="2" width="50">
                                <a wire:click="addAmbil({{count($dt['dt_tagihan']['dt_gudang']['ambil']['data'])}})" href="javascript:void(0)" class="btn btn-sm btn-success"><i class="fas fa-plus fa-fw"></i></a>
                            </th>
                            <th rowspan="2">No</th>
                            <th rowspan="2" style="min-width: 80px">No. RFC</th>
                            <th rowspan="2" width="130">Tgl. RFC</th>
                            @foreach ($allDesigs as $item)
                            <th>
                                <div class="verticalTableHeader">
                                    @php
                                    if($item['nama_designator']=='' || is_null($item['nama_designator'])){
                                        echo $item['nama_jasa'];
                                    }else{
                                        echo $item['nama_designator'];
                                    }
                                    @endphp
                                </div>
                            </th>
                            @endforeach
                            
                        </tr>
                        <tr>
                            @foreach ($allDesigs as $item)
                            <th style="max-width: 200px">{{$item['satuan']}}</th>
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
                            <div class="verticalTableHeader">
                                @php
                                if($item['nama_designator']=='' || is_null($item['nama_designator'])){
                                    echo $item['nama_jasa'];
                                }else{
                                    echo $item['nama_designator'];
                                }
                                @endphp
                            </div>
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
                    @foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $iLok=>$vLok)
                        <tr class="text-center">
                            <td>{{$iLok+1}}</td>
                            <td>{{$vLok['nama_lokasi']}}</td>
                            <td>{{$vLok['id_project']}}</td>
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
                        <th>
                            <div class="verticalTableHeader">
                                @php
                                if($item['nama_designator']=='' || is_null($item['nama_designator'])){
                                    echo $item['nama_jasa'];
                                }else{
                                    echo $item['nama_designator'];
                                }
                                @endphp
                            </div>
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
                        <td><textarea class="w-100" wire:model="dt.dt_tagihan.dt_gudang.rekon.{{$iDr}}.nama_barang" rows="3"></textarea></td>
                        <td class="text-center">{{$vDr['nama_barang_alista']}}</td>
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