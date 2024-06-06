error
{{-- <div>
    Jakarta, {{ Carbon\Carbon::parse($tagihan['json']['tgl_bayar'])->isoFormat('D MMMM Y') }}
    <div style="height: 20px"></div>
    <table class="table-box">
        <tr>
            <td width="100">Nomor</td>
            <td width="20">:</td>
            <td> {{ $tagihan['json']['no_bayar'] }}</td>
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
            <td width="100">Hal</td>
            <td width="20">:</td>
            <td> <strong><u>Perbayaran Pembayaran</u></strong> </td>
        </tr>

    </table>

<div style="height: 20px"></div>

<div>

    <p style="text-align: justify">
        Dengan Hormat, <br><br>
        Menunjuk : <br> <br>

        <ol style="padding-left: 1rem">
            <li>
                Perjanjian Kerja Sama Kontrak Harga Satuan (KHS) Pekerjaan Pengadaan dan/atau Pemasangan Outside Plant Fiber Optik (OSP-FO) antara PT. Telkom Akses dengan {{ $tagihan['mitras']['master_users']['detail']['perusahaan'] }}, Nomor: {{ $tagihan['sp_induks']['khs_induks']['no_kontrak'] }}, Tanggal {{ Carbon\Carbon::parse($tagihan['sp_induks']['khs_induks']['tgl_kontrak'])->isoFormat('D MMMM Y') }}
            </li>
            <li>
                Surat Pesanan {{ $tagihan['sp_induks']['json']['nama_pekerjaan'] }}, Nomor: {{ $tagihan['sp_induks']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($tagihan['sp_induks']['tgl_sp'])->isoFormat('D MMMM Y') }}
            </li>
            <li>
                Amandemen Penutup nomor {{ $tagihan['json']['aman_penutup'] }}, Tanggal {{ Carbon\Carbon::parse($tagihan['json']['tgl_ba_rekon'])->isoFormat('D MMMM Y') }}
            </li>
            <li>
                Berita Acara Rekonsiliasi, Nomor: {{ $tagihan['json']['no_ba_rekon'] }}, Tanggal {{ Carbon\Carbon::parse($tagihan['json']['tgl_ba_rekon'])->isoFormat('D MMMM Y') }}
            </li>
            <li>
                Berita Acara Serah Terima (BAST), Nomor: {{ $tagihan['json']['no_bast'] }}, Tanggal {{ Carbon\Carbon::parse($tagihan['json']['tgl_bast'])->isoFormat('D MMMM Y') }}
            </li>

        </ol>
    </p>

</div>

<div style="height: 20px"></div>
<div style="text-align: justify">
    Bahwa berdasarkan hal tersebut di atas, bersama surat ini kami mengajukan Perbayaran Pembayaran sebesar Rp. {{number_format($data['total_rekon_ppn'],0,',','.')}},- ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($data['total_rekon_ppn']))}} Rupiah) sudah termasuk PPN {{$data['json_sp']['json']['ppn']}}%. Pembayaran dapat dilakukan melalui rekening sebagai berikut:
</div>

<div style="height: 20px"></div>
<table class="table-box" style="margin-left: 40px">
    <tr>
        <td width="100">Bank</td>
        <td width="20">:</td>
        <td> {{ $data['rek']['bank'] }}</td>
    </tr>
    <tr>
        <td width="100">Cabang</td>
        <td width="20">:</td>
        <td> {{ $data['rek']['cabang'] }}</td>
    </tr>
    <tr>
        <td width="100">Rekening</td>
        <td width="20">:</td>
        <td> {{ $data['rek']['rekening'] }}</td>
    </tr>
    <tr>
        <td width="100">Atas Nama</td>
        <td width="20">:</td>
        <td> {{ $data['rek']['nama_rekening'] }}</td>
    </tr>

</table>

<div style="height: 20px"></div>
<div style="text-align: justify">
    Demikian surat perbayaran ini kami sampaikan, atas perhatian dan kerjasama yang baik, kami ucapkan terimakasih.
</div>

<div style="height: 30px;"></div>

<div>
    <strong>Hormat Kami</strong> <br>
    <strong>{{ Str::upper($tagihan['mitras']['master_users']['detail']['perusahaan']) }}</strong>
    <div style="height: 100px"></div>
    <strong><u>{{ Str::upper($tagihan['mitras']['master_users']['detail']['direktur']) }}</u></strong>
    <br>
    DIREKTUR
</div> --}}
