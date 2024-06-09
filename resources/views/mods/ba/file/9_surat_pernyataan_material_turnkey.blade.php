<div class="margin" style="text-align: justify; page-break-after: always;">

    <center>
        <u><h1>SURAT PERNYATAAN</h1></u>
    </center>

    <div style="height: 15px"></div>

    <div>
        Yang bertanda tangan di bawah ini :
        <div style="height: 15px;"></div>

        <table class="">
            <tr>
                <td style="width: 100px">Nama</td>
                <td style="width: 20px">:</td>
                <td>{{ $dt['dt_sp']['khs_induks']['json']['direktur'] }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Direktur</td>
            </tr>
            <tr>
                <td>Perusahaan</td>
                <td>:</td>
                <td>{{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top">Alamat</td>
                <td style="vertical-align: top">:</td>
                <td>{{ $dt['dt_sp']['khs_induks']['json']['alamat'] }}</td>
            </tr>
        </table>
    </div>

    <div style="height: 20px"></div>

    <div>

        <p style="text-align: justify">
            Menyatakan bahwa untuk pekerjaan <strong>{{ $dt['dt_sp']['nama_pekerjaan'] }}</strong> dengan nomor Surat Pesanan : <strong>{{ $dt['dt_sp']['no_sp'] }}</strong>, Tanggal <strong>{{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }}</strong> ada pemakaian Material dari mitra sehingga dalam pekerjaan tersebut tidak memerlukan BA QC dikarenakan tidak ada lampiran terlampir dalam TA QMS. Adapun rincian pemakaian material Mitra yang tidak bisa dibuatkan QC adalah sebagai berikut :
        </p>

    </div>

    <div style="height: 15px"></div>


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
            <tr>
                <td>PT.Telkom <br> Akses</td>
                <td>{{"NAMA MITRA"}}</td>
                <td>Pengembalian <br> Material</td>
            </tr>
        </thead>

        @foreach ($dt['dt_tagihan']['dt_gudang']['rekon'] as $i=>$item)
            @if ($item['v_back']>0)

            <tr>
                <td>{{$i+1}}</td>
                <td>{{$item['nama_barang_material']}}</td>
                <td>{{$item['nama_barang_alista']}}</td>
                <td>{{$item['gudang']}}</td>
                <td>{{$item['satuan']}}</td>
                <td>{{$item['sum_rekon']}}</td>
                <td>{{$item['v_ta']}}</td>
                <td>{{$item['v_mitra']}}</td>
                <td>{{$item['v_back']}}</td>
                <td>{{$item['ket']}}</td>
            </tr>

            @endif
        @endforeach

    </table>

    <p>Demikian surat pernyataan ini dibuat dengan sesungguhnya dan sebenarnya untuk dapat digunakan sebagaimana mestinya.</p>



    <div style="page-break-inside: avoid; width: 100%">
        <center>Medan, {{ Carbon\Carbon::parse($dt['dt_tagihan']['dt_turnkey']['tgl_turnkey'])->isoFormat('D MMMM Y') }}</center>
        <table style="width: 100%; vertical-align: top; text-align:left; font-weight: bold;">
            <tr style="text-align: center">
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
                    <u style="text-transform: uppercase">{{$dt['dt_tagihan']['dt_ttd']['waspang_pejabat']}}</u>
                    <br>
                    <span style="text-transform: uppercase">{{$dt['dt_tagihan']['dt_ttd']['waspang_jabatan']}}</span>
                </td>
            </tr>
            <tr style="text-align: center">
                <td style="width: 50%" colspan="2">
                    <span style="font-weight: normal">Mengetahui</span> <br>
                    PT. TELKOM AKSES
                    <div style="height: 100px"></div>
                    <u style="text-transform: uppercase">{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_pejabat']}}</u>
                    <br>
                    <span style="text-transform: uppercase">{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_jabatan']}}</span>
                </td>
            </tr>

        </table>
    </div>

</div>
