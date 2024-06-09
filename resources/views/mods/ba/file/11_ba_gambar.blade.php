<div class="margin" style="text-align: justify; page-break-after: always;">
    <span>
        <div>
            <center>
                <strong>
                    BERITA ACARA SERAH TERIMA GAMBAR AKHIR PELAKSANAAN PEKERJAAN (AS-BUILT DRAWING) <br>
                    BERDASARKAN <br>
                    PERJANJIAN KERJA SAMA KONTRAK HARGA SATUAN (KHS) PEKERJAAN <br>
                    @if ($dt['dt_sp']['master_units']['nama']=="QE")
                        MAINTENANCE/QUALITY ASSURANCE ({{$dt['dt_sp']['master_units']['nama']}})
                    @else
                        PENGADAAN DAN/ATAU PEMASANGAN OUTSIDE PLANT FIBER OPTIK ({{$dt['dt_sp']['master_units']['nama']}})
                    @endif
                    <br>
                    </strong>

                    Nomor : {{ $dt['dt_tagihan']['no_ba_gambar'] }}

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

        <table class="table-collapse">
            <tr>
                <td>1. </td>
                <td style="width: 100px">Nama</td>
                <td>:</td>
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
            <tr>
                <td>2. </td>
                <td style="width: 100px">Nama</td>
                <td>:</td>
                <td style="text-transform: uppercase"><strong>{{$dt['dt_tagihan']['dt_ttd']['mgr_shared_pejabat']}}</strong></td>
            </tr>
            <tr>
                <td></td>
                <td>Jabatan</td>
                <td>:</td>
                <td style="text-transform: uppercase"><strong>{{$dt['dt_tagihan']['dt_ttd']['mgr_shared_jabatan']}}</strong></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3">Dalam hal ini mewakili <strong>PT. TELKOM AKSES</strong> yang selanjutnya disebut <strong>TELKOM AKSES</strong>.</td>
            </tr>
        </table>
    </span>

    <div style="height: 15px;"></div>

    <span>
        <p>
            Pada hari ini {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('dddd') }} tanggal {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('D')))}}, bulan {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('MMMM') }}, tahun {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('Y')))}}, MITRA menyerahkan kepada TELKOM AKSES berupa gambar akhir pelaksanaan Pekerjaan (as built drawing) untuk Pekerjaan
<strong>{{ $dt['dt_sp']['nama_pekerjaan'] }}</strong>
sesuai dengan Perjanjian Kerja Sama Kontrak Harga Satuan (KHS) Pekerjaan

            <strong>
                @if ($dt['dt_sp']['master_units']['nama']=="QE")
                    MAINTENANCE/QUALITY ASSURANCE ({{$dt['dt_sp']['master_units']['nama']}})
                @else
                    PENGADAAN DAN/ATAU PEMASANGAN OUTSIDE PLANT FIBER OPTIK ({{$dt['dt_sp']['master_units']['nama']}})
                @endif
            </strong>

            Nomor:
            <strong>{{$dt['dt_sp']['khs_induks']['no']}}</strong>,
            Tanggal
            <strong>{{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_berlaku'])->isoFormat('DD MMMM Y') }}</strong>
            , Surat Pesanan Nomor:
            <strong>{{ $dt['dt_sp']['no_sp'] }}</strong>
            , Tanggal
            <strong>{{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }}</strong>
            adalah sebagai berikut:
        </p>
    </span>

    <div style="height: 15px;"></div>

    <span>
        <table class="table-border" style="width: 100%">
            <tr style="text-align: center; font-weight: bold">
                <td width="50">NO</td>
                <td>LOKASI</td>
                <td>STO</td>

            </tr>

            @foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $i=>$item)
                <tr style="text-align: right">
                    <td><center>{{$i+1}}</center></td>
                    <td><center>{{$item['nama_lokasi']}}</center></td>
                    <td><center>{{$item['sto']}}</center></td>
                </tr>
            @endforeach
        </table>
    </span>

    <div style="height: 15px;"></div>

    <span>

        <p>Gambar akhir pelaksanaan Pekerjaan (as built drawing), antara lain:</p>
        <style>
            ol li{
                line-height: 1.5 !important;
            }
        </style>
        <ol>
            <li>Koordinat atau rute object hasil pekerjaan yang sesuai dengan kondisi di lapangan.</li>
            <li>Penamaan (Label) yang sesuai dengan standar penamaan <strong><i>Integrated Optical Distribution Network</i>(I-ODN)</strong> dan sama dengan yang terpasang secara fisik di lapangan.</li>
            <li>Spesifikasi Barang/Material (Perangkat Telekomunikasi) sesuai yang terpasang di lapangan.</li>
            <li>Management Core yang menjelaskan konektivitas core secara end-to-end sebagai syarat go live.</li>
        </ol>

        <p>Demikian Berita Acara Serah Terima Gambar Akhir Pelaksaan Pekerjaan (As-Built Drawing) ini dibuat dalam keadaan sebenarnya dan untuk dipergunakan sebagaimana mestinya.</p>

        <div style="height: 15px;"></div>

        <div style="page-break-inside: avoid; width: 100%">
            <table style="width: 100%;font-weight: bold" class="">
                <tr style="text-align: center; text-transform: uppercase">
                    <td style="width: 50%;">
                        {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}
                        <div style="height: 80px"></div>
                        <u>{{ $dt['dt_sp']['khs_induks']['json']['direktur'] }}</u>
                        <br>
                        DIREKTUR
                    </td>
                    <td>
                        PT. TELKOM AKSES
                        <div style="height: 80px"></div>
                        <u>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_pejabat']}}</u>
                        <br>
                        <span>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_jabatan']}}</span>
                    </td>
                </tr>
                <tr><td colspan="2" style="text-align: center">
                    <br><br>
                    Mengetahui / Menyetujui
                    <div style="height: 80px"></div>
                    <u style="text-transform: uppercase">{{$dt['dt_tagihan']['dt_ttd']['gm_ta_pejabat']}}</u>
                    <br>
                    {{$dt['dt_tagihan']['dt_ttd']['gm_ta_jabatan']}}
                </td></tr>
            </table>
        </div>
    </span>
</div>
