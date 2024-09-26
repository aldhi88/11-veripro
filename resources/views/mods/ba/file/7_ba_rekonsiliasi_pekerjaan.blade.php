<div class="margin" style="text-align: justify; page-break-after: always;">
    <div>
        <center>

            <strong>
                BERITA ACARA REKONSILIASI PEKERJAAN <br>
                BERDASARKAN <br>
                PERJANJIAN KERJA SAMA KONTRAK HARGA SATUAN (KHS) PEKERJAAN PENGADAAN DAN/ATAU <br>
                PEMASANGAN OUTSIDE PLANT FIBER OPTIK (OSP-FO) <br>
                Nomor : {{ $dt['dt_tagihan']['no_baut'] }}
            </strong>

        </center>
    </div>
    <hr>

    <div style="height: 15px;"></div>

    <div>
        <table style="width: 100%; vertical-align: top;" class="table-border">
            <tr style="font-weight: bold">
                <td width="200">Pekerjaan</td>
                <td width="20" style="text-align: center">:</td>
                <td>{{ $dt['dt_sp']['nama_pekerjaan'] }}</td>
            </tr>
            <tr style="font-weight: bold">
                <td>Perjanjian Kerjasama</td>
                <td style="text-align: center">:</td>
                <td>{{ $dt['dt_sp']['khs_induks']['no']  }}, Tanggal: {{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_berlaku'])->isoFormat('D MMMM Y') }}</td>
            </tr>
            @if (count($dt['aman_khs'])>0)

                @foreach ($dt['aman_khs'] as $i=>$item)

                    <tr style="font-weight: bold;">
                        <td style="padding-left: 20px">No Amandemen {{$i+1}}</td>
                        <td style="text-align: center">:</td>
                        <td>{{ $item['no'] }}, Tanggal: {{ Carbon\Carbon::parse($item['tgl_berlaku'])->isoFormat('D MMMM Y') }}</td>
                    </tr>

                @endforeach

            @endif

            <tr style="font-weight: bold">
                <td>Surat Pesanan</td>
                <td style="text-align: center">:</td>
                <td>{{ $dt['dt_sp']['no_sp'] }}, Tanggal: {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('D MMMM Y') }}</td>
            </tr>
            @if (count($dt['aman_sp'])>0)

                @foreach ($dt['aman_sp'] as $i=>$item)

                    <tr style="font-weight: bold;">
                        <td>
                            <ul style="list-style-type: none; margin: 0; padding-left: 25px;">
                                <li>No. Amandemen {{$i+1}}</li>
                            </ul>
                        </td>
                        <td style="text-align: center">:</td>
                        <td>{{ $item['no_sp'] }}, Tanggal: {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('D MMMM Y') }}</td>
                    </tr>

                @endforeach

            @endif


            <tr style="font-weight: bold">
                <td>Pelaksana Pekerjaan</td>
                <td style="text-align: center">:</td>
                <td>{{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}</td>
            </tr>
            <tr style="font-weight: bold">
                <td>Regional</td>
                <td style="text-align: center">:</td>
                <td>SUMATERA</td>
            </tr>
            <tr style="font-weight: bold">
                <td>Area</td>
                <td style="text-align: center">:</td>
                <td>MEDAN</td>
            </tr>
            <tr style="font-weight: bold">
                <td>ID Project</td>
                <td style="text-align: center">:</td>
                <td>
                    @php
                        $combined = [];
                        foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $key => $value) {
                            $combined[] = $value['id_project'];
                        }

                        echo implode(", ", $combined);
                    @endphp
                </td>
            </tr>

        </table>

    </div>

    <div style="height: 15px;"></div>

    <div style="text-align: justify;">
        Pada hari ini {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('dddd') }} tanggal {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('D')))}}, bulan {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('MMMM') }}, tahun {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('Y')))}}, bertempat di Kantor Telkom Akses Area Medan, telah dilakukan rekonsiliasi terhadap pelaksanaan Pekerjaan {{$dt['dt_sp']['nama_pekerjaan']}}, antara PT. TELKOM AKSES selanjutnya disebut TELKOM AKSES dengan {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }} selanjutnya disebut MITRA, dengan kesepakatan sebagai berikut:
    </div>

    <div style="height: 15px;"></div>

    {{-- 1 --}}
    <span>
        <table>
            <tr style="font-weight: bold">
                <td>1. </td>
                <td>Obyek Rekonsiliasi</td>
            </tr>
            <tr>
                <td></td>
                <td>Lingkup Rekonsiliasi ini meliputi:</td>
            </tr>
        </table>

        <table class="table-border" style="width: 100%">
            <tr style="text-align: center">
                <td width="50">No</td>
                <td>Lokasi</td>
                <td>STO</td>
                <td>Keterangan</td>

            </tr>

            @foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $i=>$item)
                <tr style="text-align: center">
                    <td>{{$i+1}}</td>
                    <td>{{$item['nama_lokasi']}}</td>
                    <td>{{$item['sto']}}</td>
                    <td>-</td>
                </tr>
            @endforeach

        </table>
    </span>

    <div style="height: 15px;"></div>

    {{-- 2 --}}
    <span>
        <table>
            <tr style="font-weight: bold">
                <td>2. </td>
                <td colspan="2">Hasil Rekonsiliasi</td>
            </tr>
            <tr>
                <td></td>
                <td><strong>a. </strong></td>
                <td>
                    <strong>Lingkup Pekerjaan (SoW)</strong> <br>
                    TELKOM AKSES dan Mitra sepakat bahwa lingkup pekerjaan (SoW) berdasarkan hasil Rekonsiliasi pekerjaan dimaksud adalah sebagaimana BoQ detail terlampir.
                </td>
            </tr>
            <tr>
                <td></td>
                <td><strong>b. </strong></td>
                <td>
                    <strong>Harga Borongan</strong> <br>
                    TELKOM AKSES dan Mitra sepakat bahwa harga borongan berdasarkan hasil rekonsiliasi tahap I pekerjaan dimaksud (belum termasuk PPN {{$dt['dt_sp']['ppn']}}%) adalah sebesar Rp. {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'],0,',','.')}},00 ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']))}} Rupiah) dengan rincian sebagai berikut:
                </td>
            </tr>
        </table>
        <div style="height: 15px;"></div>
        <table class="table-border" style="width: 100%">
            <thead style="font-weight: bold">
                <tr style="text-align: center">
                    <td width="50">No</td>
                    <td>Deskripsi</td>
                    <td>Rp.</td>
                </tr>
            </thead>

            {{-- baris 1 --}}
            <span>
                <tr>
                    <td rowspan="2"><center>1</center></td>
                    <td style="border-bottom: none">
                        Harga Borongan Berdasarkan Surat Pesanan : <br>
                        {{ $dt['dt_sp']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }} <br>
                    </td>
                    <td style="border-bottom: none"></td>
                </tr>
                <tr>
                    <td style="border-top: none">
                        a.	Material <br>
                        b.	Jasa <br>
                        c.	TOTAL NILAI <br>
                    </td>
                    <td style="border-top: none; text-align: right">
                        {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material'],0,',','.')}} <br>
                        {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa'],0,',','.')}} <br>
                        {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total'],0,',','.')}} <br>
                    </td>
                </tr>
            </span>

            {{-- baris 2 --}}
            <span>
                <tr>
                    <td rowspan="2"><center>2</center></td>
                    <td style="border-bottom: none">
                        Pekerjaan Tambah Rekon :
                    </td>
                    <td style="border-bottom: none"></td>
                </tr>
                <tr>
                    <td style="border-top: none">
                        a.	Material <br>
                        b.	Jasa <br>
                        c.	TOTAL NILAI <br>
                    </td>
                    <td style="border-top: none; text-align: right">
                        @php
                            $grand_total_material_tambah = 0;
                            $grand_total_jasa_tambah = 0;
                            foreach ($dtDesig as $key => $value) {
                                $grand_total_material_tambah += $value['total_material_tambah'];
                                $grand_total_jasa_tambah += $value['total_jasa_tambah'];
                            }
                            $grand_total_tambah = $grand_total_material_tambah+$grand_total_jasa_tambah;
                        @endphp
                        {{number_format($grand_total_material_tambah,0,',','.')}} <br>
                        {{number_format($grand_total_jasa_tambah,0,',','.')}} <br>
                        {{number_format($grand_total_tambah,0,',','.')}} <br>
                    </td>
                </tr>
            </span>

            {{-- baris 3 --}}
            <span>
                <tr>
                    <td rowspan="2"><center>3</center></td>
                    <td style="border-bottom: none">
                        Pekerjaan Kurang Rekon :
                    </td>
                    <td style="border-bottom: none"></td>
                </tr>
                <tr>
                    <td style="border-top: none">
                        a.	Material <br>
                        b.	Jasa <br>
                        c.	TOTAL NILAI <br>
                    </td>
                    <td style="border-top: none; text-align: right">
                        @php
                            $grand_total_material_kurang = 0;
                            $grand_total_jasa_kurang = 0;
                            foreach ($dtDesig as $key => $value) {
                                $grand_total_material_kurang += $value['total_material_kurang'];
                                $grand_total_jasa_kurang += $value['total_jasa_kurang'];
                            }
                            $grand_total_kurang = $grand_total_material_kurang+$grand_total_jasa_kurang;
                        @endphp
                        {{number_format($grand_total_material_kurang,0,',','.')}} <br>
                        {{number_format($grand_total_jasa_kurang,0,',','.')}} <br>
                        {{number_format($grand_total_kurang,0,',','.')}} <br>
                    </td>
                </tr>
            </span>

            {{-- baris 4 --}}
            <span>
                <tr>
                    <td rowspan="2"><center>4</center></td>
                    <td style="border-bottom: none">
                        Harga Borongan Berdasarkan Rekon :
                    </td>
                    <td style="border-bottom: none"></td>
                </tr>
                <tr>
                    <td style="border-top: none">
                        a.	Material <br>
                        b.	Jasa <br>
                        c.	TOTAL NILAI <br>
                    </td>
                    <td style="border-top: none; text-align: right">
                        @php
                            $grand_total_material_kurang = 0;
                            $grand_total_jasa_kurang = 0;
                            foreach ($dtDesig as $key => $value) {
                                $grand_total_material_kurang += $value['total_material_kurang'];
                                $grand_total_jasa_kurang += $value['total_jasa_kurang'];
                            }
                            $grand_total_kurang = $grand_total_material_kurang+$grand_total_jasa_kurang;
                        @endphp
                        {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon'],0,',','.')}} <br>
                        {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon'],0,',','.')}} <br>
                        {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'],0,',','.')}} <br>
                    </td>
                </tr>
            </span>

        </table>
    </span>

    <div style="height: 15px;"></div>

    {{-- 3 --}}
    <span>
        <table>
            <tr style="font-weight: bold">
                <td>3. </td>
                <td>Total Harga Borongan yang Telah Diterbitkan BAST-1</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    TELKOM AKSES dan MITRA sepakat bahwa nilai hasil rekonsiliasi (diluar PPN {{$dt['dt_sp']['ppn']}}%) yang telah di terbitkan BAST-1 tahap I adalah sebesar Rp0,00 (Nol rupiah)
                </td>
            </tr>
        </table>
    </span>

    <div style="height: 15px;"></div>

    {{-- 4 --}}
    <span>
        <table>
            <tr style="font-weight: bold">
                <td>4. </td>
                <td>Total Harga Borongan Hasil Rekonsiliasi yang Dapat Diterbitkan BAST-I</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    TELKOM AKSES dan MITRA sepakat bahwa nilai hasil rekonsiliasi yang dapat diterbitkan BAST-1 adalah sebesar Rp. {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'],0,',','.')}},00 ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']))}})  belum termasuk PPN {{$dt['dt_sp']['ppn']}}% dengan Rincian sebagai berikut :
                </td>
            </tr>
        </table>
        <div style="height: 15px;"></div>
        <style>

        </style>
        <table class="table-border table-hrg" style="width: 100%;font-size:90%">
            <tr style="text-align: center; font-weight: bold">
                <td width="50">NO</td>
                <td>LOKASI</td>
                <td>STO</td>
                <td>HARGA <br> MATERIAL</td>
                <td>HARGA <br> JASA</td>
                <td>JUMLAH</td>

            </tr>

            @foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $i=>$item)
                <tr style="text-align: right">
                    <td><center>{{$i+1}}</center></td>
                    <td><center>{{$item['nama_lokasi']}}</center></td>
                    <td><center>{{$item['sto']}}</center></td>
                    <td><span class="currency">Rp</span> <span>{{number_format($item['total_material_lokasi_rekon'],0,',','.')}}</span></td>
                    <td><span class="currency">Rp</span> <span>{{number_format($item['total_jasa_lokasi_rekon'],0,',','.')}}</span></td>
                    <td><span class="currency">Rp</span> <span>{{number_format($item['total_lokasi_rekon'],0,',','.')}}</span></td>
                </tr>
            @endforeach
            <tr style="text-align: right; font-weight: bold">
                <td colspan="3"><center>TOTAL</center></td>
                <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon'],0,',','.')}}</td>
                <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon'],0,',','.')}}</td>
                <td>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total'],0,',','.')}}</td>

            </tr>
        </table>
    </span>

    <div style="height: 15px;"></div>

    {{-- 5 --}}
    <span>
        <table>
            <tr style="font-weight: bold">
                <td>5. </td>
                <td>Total Harga Borongan yang Belum Dapat Diterbitkan BAST-I</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    TELKOM AKSES dan MITRA sepakat bahwa nilai yang belum dapat diterbitkan BAST-1 adalah NIHIL
                </td>
            </tr>
        </table>
    </span>

    <div style="height: 15px;"></div>

    {{-- 6 --}}
    <span>
        <table>
            <tr style="font-weight: bold">
                <td>6. </td>
                <td>Waktu Pelaksanaan Pekerjaan Yang Direkonsiliasi</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    TELKOM AKSES dan MITRA sepakat bahwa waktu pelaksanaan pekerjaan yang direkonsiliasi adalah sebagai berikut :
                </td>
            </tr>
        </table>
        <div style="height: 15px;"></div>
        <table class="table-border" style="width: 100%">
            <tr style="text-align: center; font-weight: bold">
                <td width="50">No</td>
                <td>Work Package (WP)</td>
                <td>ToC</td>
                <td>Realisasi BAUT</td>
                <td>Hari <br> Keterlambatan</td>
            </tr>

            @foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $i=>$item)
                <tr style="text-align: right">
                    <td><center>{{$i+1}}</center></td>
                    <td><center>{{$item['nama_lokasi']}}</center></td>
                    <td><center>{{Carbon\Carbon::parse($dt['dt_sp']['tgl_toc'])->isoFormat('DD MMMM Y')}}</center></td>
                    <td><center>{{Carbon\Carbon::parse($dt['dt_tagihan']['tgl_baut'])->isoFormat('DD MMMM Y')}}</center></td>
                    <td>
                    @php
                        $tglToc = Carbon\Carbon::parse($dt['dt_sp']['tgl_toc'])->format('Y-m-d');
                        $tglRealisasi = Carbon\Carbon::parse($dt['dt_tagihan']['tgl_baut'])->format('Y-m-d');
                        if ($tglToc >= $tglRealisasi) {
                            $selisihHari = "NIHIL";
                        }else{
                            $tanggal1 = Carbon\Carbon::createFromFormat('Y-m-d', $tglToc);
                            $tanggal2 = Carbon\Carbon::createFromFormat('Y-m-d', $tglRealisasi);
                            // Menghitung selisih dalam hari
                            $selisihHari = $tanggal1->diffInDays($tanggal2);
                        }
                    @endphp
                    <center>{{$selisihHari}}</center>
                    </td>
                </tr>
            @endforeach
        </table>
    </span>

    <div style="height: 15px;"></div>

    {{-- 7 --}}
    <span>
        <table>
            <tr style="font-weight: bold">
                <td>7. </td>
                <td>Kelengkapan Dokumen</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    Dokumen Test Commisioning, Uji Terima, Bill of Quantity lengkap terlampir.
                </td>
            </tr>
        </table>
    </span>

    <div style="height: 15px;"></div>

    <p>Demikian Berita Acara Rekonsiliasi ini dibuat sesuai keadaan yang sebenarnya untuk dipergunakan sebagaimana mestinya.</p>

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

</div>
