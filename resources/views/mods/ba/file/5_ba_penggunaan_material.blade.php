<div class="margin" style="text-align: justify; page-break-after: always;">
    <div>
        <center>
    
            <strong>
            BERITA ACARA PENGGUNAAN MATERIAL <br>
            PEKERJAAN {{$dt['dt_sp']['json']['nama_pekerjaan']}} <br>
            NO.KHS {{$dt['dt_sp']['khs_induks']['no_kontrak']}}, TANGGAL: {{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_kontrak'])->isoFormat('DD MMMM Y') }}
            @if (count($dt['aman_khs'])>0)
                @foreach ($dt['aman_khs'] as $i=>$item)
                NO AMANDEMEN {{$i+1}} KHS {{ $item['no_aman'] }}, TANGGAL: {{ Carbon\Carbon::parse($item['tgl_aman'])->isoFormat('DD MMMM Y') }}
                @endforeach
            @endif
            <br>
            NO.SURAT PESANAN : {{ $dt['dt_sp']['no_sp'] }}, TANGGAL: {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }} <br>
            @if (count($dt['aman_sp'])>0)
                @foreach ($dt['aman_sp'] as $i=>$item)
                NO AMANDEMEN {{$i+1}} SP {{ $item['no_sp'] }}, TANGGAL: {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('DD MMMM Y') }}
                @endforeach
            @endif
            </strong>
    
        </center>
    </div>
    
    <div style="height: 30px;"></div>
    
    <div>A. MATERIAL YANG DIAMBIL</div>
    <table class="table-border-bold" style="width: 100%">
        <tr style="text-align: center">
            <td rowspan="2">NO</td>
            <td rowspan="2">NO. RFC</td>
            <td rowspan="2">TANGGAL RFC</td>
            @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
            <td>
                <div class="verticalTableHeader">{{$vDes['nama']}}</div>
            </td>
            @endforeach
            
        </tr>
        <tr style="text-align: center">
            @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
            <td widtd="60">{{$vDes['satuan']}}</td>
            @endforeach
        </tr>

        <tbody style="text-align: center">
            @foreach ($dt['dt_tagihan']['dt_gudang']['ambil']['data'] as $iRowAmbil=>$vRowAmbil)
                <tr class="text-center">
                    <td>{{$iRowAmbil+1}}</td>
                    <td>{{$vRowAmbil['no_rfc']}}</td>
                    <td>{{Carbon\Carbon::parse($vRowAmbil['tgl_rfc'])->format('d-m-Y')}}</td>
                    @foreach ($vRowAmbil['nilai'] as $iNilaiAmbil=>$vNilaiAmbil)
                    <td>{{$vNilaiAmbil}}</td>
                    @endforeach
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: left">TOTAL MATERIAL</td>
                @foreach ($dt['dt_tagihan']['dt_gudang']['ambil']['total'] as $iNilaiAmbil=>$vNilaiAmbil)
                <td style="text-align: center">{{$vNilaiAmbil}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
    <br>
    <div>B. MATERIAL YANG DIPAKAI</div>
    <table class="table-border-bold" style="width: 100%;">
        <tr style="text-align: center">
            <td rowspan="2" widtd="50">NO</td>
            <td rowspan="2">NAMA LOKASI</td>
            <td rowspan="2" widtd="130">ID PROJECT</td>
            @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
            <td>
                <div class="verticalTableHeader">{{$vDes['nama']}}</div>
            </td>
            @endforeach
        </tr>
        <tr style="text-align: center">
            @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
            <td widtd="60">{{$vDes['satuan']}}</td>
            @endforeach
        </tr>

        <tbody style="text-align: center">
            @foreach ($dt['dt_tagihan']['dt_lokasi'] as $iLok=>$vLok)
                <tr class="text-center">
                    <td>{{$iLok+1}}</td>
                    <td style="text-align: left">{{$vLok['nama_lokasi']}}</td>
                    <td>{{$dt['dt_sp']['json']['id_project']}}</td>
                    @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDesMat=>$vDesMat)
                    <td>{{$dt['dt_tagihan']['dt_gudang']['pakai']['data'][$iLok][$iDesMat]}}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-light">
            <tr class="text-dark">
                <td colspan="3">TOTAL MATERIAL</td>
                @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDesMat=>$vDesMat)
                <td class="text-center" style="text-align: center">{{$dt['dt_tagihan']['dt_gudang']['pakai']['total'][$iDesMat]}}</td>
                @endforeach
            </tr>
        </tfoot>
    </table>

    <br>
    <div>C. PENGEMBALIAN MATERIAL</div>
    <table class="table-border-bold" style="width: 100%;">
        <thead class="bg-light text-center" style="text-align: center">
            <tr>
                <td rowspan="2">NO</td>
                <td rowspan="2">ID PENGEMBALIAN</td>
                <td rowspan="2" widtd="130">TANGGAL RFR</td>
                @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                <td><div class="verticalTableHeader">{{$vDes['nama']}}</div></td>
                @endforeach
                
            </tr>
            <tr style="text-align: center">
                @foreach ($dt['dt_tagihan']['dt_gudang']['all_desig'] as $iDes=>$vDes)
                <td widtd="60">{{$vDes['satuan']}}</td>
                @endforeach
            </tr>
        </thead>

        <tbody style="text-align: center">
            @foreach ($dt['dt_tagihan']['dt_gudang']['kembali']['data'] as $iRowKembali=>$vRowKembali)
                <tr class="text-center">
                    <td>{{$iRowKembali+1}}</td>
                    <td style="text-align: left">{{$vRowKembali['id_kembali']}}</td>
                    <td>{{Carbon\Carbon::parse($vRowKembali['tgl_rfr'])->format('d-m-Y')}}</td>
                    @foreach ($vRowKembali['nilai'] as $iNilaiKembali=>$vNilaiKembali)
                    <td>{{$vNilaiKembali}}</td>
                    @endforeach
                    
                </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-light">
            <tr class="text-dark">
                <td colspan="3">TOTAL PENGEMBALIAN MATERIAL</td>
                @foreach ($dt['dt_tagihan']['dt_gudang']['kembali']['total'] as $iNilaiKembali=>$vNilaiKembali)
                <td class="text-center" style="text-align: center">{{$vNilaiKembali}}</td>
                @endforeach
            </tr>
            <tr><td colspan="{{ count($dt['dt_tagihan']['dt_gudang']['all_desig'])+3 }}" style="height: 10px"></td></tr>
            <tr class="text-dark bg-soft-warning">
                <td colspan="3" class="border border-warning">GRAND TOTAL SISA MATERIAL</td>
                @foreach ($dt['dt_tagihan']['dt_gudang']['grand_total'] as $iGt=>$vGt)
                @php
                    if($vGt<0){
                        $vGt = $vGt * (-1);
                    }
                @endphp
                <td class="border border-warning text-center" style="text-align: center">{{$vGt}}</td>
                @endforeach
            </tr>
        </tfoot>
    </table>

    <table>
        <tr>
            <td style="width: 30px">Ket : </td>
            <td>
                @foreach ($dt['dt_tagihan']['dt_gudang']['kembali']['ket'] as $i=>$v)
                {{$v}} <br>
                @endforeach
            </td>
        </tr>
    </table>
    <br>
    
    <div style="page-break-inside: avoid; width: 100%;">
        <table style="width: 100%; vertical-align: top; text-align:center; font-weight: bold;">
            <tr><td colspan="3" style="text-align: center; height: 30px;">
                Medan, {{Carbon\Carbon::parse($dt['tagihan']['created_at'])->isoFormat('DD MMMM Y')}}
            </td></tr>
            <tr>
                <td style="width: 33%; text-transform: uppercase">
                    {{ $dt['dt_sp']['mitras']['master_users']['detail']['perusahaan'] }}
                    <div style="height: 100px"></div>
                    <u>{{ $dt['dt_sp']['mitras']['master_users']['detail']['direktur'] }}</u>
                    <br>
                    DIREKTUR
                </td>
                <td style="text-transform: uppercase">
                    <table style="width: 100%;">
                        <tr><td colspan="2">PT. TELKOM AKSES</td></tr>
                        <tr style="vertical-align: top">
                            <td style="width: 50%">
                                WASPANG
                                <div style="height: 100px"></div>
                                <u>{{ $dt['dt_tagihan']['dt_ttd']['wapang'] }}</u><br>
                                @if ($dt['dt_sp']['json']['master_unit_id'] == 2)
                                    Project Supervisor
                                @else
                                    TL. Corrective Maintenance & QE
                                @endif
                            </td>
                            <td>
                                PETUGAS GUDANG
                                <div style="height: 100px"></div>
                                <u>{{ $dt['dt_tagihan']['dt_ttd']['wapang'] }}</u><br>
                                TIM LEADER INVENTORY & ASSET MANAGEMENT
                            </td>
                        </tr>
                    </table>
                </td>
                
            </tr>
    
            <tr>
                <td colspan="3" style="padding: 5px;">Mengetahui/Menyetujui</td>
            </tr>
    
            <tr style="text-transform: uppercase">
                <td colspan="2">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 50%">
                                <div style="height: 120px"></div>
                                <u>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit']}}</u>
                                <br>
                                <span>
                                    @if ($dt['dt_sp']['json']['master_unit_id'] == 2)
                                        Mgr. Konstruksi Medan
                                    @else
                                        Mgr. Assurance & Maintenance Medan
                                    @endif  
                                </span>
                            </td>
                            <td>
                                <div style="height: 120px"></div>
                                <u>{{$dt['dt_tagihan']['dt_ttd']['mgr_shared']}}</u>
                                <br>
                                <span>MGR SHARED SERVICE MEDAN</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>