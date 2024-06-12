<div class="margin" style="text-align: justify; page-break-after: always;">
    <div>
        <center>

            <strong>
                LAPORAN <br>
                UJI TERIMA KESATU (UT-I)
            </strong>
            <br>
            Nomor : {{ $dt['dt_tagihan']['no_laut'] }}

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
                <td style="width: 230px">NOMOR PERJANJIAN KERJASAMA</td>
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
    <hr>

    <div style="height: 20px"></div>

    <style>
        .satu > li{
            margin-top: 20px;
        }
    </style>
    <div style="line-height: 19px">
        <ol class="satu" type="I" style="padding-left: 25px">
            <li style="font-weight: bold;"><u>Dasar pelaksanaan Uji Terima I :</u>

                <ol style="font-weight: normal;text-align: justify">
                    <li>Perjanjian Kerjasama Kontrak Harga Satuan (KHS) Pekerjaan Pengadaan dan Pemasangan Outsite Plant Fiber Optik (OSP-FO) Nomor : {{ $dt['dt_sp']['khs_induks']['no']  }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_berlaku'])->isoFormat('DD MMMM Y') }}</li>

                    @if (count($dt['aman_khs'])>0)

                        @foreach ($dt['aman_khs'] as $i=>$item)

                            <li>Amandemen {{$i+1}} Perjanjian Kerjasama Kontrak Harga Satuan (KHS) Pekerjaan Pengadaan dan Pemasangan Outsite Plant Fiber Optik (OSP-FO) Nomor : {{ $item['no'] }}, Tanggal {{ Carbon\Carbon::parse($item['tgl_berlaku'])->isoFormat('DD MMMM Y') }}</li>

                        @endforeach

                    @endif

                    <li>Surat Pesanan Nomor : {{ $dt['dt_sp']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }}</li>
                    @if (count($dt['aman_sp'])>0)

                        @foreach ($dt['aman_sp'] as $i=>$item)

                            <li>Amandemen {{$i+1}} Surat Pesanan Nomor : {{ $item['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('DD MMMM Y') }}</li>

                        @endforeach

                    @endif
                    <li>Surat permohonan Uji Terima I dari {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }} Nomor {{ $dt['dt_tagihan']['no_ut'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ut'])->isoFormat('DD MMMM Y') }}, perihal Permohonan Uji Terima Pertama</li>
                    <li>Nota Dinas Pelaksanaan Uji Terima I  Nomor : {{ $dt['dt_tagihan']['no_nodin'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_nodin'])->isoFormat('DD MMMM Y') }}</li>
                </ol>

            </li>

            <li style="font-weight: bold;"><u>Waktu pelaksanaan Uji Terima I</u>
                <p style="font-weight: normal">Uji Terima dilaksanakan tanggal  {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }}</p>
            </li>

            <li style="font-weight: bold;"><u>Tim Uji Terima I :</u>
                <ol style="font-weight: normal">
                    <li>
                        Berdasarkan Nota Dinas Penunjukan Tim Uji Terima dan Nota Dinas Pelaksanaan Uji Terima I maka Uji Terima dilaksanakan Oleh :
                        <br>
                        <span>
                            {{$dt['dt_tagihan']['dt_ttd']['sm_unit_pejabat']}}
                            /
                            {{$dt['dt_tagihan']['dt_ttd']['sm_unit_jabatan']}}

                            <br>
                            {{$dt['dt_sp']['khs_induks']['json']['direktur']}} / DIREKTUR
                        </span>
                    </li>
                </ol>
            </li>

            <li style="font-weight: bold;"><u>Lingkup & Program Yang di Uji Terima :</u>
                <ol type="a" style="font-weight: normal">
                    <li>Visual Check
                        <ol>
                            <li>Pemeriksaan dokumentasi</li>
                            <li>Pemeriksaan material yang digunakan</li>
                            <li>Pemeriksaan performansi instalasi</li>
                        </ol>
                    </li>
                    <li>Test Fungsi / Elektrik</li>
                </ol>
            </li>

            <li style="font-weight: bold;"><u>Hasil pengujian :</u>
                <ol type="a" style="font-weight: normal">
                    <li>Visual Check
                        <ol>
                            <li>Pemeriksaan dokumentasi: <strong>Lengkap / <del>tidak lengkap</del></strong></li>
                            <li>Pemeriksaan material yang digunakan: <strong>Baik / <del>tidak baik</del></strong></li>
                            <li>Pemeriksaan performansi instalasi: <strong>Baik / <del>tidak baik</del></strong> </li>
                        </ol>
                    </li>
                    <li>Test Fungsi / Elektrik: <strong>Baik / <del>tidak baik</del></strong></li>
                </ol>
            </li>

            <li style="font-weight: bold;"><u>Penilaian</u>
                <p style="font-weight: normal">Hasil pengujian Visual check dan Test fungsi seperti tersebut diatas telah dilaksanakan sesuai persyaratan pengetesan yang berlaku di PT. Telkom Akses</p>
            </li>

            <li style="font-weight: bold;"><u>Kesimpulan :</u>
                <ol style="font-weight: normal" type="a">
                    <li>
                        @php
                            $count = count($dt['aman_sp']);
                            if($count > 0){
                                $json = $dt['aman_sp'][$count-1];
                                $json['json'] = json_decode($dt['aman_sp'][$count-1]['json'], true);
                            }else{
                                $json = $dt['dt_sp'];
                                $json['json'] = $dt['dt_sp']['json'];
                            }
                            // dd($json);
                        @endphp
                        Dari uraian diatas disimpulkan bahwa Pekerjaan {{$dt['dt_sp']['nama_pekerjaan']}}, Perjanjian Kerjasama No. {{ $dt['dt_sp']['khs_induks']['no'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_berlaku'])->isoFormat('DD MMMM Y') }}, Surat Pesanan  No. {{ $json['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($json['tgl_sp'])->isoFormat('DD MMMM Y') }}.
                        <br>
                        <strong><center>DITERIMA / <del>DITOLAK</del></center></strong>
                    </li>
                </ol>
            </li>


        </ul>

    </div>

    <div style="page-break-inside: avoid; width: 100%">
        <p>Demikian Laporan Uji Terima ini dibuat sesuai keadaan sebenarnya dan dipergunakan semestinya.</p>
        <table style="width: 100%; vertical-align: top; text-align:center; font-weight: bold; text-transform: uppercase">
            <tr>
                <td colspan="2">
                    <p style="text-align: right; text-transform: capitalize">Medan, {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_laut'])->isoFormat('DD MMMM Y') }}</p>
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}
                    <div style="height: 100px"></div>
                    <u>{{ $dt['dt_sp']['khs_induks']['json']['direktur'] }}</u>
                    <br>
                    DIREKTUR
                </td>
                <td>
                    PT. TELKOM AKSES
                    <div style="height: 100px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['sm_unit_pejabat']}}</u>
                    <br>
                    {{$dt['dt_tagihan']['dt_ttd']['sm_unit_jabatan']}}
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding: 20px; text-transform: capitalize">Mengetahui/Menyetujui</td>
            </tr>

            <tr>
                <td>
                    PT. TELKOM AKSES
                    <div style="height: 100px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_pejabat']}}</u>
                    <br>
                    {{$dt['dt_tagihan']['dt_ttd']['mgr_unit_jabatan']}}
                </td>
                <td>
                    PT. TELKOM AKSES
                    <div style="height: 100px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['gm_ta_pejabat']}}</u>
                    <br>
                    {{$dt['dt_tagihan']['dt_ttd']['gm_ta_jabatan']}}
                </td>
            </tr>
        </table>
    </div>
</div>
