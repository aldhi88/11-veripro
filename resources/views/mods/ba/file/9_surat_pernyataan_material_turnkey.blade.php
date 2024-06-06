error
{{-- <div>
    Yang bertanda tangan di bawah ini :
    <div style="height: 15px;"></div>

    <table class="table-collapse">
        <tr>
            <td style="width: 100px">Nama</td>
            <td>:</td>
            <td>{{ $tagihan['mitras']['master_users']['detail']['direktur'] }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>Direktur</td>
        </tr>
        <tr>
            <td>Perusahaan</td>
            <td>:</td>
            <td>{{ $tagihan['mitras']['master_users']['detail']['perusahaan'] }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>Penugasan Tim Uji Terima Pekerjaan <strong>{{ $tagihan['sp_induks']['json']['nama_pekerjaan']  }}</strong></td>
        </tr>
    </table>
</div>

<div style="height: 20px"></div>

<div>

    <p style="text-align: justify">
        Menyatakan bahwa untuk pekerjaan {{ $tagihan['sp_induks']['json']['nama_pekerjaan'] }} dengan nomor Surat Pesanan : {{ $tagihan['sp_induks']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($tagihan['sp_induks']['tgl_sp'])->isoFormat('D MMMM Y') }} ada pemakaian Material dari mitra sehingga dalam pekerjaan tersebut tidak memerlukan BA QC dikarenakan tidak ada lampiran terlampir dalam TA QMS. Adapun rincian pemakaian material Mitra yang tidak bisa dibuatkan QC adalah sebagai berikut :
    </p>

</div>

<span style="color: red">
    <table class="table-border" style="width: 100%">
        <tr style="text-align: center">
            <td rowspan="2">No</td>
            <td rowspan="2">Nama Barang</td>
            <td rowspan="2">Nama Barang di <br> Alista</td>
            <td rowspan="2">Satuan</td>
            <td rowspan="2">Hasil <br> Rekon <br> Material</td>
            <td colspan="3">Pemakaian Material</td>
            <td rowspan="2">Keterangan</td>
        </tr>
        <tr style="text-align: center">
            <td>PT. <br> Telkom <br> Akses</td>
            <td>{{ $tagihan['mitras']['master_users']['detail']['perusahaan'] }}</td>
            <td>Pengembalian <br> Material</td>
        </tr>

        <tr>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
    </table>
</span>

<div style="height: 30px;"></div>
Demikian surat pernyataan ini dibuat dengan sesungguhnya dan sebenarnya untuk dapat digunakan sebagaimana mestinya.
<div style="height: 30px;"></div>

<div>
    Medan, {{ Carbon\Carbon::parse($tagihan['json']['tgl_turnkey'])->isoFormat('D MMMM Y') }}
    <table style="width: 100%; vertical-align: top; text-align:left; font-weight: bold;">
        <tr>
            <td style="width: 50%">
                {{ $tagihan['mitras']['master_users']['detail']['perusahaan'] }}
                <div style="height: 100px"></div>
                <u>{{ $tagihan['mitras']['master_users']['detail']['direktur'] }}</u>
                <br>
                DIREKTUR
            </td>
            <td>
                PT. TELKOM AKSES
                <div style="height: 100px"></div>
                <u>{{$data['unit_sm']['nama']}}</u>
                <br>
                <span>SITE MANAGER PROJECT DEPLOYMENT</span>
            </td>
        </tr>

    </table>
</div> --}}
