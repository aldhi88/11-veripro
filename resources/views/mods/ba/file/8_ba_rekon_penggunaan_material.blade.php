<div class="margin" style="text-align: justify; page-break-after: always;">
    <div>
        <center>
            <strong>
                BERITA ACARA REKONSILIASI PENGGUNAAN BARANG/MATERIAL <br>
                (PERANGKAT TELEKOMUNIKASI) <br>
                BERDASARKAN <br>
                PERJANJIAN KERJA SAMA KONTRAK HARGA SATUAN (KHS) PEKERJAAN
                @if ($dt['dt_sp']['master_units']['nama']=="QE")
                    MAINTENANCE/QUALITY ASSURANCE ({{$dt['dt_sp']['master_units']['nama']}})
                @else
                    PENGADAAN DAN/ATAU PEMASANGAN OUTSIDE PLANT FIBER OPTIK ({{$dt['dt_sp']['master_units']['nama']}})
                @endif
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
                @php
                    $byMitra = false;
                    $byTa = false;
                @endphp
                @foreach ($dt['dt_tagihan']['dt_gudang']['rekon'] as $i=>$item)
                @php
                    if($item['v_ta']>0){
                        $byTa = true;
                    }
                    if($item['v_mitra']>0){
                        $byMitra = true;
                    }

                    if($byTa && $byMitra){
                        $by = "PT. Telkom Akses dan Mitra";
                    }else if($byTa && !$byMitra){
                        $by = "PT. Telkom Akses";
                    }else if(!$byTa && $byMitra){
                        $by = "Mitra";
                    }else{
                        $by = "PT. Telkom Akses";
                    }
                @endphp
                @endforeach
                <td>Jumlah seluruh Material yang digunakan dalam pelaksanaan Pekerjaan {{ $dt['dt_sp']['nama_pekerjaan'] }}, pengadaannya oleh {{$by}}</td>
            </tr>
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
        </table>
        <table class="table-border" style="width: 100%">
            <thead style="font-weight: bold">
                <tr style="text-align: center">
                    <td rowspan="2" width="50">No</td>
                    <td rowspan="2">Nama Barang</td>
                    <td rowspan="2">Nama Barang di Alista</td>
                    <td rowspan="2">Gudang</td>
                    <td rowspan="2">Satuan</td>
                    <td rowspan="2">Hasil <br> Rekon <br> Material</td>
                    <td colspan="3">Pemakaian Material</td>
                    <td rowspan="2">Keterangan</td>
                </tr>
                <tr style="text-align: center">
                    <td>PT.Telkom <br> Akses</td>
                    <td>{{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}</td>
                    <td>Pengembalian <br> Material</td>
                </tr>
            </thead>

            @foreach ($dt['dt_tagihan']['dt_gudang']['rekon'] as $i=>$item)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$item['nama_barang_material']}}</td>
                    <td>{{$item['nama_barang_alista']}}</td>
                    <td style="text-align: center">{{$item['gudang']}}</td>
                    <td style="text-align: center">{{$item['satuan']}}</td>
                    <td style="text-align: center">{{$item['sum_rekon']}}</td>
                    <td style="text-align: center">{{$item['v_ta']}}</td>
                    <td style="text-align: center">{{$item['v_mitra']}}</td>
                    <td style="text-align: center">{{$item['v_back']}}</td>
                    <td>{{$item['ket']}}</td>
                </tr>
            @endforeach

        </table>

        <p>Material tersebut digunakan pada lokasi :</p>
            @foreach ($dt['dt_tagihan']['dt_gudang']['lokmat'] as $i=>$item)
             <span style="margin-left: 20px">{{$i+1}}. {{$item}}</span> <br>
            @endforeach
    </span>

    <div style="height: 15px;"></div>

    <p>
        Demikian Berita Acara Rekonsiliasi Material ini dibuat sesuai keadaan yang sebenarnya untuk dipergunakan sebagaimana mestinya.
    </p>

    <div style="height: 15px;"></div>

    <div style="page-break-inside: avoid; width: 100%">
        <table style="width: 100%;font-weight: bold" class="">
            <tr style="text-align: center; text-transform: uppercase">
                <td>
                    <span style="text-transform: capitalize">Material Usage</span> <br>
                    {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}
                    <div style="height: 80px"></div>
                    <br><u>{{ $dt['dt_sp']['khs_induks']['json']['direktur'] }}</u>
                    <br>
                    DIREKTUR
                </td>
                <td>
                    <br>
                    PT. TELKOM AKSES <br>
                    <span style="text-transform: capitalize">&nbsp;</span> <br>
                    <div style="height: 80px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['gudang_pejabat']}}</u>
                    <br>
                    <span>{{$dt['dt_tagihan']['dt_ttd']['gudang_jabatan']}}</span>
                </td>
                <td>
                    <span style="text-transform: capitalize">
                        Medan, {{Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('DD MMMM Y')}}
                    </span> <br>
                    PT. TELKOM AKSES <br>
                    <span style="text-transform: capitalize">&nbsp;</span> <br>
                    <div style="height: 80px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['waspang_pejabat']}}</u>
                    <br>
                    <span>{{$dt['dt_tagihan']['dt_ttd']['waspang_jabatan']}}</span>
                </td>
            </tr>
        </table>
        <div style="height: 25px;"></div>
        <table style="width: 100%;font-weight: bold" class="">
            <tr style="text-align: center; text-transform: uppercase">
                <td colspan="2" style="font-weight: normal; text-transform: capitalize">
                    Mengetahui / Menyetujui,
                </td>
            </tr>
            <tr style="text-align: center; text-transform: uppercase">
                <td style="width: 50%;">
                    <div style="height: 120px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_pejabat']}}</u>
                    <br>
                    <span>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_jabatan']}}</span>
                </td>
                <td>
                    <div style="height: 120px"></div>
                    <u>{{$dt['dt_tagihan']['dt_ttd']['mgr_shared_pejabat']}}</u>
                    <br>
                    <span>{{$dt['dt_tagihan']['dt_ttd']['mgr_shared_jabatan']}}</span>
                </td>
            </tr>
        </table>
    </div>

</div>
