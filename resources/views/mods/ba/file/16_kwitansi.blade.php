error
{{-- <div>

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
        <center><strong>No</strong> {{$tagihan['json']['no_kwitansi']}}</center>
    </div>

    <div style="height: 35px"></div>


    <style>
        td {
            vertical-align: top;
            padding: 5px 5px;
        }
    </style>
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
                {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($data['total_rekon_ppn']))}} Rupiah
            </td>
        </tr>
        <tr>
            <td width="30%">Untuk Keperluan</td>
            <td width="10">:</td>
            <td style="font-weight: bold">
                Pekerjaan {{$tagihan['sp_induks']['json']['nama_pekerjaan']}}
            </td>
        </tr>
        <tr>
            <td width="30%">Surat Pesanan</td>
            <td width="10">:</td>
            <td style="font-weight: bold">
                {{ $tagihan['sp_induks']['no_sp'] }}
            </td>
        </tr>
        <tr>
            <td width="30%">Amandemen Penutup</td>
            <td width="10">:</td>
            <td style="font-weight: bold">
                {{ $tagihan['json']['aman_penutup'] }}
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
                    Rp. {{number_format($data['total_rekon_ppn'],0,',','.')}},-
                </div>

            </td>
        </tr>



    </table>



    <div style="height: 60px"></div>
    <div>
        <table style="width: 100%" class="">
            <tr>
                <td>
                    Jakarta,  {{ Carbon\Carbon::parse($tagihan['json']['tgl_kwitansi'])->isoFormat('DD MMMM Y') }}<br>
                    {{$tagihan['mitras']['master_users']['detail']['perusahaan']}} <br>
                    <div style="height: 70px"></div>
                    <u>{{$tagihan['mitras']['master_users']['detail']['direktur']}}</u> <br>
                    Direktur
                </td>

                <td style="text-align: center; padding-right: 0px" width="250">

                </td>
            </tr>
        </table>
    </div>
    </div> --}}
