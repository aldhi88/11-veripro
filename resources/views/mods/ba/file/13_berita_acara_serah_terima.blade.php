<div class="margin" style="text-align: justify; page-break-after: always;">

    <span>
        <div>
            <center>
                <strong>
                    BERITA ACARA SERAH TERIMA PERTAMA (BAST-I) <br>
                    BERDASARKAN <br>
                    PERJANJIAN KERJA SAMA KONTRAK HARGA SATUAN (KHS) PEKERJAAN <br>
                    @if ($dt['dt_sp']['master_units']['nama']=="QE")
                        MAINTENANCE/QUALITY ASSURANCE ({{$dt['dt_sp']['master_units']['nama']}})
                    @else
                        PENGADAAN DAN/ATAU PEMASANGAN OUTSIDE PLANT FIBER OPTIK ({{$dt['dt_sp']['master_units']['nama']}})
                    @endif
                    <br>
                    Nomor : {{ $dt['dt_tagihan']['no_bast'] }}
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

    <div style="height: 15px"></div>

    <span>
        Kami yang bertanda tangan di bawah ini :
        <div style="height: 15px;"></div>

        <table class="" style="width: 100%">
            <tr>
                <td>1. </td>
                <td style="width: 100px">Nama</td>
                <td style="width: 20px">:</td>
                <td style="text-transform: uppercase"><strong>{{ $dt['dt_sp']['khs_induks']['json']['direktur'] }}</strong></td>
            </tr>
            <tr>
                <td></td>
                <td>Jabatan</td>
                <td>:</td>
                <td><strong>DIREKTUR</strong></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3">Dalam hal ini mewakili <strong>{{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}</strong> yang selanjutnya disebut <strong>MITRA</strong>.</td>
            </tr>
        </table>
        <div style="height: 5px;"></div>
        <table class="" style="width: 100%">
            <tr>
                <td>2. </td>
                <td style="width: 100px">Nama</td>
                <td style="width: 20px">:</td>
                <td style="text-transform: uppercase"><strong>{{$dt['dt_tagihan']['dt_ttd']['gm_ta_pejabat']}}</strong></td>
            </tr>
            <tr>
                <td></td>
                <td>Jabatan</td>
                <td>:</td>
                <td style="text-transform: uppercase"><strong>{{$dt['dt_tagihan']['dt_ttd']['gm_ta_jabatan']}}</strong></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3">Dalam hal ini mewakili <strong>PT. TELKOM AKSES</strong> yang selanjutnya disebut <strong>TELKOM AKSES</strong>.</td>
            </tr>
        </table>
    </span>

    <div style="height: 15px;"></div>

    <div>

        Pada hari ini, {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_bast'])->isoFormat('dddd') }}, tanggal {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($dt['dt_tagihan']['tgl_bast'])->isoFormat('D')))}}, bulan {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_bast'])->isoFormat('MMMM') }}, tahun {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($dt['dt_tagihan']['tgl_bast'])->isoFormat('Y')))}}, MITRA
    </div>

    <div style="height: 15px;"></div>
    <div><center><strong>MENYERAHKAN</strong></center></div>

    <div style="height: 15px;"></div>

    <div style="text-align: justify;">
        Kepada TELKOM AKSES hasil pelaksanaan Pekerjaan {{ $dt['dt_sp']['nama_pekerjaan'] }} dengan nilai sebesar Rp. {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total'],0,',','.')}},00 ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($dt['dt_tagihan']['dt_lokasi']['grand_total']))}} Rupiah) belum termasuk PPN {{$dt['dt_sp']['ppn']}}% atau sebesar Rp. {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'],0,',','.')}},- ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']))}} Rupiah) sudah termasuk PPN {{$dt['dt_sp']['ppn']}}% (rincian terlampir), sesuai dengan ketentuan Perjanjian Kerja Sama Kontrak Harga Satuan (KHS)  Pekerjaan Pengadaan dan/atau Pemasangan Outside Plant Fiber Optik (OSP-FO) dan Surat Pesanan yang dilaksanakan oleh MITRA dan TELKOM AKSES menyatakan:
    </div>

    <div style="height: 15px;"></div>
    <div><center><strong>MENERIMA</strong></center></div>

    <div style="height: 10px;"></div>

    <div>
    Penyerahan Hasil Pekerjaan tersebut di atas dengan baik dengan ketentuan sebagai berikut: <br>
    <ol style="padding-left: 1rem">
        <li>
            Lingkup Pekerjaan sebagaimana yang dipersyaratkan dalam Perjanjian Kerja Sama Kontrak Harga Satuan (KHS)  Pekerjaan Pengadaan dan/atau Pemasangan Outside Plant Fiber Optik (OSP-FO)dan Surat Pesanan telah selesai baik secara fisik maupun teknis, telah diuji terima, dinyatakan baik sesuai Spesifikasi Teknis.
        </li>
        <li>
            Jangka waktu  penyelesaian  Pekerjaan sesuai ketentuan dalam Surat Pesanan dan dilaksanakan dengan baik dan dapat diterima TELKOM AKSES.
        </li>
        <li>
            MITRA wajib memperbaiki atau mengganti hasil pekerjaan dengan yang baru atas biaya MITRA apabila terjadi kerusakan dan/atau gangguan yang timbul dalam masa pemeliharan.
        </li>
        <li>
            Masa Pemeliharaan adalah selama 365 (tiga ratus enam puluh lima) hari kalender sejak tanggal Berita Acara Serah Terima Pertama (BAST-I).
        </li>
        <li>
            Berita Acara Serah Terima Kedua (BAST-II) akan ditandatangani setelah MITRA menyelesaikan semua kewajibannya dan tanggung jawab berdasarkan Perjanjian Kerja Sama Kontrak Harga Satuan (KHS)  Pekerjaan Pengadaan dan/atau Pemasangan Outside Plant Fiber Optik (OSP-FO) dan Surat Pesanan termasuk Masa Pemeliharaan selama 365 (tiga ratus enam puluh lima) Hari Kalender terhitung sejak tanggal Berita Acara Serah Terima Pertama (BAST-I).
        </li>
    </ol>

    </div>

    <div style="height: 10px;"></div>

    <div style="page-break-inside: avoid; width: 100%">
        <span style="text-align: justify">
            Demikian Berita Acara Serah Terima Pertama (BAST-I) ini dibuat dalam keadaan sebenarnya dan untuk dipergunakan sebagaimana mestinya.
        </span>

        <div style="height: 20px;"></div>

        <table style="width: 100%; vertical-align: top; text-align:center; font-weight: bold;" class="table-border">
            <tr>
                <td style="width: 50%">
                    {{ Str::upper($dt['dt_sp']['khs_induks']['json']['perusahaan']) }}
                    <div style="height: 100px"></div>
                    <u>{{ Str::upper($dt['dt_sp']['khs_induks']['json']['direktur']) }}</u>
                    <br>
                    DIREKTUR
                </td>
                <td>
                    PT. TELKOM AKSES
                    <div style="height: 100px"></div>
                    <u>{{ Str::upper($dt['dt_tagihan']['dt_ttd']['gm_ta_pejabat']) }}</u>
                    <br>
                    <span>{{Str::upper($dt['dt_tagihan']['dt_ttd']['gm_ta_jabatan'])}}</span>
                </td>
            </tr>

        </table>
    </div>

</div>

