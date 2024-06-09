<div class="margin" style="text-align: justify; page-break-after: always;">

    <div>
        <center>

            <strong>
                AMANDEMEN PENUTUP <br>
                PERJANJIAN KERJA SAMA KONTRAK HARGA SATUAN (KHS)  <br>
                PEKERJAAN PENGADAAN DAN/ATAU PEMASANGAN <br>
                OUTSIDE PLANT FIBER OPTIK (OSP-FO)
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
        <table style="width: 100%; vertical-align: top;">
            <tr style="font-weight: bold">
                <td width="100">PEKERJAAN</td>
                <td width="10">:</td>
                <td>{{ $dt['dt_sp']['nama_pekerjaan'] }}</td>
            </tr>
            <tr style="font-weight: bold">
                <td>REGIONAL</td>
                <td>:</td>
                <td>SUMATERA</td>
            </tr>
            <tr style="font-weight: bold">
                <td>WITEL</td>
                <td>:</td>
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

    <div>
        <style>
            table.duabelas td {
                vertical-align: middle;
                padding: 15px 5px;
            }

            table.duabelas td table td {
                vertical-align: top;
                padding: 0;
                border: none;
            }
        </style>
        <table class="duabelas table-border" style="width: 100%; vertical-align: top;">
            <tr>
                <td style="text-align: center;">
                    <strong>I. ADMINISTRASI</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="font-weight: bold">
                        <tr>
                            <td width="250">1. Nomor Amandemen</td>
                            <td width="20">:</td>
                            <td>{{$dt['dt_tagihan']['aman_penutup']}}</td>
                        </tr>
                        <tr>
                            <td width="250">2. Tanggal Penerbitan</td>
                            <td width="20">:</td>
                            <td>{{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('D MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <td width="250">3. Para Pihak</td>
                            <td width="20">:</td>
                            <td>
                                PT. TELKOM AKSES (Selanjutnya disebut Telkom Akses) <br>
                                {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }} (selanjutnya disebut MITRA)
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <strong> II. SYARAT-SYARAT DAN KETENTUAN UMUM</strong>
                </td>
            </tr>
            <tr>
                <td>
                    <ol type="a" style="padding-left: 1rem">
                        <li>
                            Perjanjian Kerjasama Kontrak Harga Satuan (KHS) Pekerjaan Pengadaan dan Pemasangan Outside Plant Fiber Optik (OSP-FO) Nomor : {{ $dt['dt_sp']['khs_induks']['no'] }}, tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_berlaku'])->isoFormat('D MMMM Y') }} antara PT. TELKOM AKSES dan {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}.
                        </li>

                        @if (count($dt['aman_khs'])>0)

                            @foreach ($dt['aman_khs'] as $i=>$item)

                                <li>Amandemen {{$i+1}} Perjanjian Kerja Sama Kontrak Harga Satuan (KHS) Pekerjaan
                                @if ($dt['dt_sp']['master_units']['nama']=="QE")
                                    Maintenance/Quality Assurance ({{$dt['dt_sp']['master_units']['nama']}})
                                @else
                                    Pengadaan dan Pemasangan Outside Plant Fiber Optik ({{$dt['dt_sp']['master_units']['nama']}})
                                @endif
                                    Nomor : {{ $item['no'] }} Tanggal {{ Carbon\Carbon::parse($item['tgl_berlaku'])->isoFormat('D MMMM Y') }}</li>

                            @endforeach

                        @endif

                        <li>
                            Surat Pesanan Nomor : {{ $dt['dt_sp']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('D MMMM Y') }} Perihal Pekerjaan {{$dt['dt_sp']['nama_pekerjaan']}}.
                        </li>

                        @if (count($dt['aman_sp'])>0)

                            @foreach ($dt['aman_sp'] as $i=>$item)

                                <li>Amandemen {{$i+1}} Surat Pesanan Nomor : {{ $item['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('D MMMM Y') }}</li>

                            @endforeach

                        @endif

                        <li>
                            Bahwa TELKOM AKSES dan MITRA telah melaksanakan perhitungan realisasi Pekerjaan {{$dt['dt_sp']['nama_pekerjaan']}} sebagaimana telah dituangkan dalam Berita Acara Rekonsiliasi tanggal {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('D MMMM Y') }}.
                        </li>
                    </ol>

                </td>
            </tr>

            <tr>
                <td style="text-align: center;">
                    <strong> III. PENYEBAB PERUBAHAN</strong>
                </td>
            </tr>
            <tr>
                <td>
                    Setelah dilakukan perhitungan Realisasi Pekerjaan {{$dt['dt_sp']['nama_pekerjaan']}} terdapat pekerjaan Tambah dan Kurang.
                </td>
            </tr>

            <tr>
                <td style="text-align: center;">
                    <strong>IV. HAL-HAL LAIN YANG DISEPAKATI DALAM SURAT PESANAN INI</strong>
                </td>
            </tr>
            <tr>
                <td>
                    TELKOM AKSES dan MITRA sepakat merubah harga borongan yang tertuang dalam Surat Pesanan Nomor : {{ $dt['dt_sp']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('D MMMM Y') }} dan
                    @if (count($dt['aman_sp'])>0)

                        @foreach ($dt['aman_sp'] as $i=>$item)
                            Amandemen {{$i+1}} surat pesanan nomor: {{ $item['no_sp'] }}, {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('D MMMM Y') }}
                        @endforeach

                    @endif

                    @php
                        $ppn = $dt['dt_sp']['ppn']/100;
                        $ppnSp = $dt['dt_tagihan']['dt_lokasi']['grand_total']*$ppn;
                        $ppnRekon = $dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']*$ppn;
                    @endphp


                    adalah sebesar Rp. {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total']+$ppnSp,0,',','.')}},- ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(($dt['dt_tagihan']['dt_lokasi']['grand_total']+$ppnSp)))}} Rupiah) sudah termasuk PPN {{$dt['dt_sp']['ppn']}}%. Berdasarkan Berita Acara Rekonsiliasi Tahap Akhir tanggal {{Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('D MMMM Y')}} maka terjadi perubahan Harga Borongan Pekerjaan menjadi Rp. {{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']+$ppnRekon,0,',','.')}},- ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']+$ppnRekon)))}} Rupiah) sudah termasuk PPN {{$dt['dt_sp']['ppn']}}%.

                </td>
            </tr>

            <tr>
                <td style="text-align: center;">
                    <strong>V. PERSETUJUAN</strong>
                </td>
            </tr>
            <tr>
                <td style="text-align: left;">
                    Amandemen ini dibuat rangkat 2 (dua) asli, 1 (satu) rangkat untuk TELKOM AKSES dan 1 (satu) rangkap lainnya untuk MITRA, masing-masing sama bunyinya dan bermaterai cukup serta mempunyai kekuatan hukum yang sama setelah ditandatangani Para Pihak. <br><br>
                    Amandemen Surat Pesanan ini dibuat dengan itikad baik untuk dipatuhi dan dilaksanakan oleh Para Pihak.
                </td>
            </tr>
            <div style="page-break-inside: avoid; width: 100%">
            <tr style="text-align: center">
                <td>
                    <table style="font-weight: bold; width: 100%">
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
                                <u style="text-transform: uppercase">{{$dt['dt_tagihan']['dt_ttd']['gm_ta_pejabat']}}</u>
                                <br>
                                <span>GM TA MEDAN</span>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
            </div>


        </table>
    </div>

</div>


