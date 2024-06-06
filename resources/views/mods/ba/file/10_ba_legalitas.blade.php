error
{{-- <div>
    <center>

        <strong>
            BERITA ACARA SERAH TERIMA DOKUMEN LEGALITAS BARANG/MATERIAL <br>
            (PERANGKAT TELEKOMUNIKASI) <br>
            BERDASARKAN <br>
            PERJANJIAN KERJA SAMA KONTRAK HARGA SATUAN (KHS) PEKERJAAN PENGADAAN BARANG DAN/ATAU JASA PEMASANGAN OUTSIDE PLANT FIBER OPTIK (OSP-FO)
        </strong>

    </center>
</div>

<div style="height: 20px"></div>

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
            <td>NOMOR PERJANJIAN KERJASAMA</td>
            <td>:</td>
            <td>{{ $tagihan['sp_induks']['khs_induks']['no_kontrak']  }}, TANGGAL: {{ Carbon\Carbon::parse($tagihan['sp_induks']['khs_induks']['tgl_kontrak'])->isoFormat('D MMMM Y') }}</td>
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
    </table>

</div>
<hr>

<div style="height: 15px;"></div>

<div style="text-align: justify;">
    Pada hari ini, {{ Carbon\Carbon::parse($tagihan['json']['tgl_baut'])->isoFormat('dddd') }}, tanggal {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($tagihan['json']['tgl_baut'])->isoFormat('D')))}}, bulan {{ Carbon\Carbon::parse($tagihan['json']['tgl_baut'])->isoFormat('MMMM') }}, tahun {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($tagihan['json']['tgl_baut'])->isoFormat('Y')))}} ({{ Carbon\Carbon::parse($tagihan['json']['tgl_baut'])->isoFormat('D/MM/Y') }}), bertempat di Kantor Telkom Akses Area Medan, telah dilakukan perhitungan nilai akhir (rekonsiliasi) pelaksanaan pekerjaan dengan rincian adalah sebagai berikut:
</div>

<div style="height: 10px;"></div>

<table class="table-border">
        <tr style="text-align: center; font-weight: bold; vertical-align: middle">
            <td style="vertical-align: middle" rowspan="2">No</td>
            <td style="vertical-align: middle" rowspan="2">Dokumen</td>
            <td style="vertical-align: middle" colspan="2">Keterangan</td>
        </tr>
        <tr style="text-align: center; font-weight: bold">
            <td style="vertical-align: middle">Ada</td>
            <td style="vertical-align: middle">Tdk Ada</td>
        </tr>

        <tr>
            <td rowspan="2">1</td>
            <td>Sertifikat Quality Assurance (QA)</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][0]==1?"&#10003;":null !!}</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][0]==0?"&#10003;":null !!}</td>
        </tr>
        <tr>
            <td>Surat Keterangan dari Unit Quality & Infrastructure Development</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][1]==1?"&#10003;":null !!}</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][1]==0?"&#10003;":null !!}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Sertifikat Hak Merek atau Surat Keterangan Terdaftar dari Kementrian Hukum dan HAM atau perjanjian lisensi atau royalty dari pemegang Hak Cipta, Hak Merek, atau Hak Paten</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][2]==1?"&#10003;":null !!}</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][2]==0?"&#10003;":null !!}</td>
        </tr>
        <tr>
            <td rowspan="2">3</td>
            <td>Surat keterangan lulus Quality Check (QC)</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][3]==1?"&#10003;":null !!}</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][3]==0?"&#10003;":null !!}</td>
        </tr>
        <tr>
            <td>Berita Acara Lulus Quality Check (QC) Ulang</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][4]==1?"&#10003;":null !!}</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][4]==0?"&#10003;":null !!}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Certificate of origin</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][5]==1?"&#10003;":null !!}</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][5]==0?"&#10003;":null !!}</td>
        </tr>
        <tr>
            <td rowspan="2">5</td>
            <td>Surat Jalan/Delivery Order (DO) dari Produsen (Pabrik)</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][6]==1?"&#10003;":null !!}</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][6]==0?"&#10003;":null !!}</td>
        </tr>
        <tr>
            <td>Surat Jalan/Delivery Order (DO) dari supplier atau agen resmi</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][7]==1?"&#10003;":null !!}</td>
            <td style="text-align: center">{!! $tagihan['json']['rincian'][7]==0?"&#10003;":null !!}</td>
        </tr>

</table>

<div style="height: 10px;"></div>

<span style="text-align: justify">
    Demikian Berita Acara Serah Terima Dokumen Legalitas Barang/Material (Perangkat Telekomunikasi) ini dibuat dengan itikad baik dan telah disepakati oleh Para Pihak.
</span>

<div style="height: 20px;"></div>


<div>
    <table style="width: 100%; vertical-align: top; text-align:center; font-weight: bold;" class="table-border">
        <tr>
            <td style="width: 50%">
                {{ $tagihan['mitras']['master_users']['detail']['perusahaan'] }}
                <div style="height: 100px"></div>
                <u>{{ $tagihan['mitras']['master_users']['detail']['direktur'] }}</u>
                <br>
                DIREKTUR
            </td>
            <td>
                PT. TELKOM AKSES
                <div style="height: 100px"></div>
                <u>{{$data['unit_sm']['nama']}}</u>
                <br>
                <span>{{$data['unit_sm']['jabatan']}}</span>
            </td>
        </tr>

    </table>
</div> --}}
