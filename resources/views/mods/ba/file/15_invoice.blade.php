error
{{-- <div>

<strong style="font-size: 20px"><center>INVOICE</center></strong>
<div style="height: 15px"></div>

<style>
    td {
        vertical-align: top;
        padding: 5px 5px;
    }
</style>
<table style="vertical-align: top;" class="table-border">
    <tr>
        <td width="200">No. Invoice</td>
        <td width="300">{{ $tagihan['json']['no_invoice'] }}</td>
    </tr>
    <tr>
        <td width="200">Taggal</td>
        <td width="300">{{ Carbon\Carbon::parse($tagihan['json']['tgl_invoice'])->isoFormat('DD MMMM Y') }}</td>
    </tr>
    <tr>
        <td width="200">Customer</td>
        <td width="300">
            PT. TELKOM AKSES <br>
            Unit Finance <br>
            Jl, S Parman Kav 8 <br>
            Jakarta Barat 11440

        </td>
    </tr>


</table>

<div style="height: 20px"></div>
<style>
    table._14 td {
        vertical-align: top;
        padding: 5px 5px;
    }
    table._14 td table td {
        border: none !important;
        vertical-align: top;
        padding: 0 !important;
    }
</style>
<table style="vertical-align: top; width: 100%" class="table-border _14">
    <tr style="text-align: center">
        <td width="30">No</td>
        <td width="70%">Deskripsi</td>
        <td>Total</td>
    </tr>

    <tr>
        <td style="text-align: center">1</td>
        <td>
            Pekerjaan : {{ $tagihan['sp_induks']['json']['nama_pekerjaan'] }} <br>
            Surat Pesanan : {{ $tagihan['sp_induks']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($tagihan['sp_induks']['tgl_sp'])->isoFormat('DD MMMM Y') }} <br>
            Amandemen Penutup : {{ $tagihan['json']['aman_penutup'] }}, Tanggal {{ Carbon\Carbon::parse($tagihan['json']['tgl_ba_rekon'])->isoFormat('DD MMMM Y') }}
            <br><br><br><br><br>
        </td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center"></td>
        <td style="text-align: center">Material</td>
        <td style="text-align: right">
            <table style="width: 100%">
                <tr>
                    <td style="text-align: left" width="20">Rp.</td>
                    <td>{{number_format($data['total_material_rekon'],0,',','.')}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="text-align: center"></td>
        <td style="text-align: center">Jasa</td>
        <td style="text-align: right">
            <table style="width: 100%">
                <tr>
                    <td style="text-align: left" width="20">Rp.</td>
                    <td>{{number_format($data['total_jasa_rekon'],0,',','.')}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="text-align: center"></td>
        <td style="text-align: center">Total</td>
        <td style="text-align: right">
            <table style="width: 100%">
                <tr>
                    <td style="text-align: left" width="20">Rp.</td>
                    <td>{{number_format($tagihan['json']['total_rekon'],0,',','.')}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="text-align: center"></td>
        <td style="text-align: center">PPN {{$data['json_sp']['json']['ppn']}}%</td>
        <td style="text-align: right">
            <table style="width: 100%">
                <tr>
                    <td style="text-align: left" width="20">Rp.</td>
                    <td>{{ number_format(($data['json_sp']['json']['ppn'])/100*$tagihan['json']['total_rekon'],0,',','.') }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="text-align: center"></td>
        <td style="text-align: center">Grand Total</td>
        <td style="text-align: right">
            <table style="width: 100%">
                <tr>
                    <td style="text-align: left" width="20">Rp.</td>
                    <td>{{number_format($data['total_rekon_ppn'],0,',','.')}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <strong>
                Terbilang |
                # {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($data['total_rekon_ppn']))}} Rupiah #
            </strong>
        </td>
    </tr>
</table>
<div>*Pembayaran dapat dilakukan melalui rekening sebagai berikut:	</div>

<div style="height: 20px"></div>
<div>
    <table style="width: 100%" class="">
        <tr>
            <td>
                Tunai/Transfer <br>
                Nama Bank : {{$data['rek']['bank']}} <br>
                Cabang : {{$data['rek']['cabang']}} <br>
                A/c. {{$data['rek']['rekening']}} <br>
                A/n.  {{$data['rek']['nama_rekening']}}
            </td>

            <td style="text-align: center; padding-right: 0px" width="250">
                Hormat Kami <br>
                {{$tagihan['mitras']['master_users']['detail']['perusahaan']}} <br>
                <div style="height: 70px"></div>
                <u>{{$tagihan['mitras']['master_users']['detail']['direktur']}}</u> <br>
                Direktur
            </td>
        </tr>
    </table>
</div>
</div> --}}
