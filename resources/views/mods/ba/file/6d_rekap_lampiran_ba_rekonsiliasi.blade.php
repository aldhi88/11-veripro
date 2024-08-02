{{-- per desig per lokasi --}}



@foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $key=>$item)

    <div class="margin" style="text-align: justify; page-break-after: always;">

        <table style="vertical-align: top;">

            <tr style="font-weight: bold">
                <td colspan="3">REKAP LAMPIRAN BA REKONSILIASI</td>
            </tr>
            <tr style="font-weight: bold">
                <td>PEKERJAAN</td>
                <td>:</td>
                <td>{{ $dt['dt_sp']['nama_pekerjaan'] }}</td>
            </tr>
            <tr style="font-weight: bold">
                <td>LOKASI</td>
                <td>:</td>
                <td>{{ $item['nama_lokasi'] }}</td>
            </tr>
            <tr style="font-weight: bold">
                <td>ID PROJECT</td>
                <td>:</td>
                <td>{{ $item['id_project'] }}</td>
            </tr>

            <tr style="font-weight: bold">
                <td>PELAKSANA</td>
                <td>:</td>
                <td style="text-transform: uppercase">{{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}</td>
            </tr>

        </table>
        <br>

        <style>
        /* Menebalkan teks pada 5 <tr> terakhir */
        table.table-loop tr:nth-last-child(-n+5) {
                font-weight: bold;
            }
        </style>

        <table id="loopTable{{$key}}" style="width: 100%; vertical-align: top; border-collapse: collapse" class="table-border table-padding table-loop">
            <tr style="font-weight: bold; text-align: center">
                <td rowspan="2" width="30">NO</td>
                <td rowspan="2">DESIGNATOR</td>
                <td rowspan="2">URAIAN PEKERJAAN</td>
                <td rowspan="2">SATUAN</td>
                <td colspan="2">HARGA <br> SATUAN (Rp.)</td>
                <td rowspan="2">SURAT PESANAN</td>
                <td rowspan="2">REKON</td>
                <td rowspan="2">TAMBAH</td>
                <td rowspan="2">KURANG</td>
                <td colspan="2">SURAT PESANAN</td>
                <td colspan="2">NILAI REKON</td>
                <td colspan="2">NILAI TAMBAH</td>
                <td colspan="2">NILAI KURANG</td>
            </tr>

            <tr style="font-weight: bold; text-align: center">
                <td>MATERIAL</td>
                <td>JASA</td>
                <td>MATERIAL</td>
                <td>JASA</td>
                <td>MATERIAL</td>
                <td>JASA</td>
                <td>MATERIAL</td>
                <td>JASA</td>
                <td>MATERIAL</td>
                <td>JASA</td>
            </tr>



            @php
                $grand_total_material_sp = 0;
                $grand_total_material_rekon = 0;
                $grand_total_material_tambah = 0;
                $grand_total_material_kurang = 0;

                $grand_total_jasa_sp = 0;
                $grand_total_jasa_rekon = 0;
                $grand_total_jasa_tambah = 0;
                $grand_total_jasa_kurang = 0;
            @endphp

            @foreach ($item['desig_items'] as $iDtDesig=>$vDtDesig)
                @php
                    $grand_total_material_sp += $vDtDesig['total_material'];
                    $grand_total_material_rekon += $vDtDesig['total_material_rekon'];
                    $grand_total_material_tambah += $vDtDesig['total_material_tambah'];
                    $grand_total_material_kurang += $vDtDesig['total_material_kurang'];

                    $grand_total_jasa_sp += $vDtDesig['total_jasa'];
                    $grand_total_jasa_rekon += $vDtDesig['total_jasa_rekon'];
                    $grand_total_jasa_tambah += $vDtDesig['total_jasa_tambah'];
                    $grand_total_jasa_kurang += $vDtDesig['total_jasa_kurang'];

                @endphp
                <tr>
                    <td style="text-align: center">{{$iDtDesig+1}}</td>
                    <td style="text-align: left">
                        @php
                            $combined = [];

                            if (!is_null($vDtDesig['nama_material'])) {
                                $combined[] = $vDtDesig['nama_material'];
                            }
                            if (!is_null($vDtDesig['nama_jasa'])) {
                                $combined[] = $vDtDesig['nama_jasa'];
                            }
                            if (!is_null($vDtDesig['nama_designator'])) {
                                $combined[] = $vDtDesig['nama_designator'];
                            }

                            echo implode(", ", $combined);
                        @endphp
                    </td>
                    <td style="text-align: left">{{ $vDtDesig['uraian'] }}</td>
                    <td style="text-align: center">{{ $vDtDesig['satuan'] }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['material'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['jasa'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['vol'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['volume_rekon'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['volume_tambah'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['volume_kurang'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['total_material'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['total_jasa'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['total_material_rekon'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['total_jasa_rekon'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['total_material_tambah'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['total_material_kurang'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['total_jasa_tambah'],0,',','.') }}</td>
                    <td style="text-align: right">{{ number_format($vDtDesig['total_jasa_kurang'],0,',','.') }}</td>
                </tr>
            @endforeach

            @php
                $grand_total_material_jasa_sp = $grand_total_material_sp+$grand_total_jasa_sp;
                $grand_total_material_jasa_rekon = $grand_total_material_rekon+$grand_total_jasa_rekon;
                $grand_total_material_jasa_tambah = $grand_total_material_tambah+$grand_total_jasa_tambah;
                $grand_total_material_jasa_kurang = $grand_total_material_kurang+$grand_total_jasa_kurang;

                $ppn = $dt['dt_sp']['ppn']/100;
                $grand_total_material_jasa_sp_ppn = $grand_total_material_jasa_sp*$ppn;
                $grand_total_material_jasa_rekon_ppn = $grand_total_material_jasa_rekon*$ppn;
                $grand_total_material_jasa_tambah_ppn = $grand_total_material_jasa_tambah*$ppn;
                $grand_total_material_jasa_kurang_ppn = $grand_total_material_jasa_kurang*$ppn;

                $grand_total_material_jasa_sp_ppn_total = $grand_total_material_jasa_sp_ppn+$grand_total_material_jasa_sp;
                $grand_total_material_jasa_rekon_ppn_total = $grand_total_material_jasa_rekon_ppn+$grand_total_material_jasa_rekon;
                $grand_total_material_jasa_tambah_ppn_total = $grand_total_material_jasa_tambah_ppn+$grand_total_material_jasa_tambah;
                $grand_total_material_jasa_kurang_ppn_total = $grand_total_material_jasa_kurang_ppn+$grand_total_material_jasa_kurang;

            @endphp

            {{-- material --}}
            <tr style="text-align: right">
                <td colspan="3" style="text-align: left">MATERIAL</td>
                <td></td><td></td><td></td>
                <td>{{number_format($grand_total_material_sp,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_rekon,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_tambah,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_kurang,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_sp,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_rekon,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_tambah,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_kurang,0,',','.')}}</td>
                <td></td>
            </tr>
            {{-- jasa --}}
            <tr style="text-align: right">
                <td colspan="3" style="text-align: left">JASA</td>
                <td></td><td></td><td></td>
                <td>{{number_format($grand_total_jasa_sp,0,',','.')}}</td>
                <td>{{number_format($grand_total_jasa_rekon,0,',','.')}}</td>
                <td>{{number_format($grand_total_jasa_tambah,0,',','.')}}</td>
                <td>{{number_format($grand_total_jasa_kurang,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_jasa_sp,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_jasa_rekon,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_jasa_tambah,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_jasa_kurang,0,',','.')}}</td>
            </tr>
            {{-- material+jasa --}}
            <tr style="text-align: right">
                <td colspan="3" style="text-align: left">TOTAL MATERIAL+JASA</td>
                <td></td><td></td><td></td>
                <td>{{number_format($grand_total_material_jasa_sp,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_jasa_rekon,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_jasa_tambah,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_jasa_kurang,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_jasa_sp,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_jasa_rekon,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_jasa_tambah,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_jasa_kurang,0,',','.')}}</td>
            </tr>
            {{-- ppn --}}
            <tr style="text-align: right">
                <td colspan="3" style="text-align: left">PPN {{$dt['dt_sp']['ppn']}}%</td>
                <td></td><td></td><td></td>
                <td>{{number_format($grand_total_material_jasa_sp_ppn,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_jasa_rekon_ppn,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_jasa_tambah_ppn,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_jasa_kurang_ppn,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_jasa_sp_ppn,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_jasa_rekon_ppn,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_jasa_tambah_ppn,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_jasa_kurang_ppn,0,',','.')}}</td>
            </tr>
            {{-- total ppn --}}
            <tr style="text-align: right">
                <td colspan="3" style="text-align: left">TOTAL HARGA</td>
                <td></td><td></td><td></td>
                <td>{{number_format($grand_total_material_jasa_sp_ppn_total,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_jasa_rekon_ppn_total,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_jasa_tambah_ppn_total,0,',','.')}}</td>
                <td>{{number_format($grand_total_material_jasa_kurang_ppn_total,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_jasa_sp_ppn_total,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_jasa_rekon_ppn_total,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_jasa_tambah_ppn_total,0,',','.')}}</td>
                <td></td>
                <td>{{number_format($grand_total_material_jasa_kurang_ppn_total,0,',','.')}}</td>
            </tr>


        </table>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = document.getElementById("loopTable{{$key}}");
            const maxWidth = 1047; // Lebar maksimum yang diizinkan dalam piksel
            const tableWidth = table.offsetWidth;

            if (tableWidth > maxWidth) {
                const scale = maxWidth / tableWidth;
                table.style.transformOrigin = "top left";
                table.style.transform = `scale(${scale})`;
            }

            console.log(`Loop Table {{$key}} width: ${tableWidth}px`);
        });
    </script>


@endforeach

