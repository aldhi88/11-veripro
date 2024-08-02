<div class="margin" style="text-align: justify; page-break-after: always;">

    <div>
        <div style="height: 20px"></div>
        <table class="table-box">
            <tr>
                <td width="100">Nomor</td>
                <td width="20">:</td>
                <td> {{ $dt['dt_tagihan']['no_bayar'] }}</td>
            </tr>
            <tr>
                <td colspan="3">
                    {{$dt['dt_sp']['khs_induks']['json']['lokasi']}},{{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_bayar'])->isoFormat('D MMMM Y') }}
                </td>
            </tr>

        </table>
    </div>

    <div style="height: 20px"></div>

    <div>
        Kepada Yth, <br>
        PT Telkom Akses <br>
        Unit Finance <br>
        Gedung Telkom Jakarta Barat, <br>
        Jl. Letjen S. Parman Kav.8 Tomang <br>
        Grogol Petamburan, Jakarta Barat DKI Jakarta 11440

    </div>

    <div style="height: 20px"></div>
        <table class="table-box">
            <tr>
                <td width="70">Perihal</td>
                <td width="20">:</td>
                <td>Perbayaran Pembayaran</td>
            </tr>
            <tr>
                <td width="70">Lampiran</td>
                <td width="20">:</td>
                <td>1 (Satu) Berkas</td>
            </tr>

        </table>

    <div style="height: 20px"></div>

    <div>

        <p style="text-align: justify">
            Dengan Hormat, <br><br>
            Menunjuk : <br> <br>

            <ol style="padding-left: 1rem">
                <li>
                    Perjanjian Kerja Sama Kontrak Harga Satuan (KHS) Pekerjaan Pengadaan dan/atau Pemasangan Outside Plant Fiber Optik (OSP-FO) antara PT. Telkom Akses dengan {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}, Nomor: {{ $dt['dt_sp']['khs_induks']['no'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_berlaku'])->isoFormat('D MMMM Y') }}
                </li>
                <li>
                    Surat Pesanan {{ $dt['dt_sp']['nama_pekerjaan'] }}, Nomor: {{ $dt['dt_sp']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('D MMMM Y') }}
                </li>

                @if (isset($dt['dt_tagihan']['aman_penutup']))
                    <li>
                        Amandemen Penutup nomor {{ $dt['dt_tagihan']['aman_penutup'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('D MMMM Y') }}
                    </li>
                @endif

                <li>
                    Berita Acara Rekonsiliasi, Nomor: {{ $dt['dt_tagihan']['no_ba_rekon'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('D MMMM Y') }}
                </li>
                <li>
                    Berita Acara Serah Terima (BAST), Nomor: {{ $dt['dt_tagihan']['no_bast'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_bast'])->isoFormat('D MMMM Y') }}
                </li>

            </ol>
        </p>

    </div>

    <div style="height: 20px"></div>

    @php
        $ppn = $dt['dt_sp']['ppn']/100;
        $ppnSp = $dt['dt_tagihan']['dt_lokasi']['grand_total']*$ppn;
        $ppnRekon = $dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']*$ppn;
    @endphp
    <div style="text-align: justify">
        Bahwa berdasarkan hal tersebut di atas, bersama surat ini kami mengajukan Perbayaran Pembayaran sebesar Rp. {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total']+$ppnSp,0,',','.')}},- ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(($dt['dt_tagihan']['dt_lokasi']['grand_total']+$ppnSp)))}} Rupiah) sudah termasuk PPN {{$dt['dt_sp']['ppn']}}%. Pembayaran dapat dilakukan melalui rekening sebagai berikut:
    </div>

    <div style="height: 20px"></div>
    <table class="table-box" style="margin-left: 40px">
        <tr>
            <td width="100">Bank</td>
            <td width="20">:</td>
            <td> {{ $dt['dt_sp']['khs_induks']['json']['bank'] }}</td>
        </tr>
        <tr>
            <td width="100">Cabang</td>
            <td width="20">:</td>
            <td> {{ $dt['dt_sp']['khs_induks']['json']['cabang'] }}</td>
        </tr>
        <tr>
            <td width="100">Rekening</td>
            <td width="20">:</td>
            <td> {{ $dt['dt_sp']['khs_induks']['json']['rekening'] }}</td>
        </tr>
        <tr>
            <td width="100">Atas Nama</td>
            <td width="20">:</td>
            <td> {{ $dt['dt_sp']['khs_induks']['json']['nama_rekening'] }}</td>
        </tr>

    </table>

    <div style="height: 20px"></div>

    <div style="page-break-inside: avoid; width: 100%">
        <div style="text-align: justify">
            Demikian surat perbayaran ini kami sampaikan, atas perhatian dan kerjasama yang baik, kami ucapkan terimakasih.
        </div>

        <div style="height: 30px;"></div>

        <table class="" style="width: 100%">
            <tr>
                <td style="width: 60%"></td>
                <td>
                    <center>
                        <strong>Hormat Kami</strong> <br>
                        <strong>{{ Str::upper($dt['dt_sp']['khs_induks']['json']['perusahaan']) }}</strong>
                        <div style="height: 100px"></div>
                        <strong><u>{{ Str::upper($dt['dt_sp']['khs_induks']['json']['direktur']) }}</u></strong>
                        <br>
                        DIREKTUR
                    </center>
                </td>
            </tr>
        </table>

    </div>

</div>
