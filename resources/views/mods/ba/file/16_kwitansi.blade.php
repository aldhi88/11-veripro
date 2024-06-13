<div class="margin" style="text-align: justify; page-break-after: always;">

    <div style="height: 10px"></div>
    <strong style="font-size: 20px;">
        <center>
            <div style="
                border: solid black 1px;
                display: inline;
                padding: 5px 15px;
                border-radius: 5px;
            ">
                KWITANSI
            </div>
        </center>
    </strong>
    <div style="height: 15px"></div>

    <div>
        <center><strong>No</strong> {{$dt['dt_tagihan']['no_kwitansi']}}</center>
    </div>

    <div style="height: 35px"></div>

    <table style="vertical-align: top;width:100%" class="">
        <tr>
            <td width="30%">Sudah Terima dari</td>
            <td width="10">:</td>
            <td style="font-weight: bold">
                PT. TELKOM AKSES
            </td>
        </tr>
        <tr>
            <td width="30%">Uang Sebanyak</td>
            <td width="10">:</td>
            <td style="font-weight: bold">
                @php
                    $ppn = $dt['dt_sp']['ppn']/100;
                @endphp
                {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']+$ppn)))}} Rupiah
            </td>
        </tr>
        <tr>
            <td width="30%">Untuk Keperluan</td>
            <td width="10">:</td>
            <td style="font-weight: bold">
                Pekerjaan {{$dt['dt_sp']['nama_pekerjaan']}}
            </td>
        </tr>
        <tr>
            <td width="30%">Surat Pesanan</td>
            <td width="10">:</td>
            <td style="font-weight: bold">
                {{ $dt['dt_sp']['no_sp'] }}
            </td>
        </tr>
        <tr>
            <td width="30%">Amandemen Penutup</td>
            <td width="10">:</td>
            <td style="font-weight: bold">
                {{ $dt['dt_tagihan']['aman_penutup'] }}
            </td>
        </tr>
        <tr>
            <td colspan="3" style="height: 80px"></td>
        </tr>
        <tr>
            <td width="30%">Jumlah</td>
            <td width="10">:</td>
            <td style="font-weight: bold">

                <div style="
                    border: solid 1px black;
                    display: inline;
                    padding: 5px 15px;
                ">
                    Rp. {{number_format(($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']+$ppn),2,',','.')}},-
                </div>

            </td>
        </tr>



    </table>



    <div style="height: 60px"></div>
    <div>
        <table style="width: 100%" class="">
            <tr>
                <td>
                    Jakarta,  {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_kwitansi'])->isoFormat('DD MMMM Y') }}<br>
                    {{$dt['dt_sp']['khs_induks']['json']['perusahaan']}} <br>
                    <div style="height: 70px"></div>
                    <u>{{$dt['dt_sp']['khs_induks']['json']['direktur']}}</u> <br>
                    Direktur
                </td>
                <td style="text-align: center; padding-right: 0px" width="60%">

                </td>

            </tr>
        </table>
    </div>

</div>
