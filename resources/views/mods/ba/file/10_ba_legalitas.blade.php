<div class="margin" style="text-align: justify; page-break-after: always;">

    <span>
        <div>
            <center>
                <strong>
                    BERITA ACARA SERAH TERIMA DOKUMEN LEGALITAS BARANG/MATERIAL <br>
                    (PERANGKAT TELEKOMUNIKASI) <br>
                    BERDASARKAN <br>
                    PERJANJIAN KERJA SAMA KONTRAK HARGA SATUAN (KHS) PEKERJAAN
                    @if ($dt['dt_sp']['master_units']['nama']=="QE")
                        MAINTENANCE/QUALITY ASSURANCE ({{$dt['dt_sp']['master_units']['nama']}})
                    @else
                        PENGADAAN DAN/ATAU PEMASANGAN OUTSIDE PLANT FIBER OPTIK ({{$dt['dt_sp']['master_units']['nama']}})
                    @endif
                    <br>
                </strong>
            </center>
        </div>

        <div style="height: 15px;"></div>

        <div>
            <style>
                td {
                    vertical-align: top;
                    padding: 0px 5px;
                }
            </style>
            <hr>
            <table style="width: 100%; vertical-align: top;">
                <tr style="font-weight: bold">
                    <td>NOMOR PERJANJIAN KERJASAMA</td>
                    <td>:</td>
                    <td>{{ $dt['dt_sp']['khs_induks']['no']  }}, TANGGAL: {{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_berlaku'])->isoFormat('DD MMMM Y') }}</td>
                </tr>

                @if (count($dt['aman_khs'])>0)

                    @foreach ($dt['aman_khs'] as $i=>$item)

                        <tr style="font-weight: bold;">
                            <td>
                                <ol style="margin: 0; padding-left: 25px;">
                                    <li>NO AMANDEMEN {{$i+1}}</li>
                                </ol>
                            </td>
                            <td>:</td>
                            <td>{{ $item['no'] }}, TANGGAL: {{ Carbon\Carbon::parse($item['tgl_berlaku'])->isoFormat('DD MMMM Y') }}</td>
                        </tr>

                    @endforeach

                @endif

                <tr style="font-weight: bold">
                    <td>NOMOR SURAT PESANAN</td>
                    <td>:</td>
                    <td>{{ $dt['dt_sp']['no_sp'] }}, TANGGAL: {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }}</td>
                </tr>
                @if (count($dt['aman_sp'])>0)

                    @foreach ($dt['aman_sp'] as $i=>$item)

                        <tr style="font-weight: bold;">
                            <td>
                                <ol style="margin: 0; padding-left: 25px;">
                                    <li>NO AMANDEMEN {{$i+1}}</li>
                                </ol>
                            </td>
                            <td>:</td>
                            <td>{{ $item['no_sp'] }}, TANGGAL: {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('DD MMMM Y') }}</td>
                        </tr>

                    @endforeach

                @endif

                <tr style="font-weight: bold">
                    <td>PEKERJAAN</td>
                    <td>:</td>
                    <td>{{ $dt['dt_sp']['nama_pekerjaan'] }}</td>
                </tr>
                <tr style="font-weight: bold">
                    <td>PELAKSANA PEKERJAAN</td>
                    <td>:</td>
                    <td>{{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }} (selanjutnya disebut MITRA)</td>
                </tr>
                <tr style="font-weight: bold">
                    <td>REGIONAL</td>
                    <td>:</td>
                    <td>SUMATERA</td>
                </tr>
                <tr style="font-weight: bold">
                    <td>AREA</td>
                    <td>:</td>
                    <td>MEDAN</td>
                </tr>

            </table>
            <hr>
        </div>
    </span>

    <div style="height: 15px;"></div>

    <div style="text-align: justify;">
        Pada hari ini {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_bast'])->isoFormat('dddd') }}, tanggal {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($dt['dt_tagihan']['tgl_bast'])->isoFormat('D')))}}, bulan {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_bast'])->isoFormat('MMMM') }}, tahun {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($dt['dt_tagihan']['tgl_bast'])->isoFormat('Y')))}} ({{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_bast'])->isoFormat('DD/MM/Y') }}), bertempat di Kantor Telkom Akses Area Medan, telah dilakukan serah terima legalitas/keabsahan Barang/Material (Perangkat Telekomunikasi) dengan rincian adalah sebagai berikut:
    </div>

    <div style="height: 15px;"></div>

    <span>
        <table class="table-border">
            <thead style="text-align: center; font-weight: bold; vertical-align: middle">
                <tr>
                    <td rowspan="2">No</td>
                    <td rowspan="2">Dokumen</td>
                    <td colspan="2">Keterangan</td>
                </tr>
                <tr>
                    <td>Ada</td>
                    <td widtd="100">Tdk Ada</td>
                </tr>
            </thead>
            <tbody>
                @php $index = 0; @endphp
                @foreach ($doc as $i=>$item)
                    @if (is_array($item))
                        @foreach ($item as $iSub=>$itemSub)
                            @php $index = $index+$iSub; @endphp
                            <tr>
                                @if ($iSub==0) <td rowspan="2">{{$i+1}}</td> @endif
                                <td class="text-left">{{$itemSub}} {{$index}}</td>
                                <td style="text-align: center">
                                    @if ($dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==1)
                                    ✓
                                    @endif
                                </td>
                                <td style="text-align: center">
                                    @if ($dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==0)
                                    ✓
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td class="text-left">{{ $item }} {{$index}}</td>
                            <td style="text-align: center">
                                @if ($dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==1)
                                ✓
                                @endif
                            </td>
                            <td style="text-align: center">
                                @if ($dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==0)
                                ✓
                                @endif
                            </td>
                        </tr>
                    @endif
                    @php $index +=1; @endphp
                @endforeach
            </tbody>
        </table>
    </span>

    <div style="height: 10px;"></div>

    <span style="text-align: justify">
        Demikian Berita Acara Serah Terima Dokumen Legalitas Barang/Material (Perangkat Telekomunikasi) ini dibuat dengan itikad baik dan telah disepakati oleh Para Pihak.
    </span>

    <div style="height: 20px;"></div>


    <div style="page-break-inside: avoid; width: 100%">
        <table style="width: 100%; vertical-align: top; text-align:center; font-weight: bold;" class="table-border">
            <tr>
                <td style="width: 50%; text-transform: uppercase">
                    {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}
                    <div style="height: 100px"></div>
                    <u>{{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}</u>
                    <br>
                    DIREKTUR
                </td>
                <td style="text-transform: uppercase">
                    PT. TELKOM AKSES
                    <div style="height: 100px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['waspang_pejabat']}}</u>
                    <br>
                    <span style="text-transform: uppercase">{{$dt['dt_tagihan']['dt_ttd']['waspang_jabatan']}}</span>

                </td>
            </tr>
            <tr style="text-transform: uppercase">
                <td colspan="2">
                    <span style="font-weight: normal;text-transform: capitalize">Mengetahui/Menyetujui</span><br>
                    PT. TELKOM AKSES
                    <div style="height: 100px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_pejabat']}}</u>
                    <br>
                    <span>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_jabatan']}}</span>
                </td>
            </tr>
        </table>
    </div>

</div>
