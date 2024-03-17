<div>
    <center>

        <strong>
            BERITA ACARA SERAH TERIMA PERTAMA (BAST-I) <br>
            BERDASARKAN <br>
            PERJANJIAN KERJA SAMA KONTRAK HARGA SATUAN (KHS) PEKERJAAN PENGADAAN DAN/ATAU <br>
            PEMASANGAN OUTSIDE PLANT FIBER OPTIK (OSP-FO) <br>

        </strong>
        Nomor: {{ $tagihan['json']['no_bast'] }}

    </center>
</div>

<div style="height: 15px"></div>

<hr>
<div>
    <style>
        td {
            vertical-align: top;
            padding: 0px 5px;
        }
    </style>
    <table style="width: 100%; vertical-align: top;">
        <tr style="font-weight: bold">
            <td>NOMOR PERJANJIAN</td>
            <td>:</td>
            <td>{{ $tagihan['sp_induks']['khs_induks']['no_kontrak'] }}, TANGGAL: {{ Carbon\Carbon::parse($tagihan['sp_induks']['khs_induks']['tgl_kontrak'])->isoFormat('D MMMM Y') }}</td>
        </tr>
        
        @if (count($amanKhs)>0)

            @foreach ($amanKhs as $i=>$item)

                <tr style="font-weight: bold;">
                    <td>
                        <ol style="margin: 0; padding-left: 25px;">
                            <li>NO AMANDEMEN {{$i+1}}</li>
                        </ol>
                    </td>
                    <td>:</td>
                    <td>{{ $item['no_aman'] }}, TANGGAL: {{ Carbon\Carbon::parse($item['tgl_aman'])->isoFormat('D MMMM Y') }}</td>
                </tr>
                
            @endforeach
        
        @endif

        <tr style="font-weight: bold">
            <td>NOMOR SURAT PESANAN</td>
            <td>:</td>
            <td>{{ $tagihan['sp_induks']['no_sp'] }}, TANGGAL: {{ Carbon\Carbon::parse($tagihan['sp_induks']['tgl_sp'])->isoFormat('D MMMM Y') }}</td>
        </tr>
        @if (count($tagihan['sp_induks']['sp_amandemens'])>0)

            @foreach ($tagihan['sp_induks']['sp_amandemens'] as $i=>$item)

                <tr style="font-weight: bold;">
                    <td>
                        <ol style="margin: 0; padding-left: 25px;">
                            <li>NO AMANDEMEN {{$i+1}}</li>
                        </ol>
                    </td>
                    <td>:</td>
                    <td>{{ $item['no_sp'] }}, TANGGAL: {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('D MMMM Y') }}</td>
                </tr>

            @endforeach
        
        @endif

        <tr style="font-weight: bold">
            <td>NOMOR AMANDEMEN PENUTUP</td>
            <td>:</td>
            <td>{{ $tagihan['json']['aman_penutup'] }}, TANGGAL: {{ Carbon\Carbon::parse($tagihan['json']['tgl_ba_rekon'])->isoFormat('D MMMM Y') }}</td>
        </tr>

        <tr style="font-weight: bold">
            <td>PEKERJAAN</td>
            <td>:</td>
            <td>{{ $tagihan['sp_induks']['json']['nama_pekerjaan'] }}</td>
        </tr>
        <tr style="font-weight: bold">
            <td>PELAKSANA PEKERJAAN</td>
            <td>:</td>
            <td>{{ $tagihan['mitras']['master_users']['detail']['perusahaan'] }} (selanjutnya disebut MITRA)</td>
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
            <td>{{ $tagihan['json']['json_sp']['json']['id_project'] }}</td>
        </tr>
    </table>

</div>
<hr>

<div style="height: 15px;"></div>

<div>
    Kami yang bertanda tangan di bawah ini :
    <div style="height: 15px;"></div>

    <table class="table-collapse">
        <tr>
            <td rowspan="3">1</td>
            <td style="width: 100px">Nama</td>
            <td width="10">:</td>
            <td>{{ Str::upper($tagihan['mitras']['master_users']['detail']['direktur']) }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>DIREKTUR</td>
        </tr>
        <tr>
            <td colspan="3">Dalam hal ini mewakili {{ Str::upper($tagihan['mitras']['master_users']['detail']['perusahaan']) }} yang selanjutnya disebut MITRA.</td>
            {{-- <td></td> --}}
        </tr>
        
    </table>
    <div style="height: 15px;"></div>
    <table class="table-collapse">
        
        <tr>
            <td rowspan="3">2</td>
            <td style="width: 100px">Nama</td>
            <td width="10">:</td>
            <td>{{ Str::upper($data['gm_ta']) }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>GM TA MEDAN</td>
        </tr>
        <tr>
            <td colspan="3">Dalam hal ini mewakili PT. TELKOM AKSES yang selanjutnya disebut TELKOM AKSES.</td>
            {{-- <td></td> --}}
        </tr>
        
    </table>
</div>

<div style="height: 15px;"></div>

<div>
    
    Pada hari ini, {{ Carbon\Carbon::parse(now())->isoFormat('dddd') }}, tanggal {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse(now())->isoFormat('D')))}}, bulan {{ Carbon\Carbon::parse(now())->isoFormat('MMMM') }}, tahun {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse(now())->isoFormat('Y')))}}, MITRA
</div>

<div style="height: 15px;"></div>
<div><center><strong>MENYERAHKAN</strong></center></div>

<div style="height: 15px;"></div>

<div style="text-align: justify;">
    Kepada TELKOM AKSES hasil pelaksanaan Pekerjaan {{ $tagihan['sp_induks']['json']['nama_pekerjaan'] }} dengan nilai sebesar Rp. {{number_format($tagihan['json']['total_rekon'],0,',','.')}},00 ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($tagihan['json']['total_rekon']))}} Rupiah) belum termasuk PPN {{$data['json_sp']['json']['ppn']}}% atau sebesar Rp. {{number_format($data['total_rekon_ppn'],0,',','.')}},- ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($data['total_rekon_ppn']))}} Rupiah) sudah termasuk PPN {{$data['json_sp']['json']['ppn']}}% (rincian terlampir), sesuai dengan ketentuan Perjanjian Kerja Sama Kontrak Harga Satuan (KHS)  Pekerjaan Pengadaan dan/atau Pemasangan Outside Plant Fiber Optik (OSP-FO) dan Surat Pesanan yang dilaksanakan oleh MITRA dan TELKOM AKSES menyatakan: 
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

<span style="text-align: justify">
    Demikian Berita Acara Serah Terima Pertama (BAST-I) ini dibuat dalam keadaan sebenarnya dan untuk dipergunakan sebagaimana mestinya.
</span>

<div style="height: 20px;"></div>


<div>
    <table style="width: 100%; vertical-align: top; text-align:center; font-weight: bold;" class="table-border">
        <tr>
            <td style="width: 50%">
                {{ Str::upper($tagihan['mitras']['master_users']['detail']['perusahaan']) }}
                <div style="height: 100px"></div>
                <u>{{ Str::upper($tagihan['mitras']['master_users']['detail']['direktur']) }}</u>
                <br>
                DIREKTUR
            </td>
            <td>
                PT. TELKOM AKSES
                <div style="height: 100px"></div>
                <u>{{ Str::upper($data['gm_ta']) }}</u>
                <br>
                <span>GM TA MEDAN</span>
            </td>
        </tr>

    </table>
</div>