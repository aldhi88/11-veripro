{{-- per lokasi --}}
<div class="margin" style="text-align: justify; page-break-after: always;">
    <table style="vertical-align: top;">
            
        <tr style="font-weight: bold">
            <td colspan="3">REKAP LAMPIRAN BA REKONSILIASI</td>
        </tr>
        <tr style="font-weight: bold">
            <td>PEKERJAAN</td>
            <td>:</td>
            <td>{{ $dt['dt_sp']['nama_pekerjaan'] }}</td>
        </tr>
        <tr style="font-weight: bold">
            <td width="300">NO. PERJANJIAN KERJASAMA </td>
            <td>:</td>
            <td>{{ $dt['dt_sp']['khs_induks']['no']  }}, TANGGAL: {{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_berlaku'])->isoFormat('DD MMMM Y') }}</td>
        </tr>

        @if (count($dt['aman_khs'])>0)
            @foreach ($dt['aman_khs'] as $i=>$item)
                <tr style="font-weight: bold;">
                    <td>
                        <ol style="margin: 0; padding-left: 25px;">
                            <li>NO AMANDEMEN {{$i+1}} KHS</li>
                        </ol>
                    </td>
                    <td>:</td>
                    <td>{{ $item['no'] }}, TANGGAL: {{ Carbon\Carbon::parse($item['tgl_berlaku'])->isoFormat('DD MMMM Y') }}</td>
                </tr>
            @endforeach
        @endif

        <tr style="font-weight: bold">
            <td width="300">NO. SURAT PESANAN </td>
            <td>:</td>
            <td>{{ $dt['dt_sp']['no_sp'] }}</td>
        </tr>
        @if (count($dt['aman_sp'])>0)
            @foreach ($dt['aman_sp'] as $i=>$item)
                <tr style="font-weight: bold;">
                    <td>
                        <ol style="margin: 0; padding-left: 25px;">
                            <li>NO AMANDEMEN {{$i+1}} SP</li>
                        </ol>
                    </td>
                    <td>:</td>
                    <td>{{ $item['no_sp'] }}, TANGGAL: {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('DD MMMM Y') }}</td>
                </tr>
            @endforeach
        @endif

        <tr style="font-weight: bold">
            <td>PELAKSANA</td>
            <td>:</td>
            <td style="text-transform: uppercase">{{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}</td>
        </tr>
        
    </table>
    <br>

    <table style="width: 100%; vertical-align: top; border-collapse: collapse" class="table-border table-padding">
        <tr style="font-weight: bold; text-align: center">
            <td rowspan="2" width="30">NO</td>
            <td rowspan="2">LOKASI PEKERJAAN</td>
            <td rowspan="2">ID PROJECT</td>
            <td colspan="3">SURAT PESANAN</td>
            <td colspan="3">HASIL REKON</td>
            <td colspan="3">PEKERJAAN TAMBAH</td>
            <td colspan="3">PEKERJAAN KURANG</td>
        </tr>

        <tr style="font-weight: bold; text-align: center">
            <td>MATERIAL</td>
            <td>JASA</td>
            <td>TOTAL</td>
            <td>MATERIAL</td>
            <td>JASA</td>
            <td>TOTAL</td>
            <td>MATERIAL</td>
            <td>JASA</td>
            <td>TOTAL</td>
            <td>MATERIAL</td>
            <td>JASA</td>
            <td>TOTAL</td>
        </tr>




        @foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $iLok=>$vLok)
            <tr>
                <td style="text-align: center">{{$iLok+1}}</td>
                <td>{{ $vLok['nama_lokasi'] }}</td>
                <td style="text-align: center">{{ $vLok['id_project'] }}</td>

                <td style="text-align: right">{{number_format($vLok['total_material_lokasi'],0,',','.')}}</td>
                <td style="text-align: right">{{number_format($vLok['total_jasa_lokasi'],0,',','.')}}</td>
                <td style="text-align: right">{{number_format($vLok['total_lokasi'],0,',','.')}}</td>

                <td style="text-align: right">{{number_format($vLok['total_material_lokasi_rekon'],0,',','.')}}</td>
                <td style="text-align: right">{{number_format($vLok['total_jasa_lokasi_rekon'],0,',','.')}}</td>
                <td style="text-align: right">{{number_format($vLok['total_lokasi_rekon'],0,',','.')}}</td>

                <td style="text-align: right">{{number_format($vLok['total_material_lokasi_tambah'],0,',','.')}}</td>
                <td style="text-align: right">{{number_format($vLok['total_jasa_lokasi_tambah'],0,',','.')}}</td>
                <td style="text-align: right">{{number_format($vLok['total_lokasi_tambah'],0,',','.')}}</td>

                <td style="text-align: right">{{number_format($vLok['total_material_lokasi_kurang'],0,',','.')}}</td>
                <td style="text-align: right">{{number_format($vLok['total_jasa_lokasi_kurang'],0,',','.')}}</td>
                <td style="text-align: right">{{number_format($vLok['total_lokasi_kurang'],0,',','.')}}</td>
            </tr>
        @endforeach

        <tr style="text-align: right">
            <td colspan="3" style="text-align: left">MATERIAL</td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material'],0,',','.')}}</td>
            <td></td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon'],0,',','.')}}</td>
            <td></td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material_tambah'],0,',','.')}}</td>
            <td></td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material_kurang'],0,',','.')}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr style="text-align: right">
            <td colspan="3" style="text-align: left">JASA</td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa'],0,',','.')}}</td>
            <td></td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon'],0,',','.')}}</td>
            <td></td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_tambah'],0,',','.')}}</td>
            <td></td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_kurang'],0,',','.')}}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td colspan="3" style="text-align: left">TOTAL</td>
            <td></td>
            <td></td>
            <td>Rp <div style="float: right;display: block">{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total'],0,',','.')}}</div></td>
            <td></td>
            <td></td>
            <td>Rp <div style="float: right;display: block">{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'],0,',','.')}}</div></td>
            <td></td>
            <td></td>
            <td>Rp <div style="float: right;display: block">{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_tambah'],0,',','.')}}</div></td>
            <td></td>
            <td></td>
            <td>Rp <div style="float: right;display: block">{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_kurang'],0,',','.')}}</div></td>
        </tr>
        <tr style="text-align: left">
            <td colspan="3" style="text-align: left">PPN {{$dt['dt_sp']['ppn']}}%</td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material_tambah'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_tambah'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_tambah'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material_kurang'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_kurang'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_kurang'],0,',','.')}}</div></td>
        </tr>

        <tr style="text-align: left">
            <td colspan="3" style="text-align: left">GRAND TOTAL</td>
            <td>Rp <div style="float: right;display: block">
                {{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material']+$dt['dt_tagihan']['dt_lokasi']['grand_total_material'],0,',','.')}}
            </div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa']+$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total']+$dt['dt_tagihan']['dt_lokasi']['grand_total'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon']+$dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon']+$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']+$dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material_tambah']+$dt['dt_tagihan']['dt_lokasi']['grand_total_material_tambah'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_tambah']+$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_tambah'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_tambah']+$dt['dt_tagihan']['dt_lokasi']['grand_total_tambah'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material_kurang']+$dt['dt_tagihan']['dt_lokasi']['grand_total_material_kurang'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_kurang']+$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_kurang'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_kurang']+$dt['dt_tagihan']['dt_lokasi']['grand_total_kurang'],0,',','.')}}</div></td>
        </tr>
        
    </table>
    <br>
    <div style="page-break-inside: avoid; width: 100%">
        <table style="width: 100%;font-weight: bold">
            <tr><td colspan="4" style="text-align: center">
                Medan, {{Carbon\Carbon::parse($dt['tagihan']['created_at'])->isoFormat('DD MMMM Y')}}
                <br><br>
                Dilaporkan oleh,
            </td></tr>
            <tr style="text-align: center; text-transform: uppercase">
                <td style="width: 30%;">
                    {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}
                    <div style="height: 70px"></div>
                    <u>{{ $dt['dt_sp']['khs_induks']['json']['direktur'] }}</u>
                    <br>
                    DIREKTUR
                </td>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
                <td>
                    PT. TELKOM AKSES
                    <div style="height: 70px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_pejabat']}}</u>
                    <br>
                    <span>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_jabatan']}}</span>
                </td>
            </tr>
            <tr><td colspan="4" style="text-align: center">
                Mengetahui / Menyetujui
                <br><br>
                <div style="height: 70px"></div>
                <u style="text-transform: uppercase">{{$dt['dt_tagihan']['dt_ttd']['gm_ta_pejabat']}}</u>
                <br>
                {{$dt['dt_tagihan']['dt_ttd']['gm_ta_jabatan']}}
            </td></tr>
        </table>
    </div>

</div>

{{-- per desig --}}
<div class="margin" style="text-align: justify; page-break-after: always;">
    <table style="vertical-align: top;">
            
        <tr style="font-weight: bold">
            <td colspan="3">REKAP LAMPIRAN BA REKONSILIASI</td>
        </tr>
        <tr style="font-weight: bold">
            <td>PEKERJAAN</td>
            <td>:</td>
            <td>{{ $dt['dt_sp']['nama_pekerjaan'] }}</td>
        </tr>
        <tr style="font-weight: bold">
            <td width="300">NO. PERJANJIAN KERJASAMA </td>
            <td>:</td>
            <td>{{ $dt['dt_sp']['khs_induks']['no']  }}, TANGGAL: {{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_berlaku'])->isoFormat('DD MMMM Y') }}</td>
        </tr>

        @if (count($dt['aman_khs'])>0)
            @foreach ($dt['aman_khs'] as $i=>$item)
                <tr style="font-weight: bold;">
                    <td>
                        <ol style="margin: 0; padding-left: 25px;">
                            <li>NO AMANDEMEN {{$i+1}} KHS</li>
                        </ol>
                    </td>
                    <td>:</td>
                    <td>{{ $item['no'] }}, TANGGAL: {{ Carbon\Carbon::parse($item['tgl_berlaku'])->isoFormat('DD MMMM Y') }}</td>
                </tr>
            @endforeach
        @endif

        <tr style="font-weight: bold">
            <td width="300">NO. SURAT PESANAN </td>
            <td>:</td>
            <td>{{ $dt['dt_sp']['no_sp'] }}</td>
        </tr>
        @if (count($dt['aman_sp'])>0)
            @foreach ($dt['aman_sp'] as $i=>$item)
                <tr style="font-weight: bold;">
                    <td>
                        <ol style="margin: 0; padding-left: 25px;">
                            <li>NO AMANDEMEN {{$i+1}} SP</li>
                        </ol>
                    </td>
                    <td>:</td>
                    <td>{{ $item['no_sp'] }}, TANGGAL: {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('DD MMMM Y') }}</td>
                </tr>
            @endforeach
        @endif

        <tr style="font-weight: bold">
            <td>PELAKSANA</td>
            <td>:</td>
            <td style="text-transform: uppercase">{{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}</td>
        </tr>
        
    </table>
    <br>

    <table style="width: 100%; vertical-align: top; border-collapse: collapse" class="table-border table-padding">
        <tr style="font-weight: bold; text-align: center">
            <td rowspan="2" width="30">NO</td>
            <td rowspan="2">DESIGNATOR</td>
            <td rowspan="2">URAIAN PEKERJAAN</td>
            <td colspan="3">SURAT PESANAN</td>
            <td colspan="3">HASIL REKON</td>
            <td colspan="3">PEKERJAAN TAMBAH</td>
            <td colspan="3">PEKERJAAN KURANG</td>
        </tr>

        <tr style="font-weight: bold; text-align: center">
            <td>MATERIAL</td>
            <td>JASA</td>
            <td>TOTAL</td>
            <td>MATERIAL</td>
            <td>JASA</td>
            <td>TOTAL</td>
            <td>MATERIAL</td>
            <td>JASA</td>
            <td>TOTAL</td>
            <td>MATERIAL</td>
            <td>JASA</td>
            <td>TOTAL</td>
        </tr>




        @foreach ($dtDesig as $iDtDesig=>$vDtDesig)
            <tr>
                <td style="text-align: center">{{$iDtDesig+1}}</td>
                <td style="text-align: left">
                    {{ !is_null($vDtDesig['nama_material'])?$vDtDesig['nama_material']:null }} 
                    {{ !is_null($vDtDesig['nama_jasa'])?", ".$vDtDesig['nama_jasa']:null }} 
                    {{ !is_null($vDtDesig['nama_designator'])?", ".$vDtDesig['nama_designator']:null }} 
                </td>
                <td>{{ $vDtDesig['uraian'] }}</td>

                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach

        {{-- <tr style="text-align: right">
            <td colspan="3" style="text-align: left">MATERIAL</td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material'],0,',','.')}}</td>
            <td></td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon'],0,',','.')}}</td>
            <td></td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material_tambah'],0,',','.')}}</td>
            <td></td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material_kurang'],0,',','.')}}</td>
            <td></td>
            <td></td>
        </tr>
        <tr style="text-align: right">
            <td colspan="3" style="text-align: left">JASA</td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa'],0,',','.')}}</td>
            <td></td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon'],0,',','.')}}</td>
            <td></td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_tambah'],0,',','.')}}</td>
            <td></td>
            <td></td>
            <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_kurang'],0,',','.')}}</td>
            <td></td>
        </tr>
        <tr style="text-align: left">
            <td colspan="3" style="text-align: left">TOTAL</td>
            <td></td>
            <td></td>
            <td>Rp <div style="float: right;display: block">{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total'],0,',','.')}}</div></td>
            <td></td>
            <td></td>
            <td>Rp <div style="float: right;display: block">{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'],0,',','.')}}</div></td>
            <td></td>
            <td></td>
            <td>Rp <div style="float: right;display: block">{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_tambah'],0,',','.')}}</div></td>
            <td></td>
            <td></td>
            <td>Rp <div style="float: right;display: block">{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_kurang'],0,',','.')}}</div></td>
        </tr>
        <tr style="text-align: left">
            <td colspan="3" style="text-align: left">PPN {{$dt['dt_sp']['ppn']}}%</td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material_tambah'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_tambah'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_tambah'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material_kurang'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_kurang'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_kurang'],0,',','.')}}</div></td>
        </tr>

        <tr style="text-align: left">
            <td colspan="3" style="text-align: left">GRAND TOTAL</td>
            <td>Rp <div style="float: right;display: block">
                {{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material']+$dt['dt_tagihan']['dt_lokasi']['grand_total_material'],0,',','.')}}
            </div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa']+$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total']+$dt['dt_tagihan']['dt_lokasi']['grand_total'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon']+$dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon']+$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']+$dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material_tambah']+$dt['dt_tagihan']['dt_lokasi']['grand_total_material_tambah'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_tambah']+$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_tambah'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_tambah']+$dt['dt_tagihan']['dt_lokasi']['grand_total_tambah'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_material_kurang']+$dt['dt_tagihan']['dt_lokasi']['grand_total_material_kurang'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_kurang']+$dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_kurang'],0,',','.')}}</div></td>
            <td>Rp <div style="float: right;display: block">{{number_format(($dt['dt_sp']['ppn']/100)*$dt['dt_tagihan']['dt_lokasi']['grand_total_kurang']+$dt['dt_tagihan']['dt_lokasi']['grand_total_kurang'],0,',','.')}}</div></td>
        </tr> --}}
        
    </table>
    <br>
    <div style="page-break-inside: avoid; width: 100%">
        <table style="width: 100%;font-weight: bold">
            <tr><td colspan="4" style="text-align: center">
                Medan, {{Carbon\Carbon::parse($dt['tagihan']['created_at'])->isoFormat('DD MMMM Y')}}
                <br><br>
                Dilaporkan oleh,
            </td></tr>
            <tr style="text-align: center; text-transform: uppercase">
                <td style="width: 30%;">
                    {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}
                    <div style="height: 80px"></div>
                    <u>{{ $dt['dt_sp']['khs_induks']['json']['direktur'] }}</u>
                    <br>
                    DIREKTUR
                </td>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
                <td>
                    PT. TELKOM AKSES
                    <div style="height: 80px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_pejabat']}}</u>
                    <br>
                    <span>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_jabatan']}}</span>
                </td>
            </tr>
            <tr><td colspan="4" style="text-align: center">
                Mengetahui / Menyetujui
                <br><br>
                <div style="height: 80px"></div>
                <u style="text-transform: uppercase">{{$dt['dt_tagihan']['dt_ttd']['gm_ta_pejabat']}}</u>
                <br>
                {{$dt['dt_tagihan']['dt_ttd']['gm_ta_jabatan']}}
            </td></tr>
        </table>
    </div>

</div>

