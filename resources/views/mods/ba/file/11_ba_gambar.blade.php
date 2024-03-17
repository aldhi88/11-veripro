<div>
    <center>

        <strong>
            BERITA ACARA SERAH TERIMA GAMBAR AKHIR PELAKSANAAN PEKERJAAN (AS-BUILT DRAWING) <br>
            BERDASARKAN <br>
            PERJANJIAN KERJA SAMA KONTRAK HARGA SATUAN (KHS) PEKERJAAN PENGADAAN BARANG DAN/ATAU JASA PEMASANGAN OUTSIDE PLANT FIBER OPTIK (OSP-FO)
        </strong>
        <br>
        Nomor : {{ $tagihan['json']['no_ba_gambar'] }}

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

<div>
    Kami yang bertanda tangan di bawah ini :
    <div style="height: 15px;"></div>

    <table class="table-collapse">
        <tr>
            <td rowspan="3">1</td>
            <td style="width: 100px">Nama</td>
            <td width="10">:</td>
            <td>{{ $tagihan['mitras']['master_users']['detail']['direktur'] }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>Direktur</td>
        </tr>
        <tr>
            <td colspan="3">Dalam hal ini mewakili {{ $tagihan['mitras']['master_users']['detail']['perusahaan'] }} yang selanjutnya disebut MITRA.</td>
            {{-- <td></td> --}}
        </tr>
        
    </table>

    <div style="height: 15px;"></div>

    <table class="table-collapse">
        
        <tr>
            <td rowspan="3">2</td>
            <td style="width: 100px">Nama</td>
            <td width="10">:</td>
            <td>DHIKA TRIOGASWARA</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>MGR. KONSTRUKSI MEDAN</td>
        </tr>
        <tr>
            <td colspan="3">Dalam hal ini mewakili PT. TELKOM AKSES yang selanjutnya disebut TELKOM AKSES.</td>
            {{-- <td></td> --}}
        </tr>
        
    </table>
</div>

<div style="height: 20px;"></div>


<div style="text-align: justify;">
    Pada hari ini, {{ Carbon\Carbon::parse($tagihan['json']['tgl_baut'])->isoFormat('dddd') }}, tanggal {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($tagihan['json']['tgl_baut'])->isoFormat('D')))}}, bulan {{ Carbon\Carbon::parse($tagihan['json']['tgl_baut'])->isoFormat('MMMM') }}, tahun {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($tagihan['json']['tgl_baut'])->isoFormat('Y')))}}, MITRA menyerahkan kepada TELKOM AKSES berupa gambar akhir pelaksanaan Pekerjaan (as built drawing) untuk Pekerjaan {{ $tagihan['sp_induks']['json']['nama_pekerjaan']  }} sesuai dengan Perjanjian Kerja Sama Kontrak Harga Satuan (KHS) Pekerjaan Pengadaan dan Pemasangan Outside Plant Fiber Optik (OSP-FO), Nomor: {{ $tagihan['sp_induks']['khs_induks']['no_kontrak']  }}, Tanggal {{ Carbon\Carbon::parse($tagihan['sp_induks']['khs_induks']['tgl_kontrak'])->isoFormat('D MMMM Y') }}, Surat Pesanan Nomor: {{ $tagihan['sp_induks']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($tagihan['sp_induks']['tgl_sp'])->isoFormat('D MMMM Y') }} adalah sebagai berikut:
</div>

<div style="height: 10px;"></div>

<span>
    <div>
        <table class="table-border" style="width: 100%">
            <tr style="text-align: center">
                <td width="50">No</td>
                <td>Lokasi</td>
                <td>STO</td>
                
            </tr>
    
            @foreach ($tagihan['json']['lokasi'] as $i=>$item)
                <tr style="text-align: center">
                    <td>{{$i+1}}</td>
                    <td>{{$item['nama']}}</td>
                    <td>{{$item['sto']}}</td>
                </tr>
            @endforeach
            
        </table>
    </div>
</span>
<div style="height: 10px;"></div>

<span style="text-align: justify">
    Gambar akhir pelaksanaan Pekerjaan (as built drawing), antara lain:Gambar akhir pelaksanaan Pekerjaan (as built drawing), antara lain:
    
    <ol style="padding-left: 1.2em">
        <li>Koordinat atau rute object hasil pekerjaan yang sesuai dengan kondisi di lapangan.</li>
        <li>Penamaan (Label) yang sesuai dengan standar penamaan Integrated Optical Distribution Network (I-ODN) dan sama dengan yang terpasang secara fisik di lapangan.</li>
        <li>Spesifikasi Barang/Material (Perangkat Telekomunikasi) sesuai yang terpasang di lapangan.</li>
        <li>Management Core yang menjelaskan konektivitas core secara end-to-end sebagai syarat go live.</li>
    </ol>
</span>

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
</div>