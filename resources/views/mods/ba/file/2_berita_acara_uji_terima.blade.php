<div class="margin" style="text-align: justify; page-break-after: always;">
    <div>
        <center>

            <strong>
            BERITA  ACARA UJI TERIMA (BAUT) <br>
            BERDASARKAN <br>
            PERJANJIAN KERJA SAMA KONTRAK HARGA SATUAN (KHS) PEKERJAAN PENGADAAN DAN/ATAU PEMASANGAN OUTSIDE PLANT FIBER OPTIK (OSP-FO)
            </strong>
            <br>
            Nomor : {{ $dt['dt_tagihan']['no_baut'] }}

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
        <table style="width: 100%; vertical-align: top;" class="table-border">
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
            <tr style="font-weight: bold">
                <td>ID PROJECT</td>
                <td>:</td>
                <td>
                    @php
                        $aryProject = [];
                        foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $key => $value) {
                            if (!in_array($value['id_project'], $aryProject)) {
                                if($key!=0){
                                    echo ', ';
                                }
                                echo $value['id_project'];
                                array_push($aryProject, $value['id_project']);
                            }
                        }
                    @endphp
                </td>
            </tr>

        </table>

    </div>

    <div style="height: 15px;"></div>

    <div>
        Pada hari ini, {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_baut'])->isoFormat('dddd') }}, tanggal {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($dt['dt_tagihan']['tgl_baut'])->isoFormat('D')))}}, bulan {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_baut'])->isoFormat('MMMM') }}, tahun {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($dt['dt_tagihan']['tgl_baut'])->isoFormat('Y')))}} ({{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_baut'])->isoFormat('D/MM/Y') }}), bertempat di Kantor Telkom Akses Area Medan, telah dilakukan perhitungan nilai akhir (rekonsiliasi) pelaksanaan pekerjaan dengan rincian adalah sebagai berikut:
    </div>

    <div>
        <ol>
            <li>
                Berdasarkan hasil pemeriksaan yang dilaksanakan pada tanggal <span>{{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_nodin'])->isoFormat('DD MMMM Y') }}</span>, oleh Tim Uji Terima terhadap Pekerjaan {{ $dt['dt_sp']['nama_pekerjaan'] }} yang dilaksanakan oleh {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }} berdasarkan Perjanjian Kerjasama Pekerjaan Pengadaan dan Pemasangan Outside Plant Fiber Optik (OSP-FO), Nomor: {{ $dt['dt_sp']['khs_induks']['no']  }}, tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_berlaku'])->isoFormat('DD MMMM Y') }}, Surat Pesanan Nomor: {{ $dt['dt_sp']['no_sp'] }}, tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }}
            </li>

            <li>
                Bahwa Pekerjaan tersebut diatas dinyatakan TELAH sesuai dengan spesifikasi teknis yang ditentukan di dalam Perjanjian Perjanjian Kerjasama Pekerjaan Pengadaan Barang dan Jasa Pemasangan Outside Plant Fiber Optik (OSP-FO) serta Surat Pesanan, dan dinyatakan:
                <br>
                <strong><center>DITERIMA / <del>DITOLAK</del></center></strong>
            </li>

            <li>
                Apabila berdasarkan Uji Terima terdapat penggantian dan/atau perbaikan, maka penggantian dan/atau perbaikan tersebut dituangkan pada Lembar Catatan Hasil Uji Terima dalam Lampiran Berita Acara Uji Terima ini dan wajib diperbaiki secepatnya.
            </li>
        </ol>
    </div>


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
                    <u>{{$dt['dt_tagihan']['dt_ttd']['sm_unit_pejabat']}}</u>
                    <br>
                    <span style="text-transform: uppercase">{{$dt['dt_tagihan']['dt_ttd']['sm_unit_jabatan']}}</span>

                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 5px;">Mengetahui/Menyetujui</td>
            </tr>

            <tr style="text-transform: uppercase">
                <td>
                    PT. TELKOM AKSES
                    <div style="height: 100px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_pejabat']}}</u>
                    <br>
                    <span>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_jabatan']}}</span>
                </td>
                <td>
                    PT. TELKOM AKSES
                    <div style="height: 100px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['gm_ta_pejabat']}}</u>
                    <br>
                    <span>{{$dt['dt_tagihan']['dt_ttd']['gm_ta_jabatan']}}</span>
                </td>
            </tr>
        </table>
    </div>
</div>
