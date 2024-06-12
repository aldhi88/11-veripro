<div>

    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        @if (Auth::user()->master_users->auth_role_id == 4)
            <div class="col text-right">
                <a href="{{ route('tagihan.index') }}" class="btn btn-success btn-sm">Data Tagihan</a>
            </div>
        @elseif(Auth::user()->master_users->auth_role_id == 3)
            <div class="col text-right">
                <a href="{{ route('tagihan.indexUser') }}" class="btn btn-success btn-sm">Data Tagihan</a>
            </div>
        @endif

    </div><hr>


    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach ($his as $i => $item)
                            <a class="nav-link mb-2 {{ $i == 0?'active show':null }}" data-toggle="pill" href="#content_{{$i+1}}" role="tab">
                                <p style="margin-bottom: 0; line-height: 1.1;">
                                    <strong>{{ $status[$item['status']] }}</strong> <br>
                                    <span style="font-size: 10px;">
                                        {{ Carbon\Carbon::parse($item['created_at'])->setTimezone('Asia/Jakarta')->isoFormat('DD MMMM YYYY, HH:m') }} WIB
                                    </span>
                                </p>

                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">

            <div class="card">
                <div class="card-body">

                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">

                        @foreach ($his as $i => $item)

                            <div class="tab-pane fade {{ $i==0?'active show':null }}" id="content_{{$i+1}}">
                                <div class="row">
                                    <div class="col">

                                        @if (!is_null($item['revisi']))
                                            <div class="card border border-danger">
                                                <div class="card-header bg-transparent border-danger">
                                                    <h5 class="my-0 text-danger"><i class="mdi mdi-block-helper mr-3"></i>Revisi</h5>
                                                </div>
                                                <div class="card-body mt-0 pt-0">
                                                    {!! $item['revisi'] !!}
                                                </div>
                                            </div>
                                        @endif

                                        <h6>DATA SP</h6>

                                        <table class="table table-striped table-bordered table-sm mb-0">

                                            <tbody>
                                                <tr>
                                                    <th style="width: 200px">File SP</th>
                                                    <td style="width: 10px">:</td>
                                                    <td><a target="_blank" class="btn btn-sm btn-danger" href="{{asset(str_replace('public/','storage/',$item['json']['dt_sp']['file_sp']))}}">Lihat</a></td>
                                                </tr>
                                                <tr>
                                                    <th>Nomor SP</th>
                                                    <td>:</td>
                                                    <td>{{ $item['json']['dt_sp']['no_sp']}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tujuan Mitra</th>
                                                    <td>:</td>
                                                    <td>{{ $item['json']['dt_sp']['khs_induks']['json']['perusahaan'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>KHS Induk</th>
                                                    <td>:</td>
                                                    <td>{{ $item['json']['dt_sp']['khs_induks']['no'] }}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <th>KHS Amandemen</th>
                                                    <td>:</td>
                                                    <td>{{ $item['json']['dt_sp']['json']['no'] }}</td>
                                                </tr> --}}
                                                <tr>
                                                    <th>Tanggal SP</th>
                                                    <td>:</td>
                                                    <td>{{ Carbon\Carbon::parse($item['json']['dt_sp']['tgl_sp'])->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal TOC</th>
                                                    <td>:</td>
                                                    <td>{{ Carbon\Carbon::parse($item['json']['dt_sp']['tgl_toc'])->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Pekerjaan</th>
                                                    <td>:</td>
                                                    <td>{{ $item['json']['dt_sp']['master_units']['nama'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>PPN %</th>
                                                    <td>:</td>
                                                    <td>{{ $item['json']['dt_sp']['ppn'] }}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <th>ID Project</th>
                                                    <td>:</td>
                                                    <td>{{ $item['json']['dt_sp']['json']['id_project'] }}</td>
                                                </tr> --}}
                                                <tr>
                                                    <th>Nama Pekerjaan</th>
                                                    <td>:</td>
                                                    <td>{{ $item['json']['dt_sp']['nama_pekerjaan'] }}</td>
                                                </tr>

                                            </tbody>
                                        </table>

                                        <div style="height: 30px"></div>


                                        <h6>DATA VALUE MITRA</h6>

                                        <table class="table table-striped table-bordered table-sm mb-0">

                                            <tbody>

                                                <tr>
                                                    <th style="width: 200px">Tgl. Uji Terima</th>
                                                    <td style="width: 10px">:</td>
                                                    <td>{{ Carbon\Carbon::parse($item['json']['dt_tagihan']['tgl_ut'])->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>No. Uji Terima</th>
                                                    <td>:</td>
                                                    <td>{{ $item['json']['dt_tagihan']['no_ut'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tgl. Berita Acara Uji Terima</th>
                                                    <td>:</td>
                                                    <td>{{ Carbon\Carbon::parse($item['json']['dt_tagihan']['tgl_baut'])->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tgl. Lamp Acara Uji Terima</th>
                                                    <td>:</td>
                                                    <td>{{ Carbon\Carbon::parse($item['json']['dt_tagihan']['tgl_laut'])->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tgl. Permohonan Rekon</th>
                                                    <td>:</td>
                                                    <td>{{ Carbon\Carbon::parse($item['json']['dt_tagihan']['tgl_mohon'])->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>No. Permohonan Rekon</th>
                                                    <td>:</td>
                                                    <td>{{ $item['json']['dt_tagihan']['no_mohon'] }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tgl. BA Rekon</th>
                                                    <td>:</td>
                                                    <td>{{ Carbon\Carbon::parse($item['json']['dt_tagihan']['tgl_ba_rekon'])->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tgl. Turnkey</th>
                                                    <td>:</td>
                                                    <td>{{ Carbon\Carbon::parse($item['json']['dt_tagihan']['dt_turnkey']['tgl_turnkey'])->format('d/m/Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tgl. BA Gambar</th>
                                                    <td>:</td>
                                                    <td>{{ Carbon\Carbon::parse($item['json']['dt_tagihan']['tgl_ba_gambar'])->format('d/m/Y') }}</td>
                                                </tr>



                                            </tbody>
                                        </table>

                                        <div style="height: 30px"></div>

                                        <h6>DATA LOKASI & DESIGNATOR</h6>

                                        @foreach ($item['json']['dt_tagihan']['dt_lokasi']['lokasi'] as $key => $iJson)

                                            <div class="row">
                                                <div class="col">
                                                    <table class="table table-striped table-bordered table-sm mb-1">
                                                        <tbody>
                                                            <tr class="text-center bg-soft-warning" style="font-weight: bold">
                                                                <th class="text-left">Nama Lokasi {{$key+1}}:  {{ $iJson['nama_lokasi'] }}</th>
                                                                <th>STO: {{ $iJson['sto'] }}</th>
                                                                <th class="text-right">Total SP: {{ number_format($iJson['total_lokasi'] ,0,',','.') }}</th>
                                                                <th class="text-right">Total Rekon: {{ number_format($iJson['total_lokasi_rekon'] ,0,',','.') }}</th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="table-responsive">

                                                <table class="table table-sm table-bordered table-striped mb-1">
                                                    <thead>
                                                        <tr class="bg-light">
                                                            <th rowspan="2" width="40" class="text-center">No</th>
                                                            <th rowspan="2" class="text-center">Nama <br> Material</th>
                                                            <th rowspan="2" class="text-center">Nama <br>Jasa</th>
                                                            <th rowspan="2" class="text-center">Nama <br>Designator</th>
                                                            <th rowspan="2" class="text-center">Uraian</th>
                                                            <th rowspan="2" class="text-center">Satuan</th>
                                                            <th rowspan="2" class="bg-light text-center">Material</th>
                                                            <th rowspan="2" class="bg-light text-center">Jasa</th>
                                                            <th colspan="4" class="text-center bg-soft-danger text-dark">Data SP</th>
                                                            <th colspan="4" class="text-center bg-soft-primary text-dark">Data Rekon</th>

                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light text-center">Vol</th>
                                                            <th class="bg-light text-center">Material</th>
                                                            <th class="bg-light text-center">Jasa</th>
                                                            <th class="bg-light text-center">Total</th>

                                                            <th class="bg-light text-center">Vol</th>
                                                            <th class="bg-light text-center">Material</th>
                                                            <th class="bg-light text-center">Jasa</th>
                                                            <th class="bg-light text-center">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($iJson['desig_items'] as $i=>$val)
                                                            <tr>
                                                                <td>{{$i+1}}</td>
                                                                <td>{{$val['nama_material']}}</td>
                                                                <td>{{$val['nama_jasa']}}</td>
                                                                <td>{{$val['nama_designator']}}</td>
                                                                <td>
                                                                    <span title="{{$val['uraian']}}">
                                                                        {{ Str::limit($val['uraian'], 35, '...') }}
                                                                    </span>
                                                                </td>
                                                                <td>{{ $val['satuan'] }}</td>
                                                                <td>{{ number_format($val['material'] ,0,',','.')}}</td>
                                                                <td>{{ number_format($val['jasa'] ,0,',','.')}}</td>
                                                                <td>{{ number_format($val['vol'] ,0,',','.')}}</td>
                                                                <td>{{ number_format($val['total_material'] ,0,',','.')}}</td>
                                                                <td>{{ number_format($val['total_jasa'] ,0,',','.')}}</td>
                                                                <td>{{ number_format($val['total_material']+$val['total_jasa'] ,0,',','.')}}</td>

                                                                <td>{{ number_format($val['volume_rekon'] ,0,',','.')}}</td>
                                                                <td>{{ number_format($val['total_material_rekon'] ,0,',','.')}}</td>
                                                                <td>{{ number_format($val['total_jasa_rekon'] ,0,',','.')}}</td>
                                                                <td>{{ number_format($val['total_material_rekon']+$val['total_jasa_rekon'] ,0,',','.')}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </div>

                                        @endforeach


                                        @if (count($item['json']['dt_tagihan']['dt_gudang']['all_desig'])==0)
                                            <div class="row mt-5">
                                                <div class="col">
                                                    <div class="alert alert-danger text-center" role="alert">
                                                        Data gudang tidak tersedia tidak ada material yang digunakan.
                                                    </div>
                                                </div>
                                            </div>
                                        @else

                                            {{-- ambil --}}
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
                                                                @foreach ($item['json']['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                                                                <th>
                                                                    <div class="verticalTableHeader">{{$vDes['nama_material']}}</div>
                                                                </th>
                                                                @endforeach

                                                            </tr>
                                                            <tr>
                                                                @foreach ($item['json']['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                                                                <th width="60">{{$vDes['satuan']}}</th>
                                                                @endforeach
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr><td></td></tr>
                                                            @foreach ($item['json']['dt_tagihan']['dt_gudang']['ambil']['data'] as $iRowAmbil=>$vRowAmbil)
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
                                                        <tr><td colspan="{{ count($item['json']['dt_tagihan']['dt_gudang']['all_desig'])+3 }}"><hr class="m-0 p-0"></td></tr>
                                                        <tfoot class="bg-light">
                                                            <tr class="text-dark">
                                                                <th colspan="3">TOTAL MATERIAL</th>
                                                                @foreach ($item['json']['dt_tagihan']['dt_gudang']['ambil']['total'] as $iNilaiAmbil=>$vNilaiAmbil)
                                                                <th class="text-center">{{$vNilaiAmbil}}</th>
                                                                @endforeach
                                                            </tr>
                                                        </tfoot>
                                                    </table>


                                                </div>
                                            </div>

                                            {{-- pakai --}}
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
                                                                @foreach ($item['json']['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                                                                <th>
                                                                    <div class="verticalTableHeader">{{$vDes['nama_material']}}</div>
                                                                </th>
                                                                @endforeach
                                                            </tr>
                                                            <tr>
                                                                @foreach ($item['json']['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                                                                <th width="60">{{$vDes['satuan']}}</th>
                                                                @endforeach
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($item['json']['dt_tagihan']['dt_lokasi']['lokasi'] as $iLok=>$vLok)
                                                                <tr class="text-center">
                                                                    <td>{{$iLok+1}}</td>
                                                                    <td class="text-left">{{$vLok['nama_lokasi']}}</td>
                                                                    <td>{{$vLok['id_project']}}</td>
                                                                    @foreach ($item['json']['dt_tagihan']['dt_gudang']['all_desig'] as $iDesMat=>$vDesMat)
                                                                    <td>{{$item['json']['dt_tagihan']['dt_gudang']['pakai']['data'][$iLok][$iDesMat]}}</td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tr><td colspan="{{ count($item['json']['dt_tagihan']['dt_gudang']['all_desig'])+3 }}"><hr class="m-0 p-0"></td></tr>
                                                        <tfoot class="bg-light">
                                                            <tr class="text-dark">
                                                                <th colspan="3">TOTAL MATERIAL</th>
                                                                @foreach ($item['json']['dt_tagihan']['dt_gudang']['all_desig'] as $iDesMat=>$vDesMat)
                                                                <th class="text-center">{{$item['json']['dt_tagihan']['dt_gudang']['pakai']['total'][$iDesMat]}}</th>
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
                                                                <th rowspan="2">No</th>
                                                                <th rowspan="2">ID Pengembalian</th>
                                                                <th rowspan="2" width="130">Tgl. RFR</th>
                                                                @foreach ($item['json']['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                                                                <th><div class="verticalTableHeader">{{$vDes['nama_material']}}</div></th>
                                                                @endforeach

                                                            </tr>
                                                            <tr>
                                                                @foreach ($item['json']['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                                                                <th width="60">{{$vDes['satuan']}}</th>
                                                                @endforeach
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr><td></td></tr>
                                                            @foreach ($item['json']['dt_tagihan']['dt_gudang']['kembali']['data'] as $iRowKembali=>$vRowKembali)
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
                                                        <tr><td colspan="{{ count($item['json']['dt_tagihan']['dt_gudang']['all_desig'])+3 }}"><hr class="m-0 p-0"></td></tr>
                                                        <tfoot class="bg-light">
                                                            <tr class="text-dark">
                                                                <th colspan="3">TOTAL PENGEMBALIAN MATERIAL</th>
                                                                @foreach ($item['json']['dt_tagihan']['dt_gudang']['kembali']['total'] as $iNilaiKembali=>$vNilaiKembali)
                                                                <th class="text-center">{{$vNilaiKembali}}</th>
                                                                @endforeach
                                                            </tr>
                                                            <tr><td colspan="{{ count($item['json']['dt_tagihan']['dt_gudang']['all_desig'])+3 }}"><hr class="mb-0 bg-warning"></td></tr>
                                                            <tr class="text-dark bg-soft-warning">
                                                                <th colspan="3" class="border border-warning">GRAND TOTAL SISA MATERIAL</th>
                                                                @foreach ($item['json']['dt_tagihan']['dt_gudang']['grand_total'] as $iGt=>$vGt)
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
                                                        @foreach ($item['json']['dt_tagihan']['dt_gudang']['kembali']['ket'] as $i=>$v)
                                                        <tr>
                                                            <td class="pl-4">{{$v}}</td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>

                                            {{-- rekon --}}
                                            <hr>
                                            <div class="row">
                                                <div class="col">
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
                                                                    @foreach ($item['json']['dt_tagihan']['dt_gudang']['rekon'] as $iDr => $vDr)
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
                                                                        @foreach ($item['json']['dt_tagihan']['dt_gudang']['rekon'] as $iDr => $vDr)
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

                                        @endif


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
