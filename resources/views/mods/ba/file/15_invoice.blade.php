<div class="margin" style="text-align: justify; page-break-after: always;">

    <strong style="font-size: 20px">
        <center>INVOICE</center>
    </strong>
    <div style="height: 15px"></div>

    <table style="vertical-align: top;" class="table-border">
        <tr>
            <td width="200">No. Invoice</td>
            <td width="300">{{ $dt['dt_tagihan']['no_invoice'] }}</td>
        </tr>
        <tr>
            <td width="200">Taggal</td>
            <td width="300">{{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_invoice'])->isoFormat('DD MMMM Y') }}</td>
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
                Pekerjaan : {{ $dt['dt_sp']['nama_pekerjaan'] }} <br>
                Surat Pesanan : {{ $dt['dt_sp']['no_sp'] }}, Tanggal
                {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }} <br>
                Amandemen Penutup : {{ $dt['dt_tagihan']['aman_penutup'] }}, Tanggal
                {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('DD MMMM Y') }}
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
                        <td>{{ number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon'], 0, ',', '.') }}</td>
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
                        <td>{{ number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon'], 0, ',', '.') }}</td>
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
                        <td>{{ number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'], 0, ',', '.') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        @php
            $ppn = $dt['dt_sp']['ppn']/100;
        @endphp
        <tr>
            <td style="text-align: center"></td>
            <td style="text-align: center">PPN {{ $dt['dt_sp']['ppn'] }}%</td>
            <td style="text-align: right">
                <table style="width: 100%">
                    <tr>
                        <td style="text-align: left" width="20">Rp.</td>
                        <td>{{ number_format($ppn, 2, ',', '.') }}
                        </td>
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
                        <td>{{ number_format(($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']+$ppn), 2, ',', '.') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <strong>
                    Terbilang |
                    # {{ ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon']+$ppn))) }} Rupiah #
                </strong>
            </td>
        </tr>
    </table>
    <div>*Pembayaran dapat dilakukan melalui rekening sebagai berikut: </div>

    <div style="height: 20px"></div>
    <div style="page-break-inside: avoid; width: 100%">
        <table style="width: 100%" class="">
            <tr>
                <td>
                    Tunai/Transfer <br>
                    Nama Bank : {{ $dt['dt_sp']['khs_induks']['json']['bank'] }} <br>
                    Cabang : {{ $dt['dt_sp']['khs_induks']['json']['cabang'] }} <br>
                    A/c. {{ $dt['dt_sp']['khs_induks']['json']['rekening'] }} <br>
                    A/n. {{ $dt['dt_sp']['khs_induks']['json']['nama_rekening'] }}
                </td>

                <td style="text-align: center; padding-right: 0px" width="250">
                    Hormat Kami <br>
                    {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }} <br>
                    <div style="height: 70px"></div>
                    <u>{{ $dt['dt_sp']['khs_induks']['json']['direktur'] }}</u> <br>
                    Direktur
                </td>
            </tr>
        </table>
    </div>
</div>
