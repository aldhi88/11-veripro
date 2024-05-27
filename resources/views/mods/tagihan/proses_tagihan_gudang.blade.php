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