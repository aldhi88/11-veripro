<div class="margin" style="text-align: justify; page-break-after: always;">
    <h1 style="margin:0;padding:0">Nota Dinas</h1>
    <div>
        <table class="table-collapse">
            <tr>
                <td style="width: 100px">Nomor</td>
                <td>:</td>
                <td>{{ $dt['dt_tagihan']['no_nodin'] }}</td>
            </tr>
            <tr>
                <td>Kepada</td>
                <td>:</td>
                <td>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_pejabat']}}</td>
            </tr>
            <tr>
                <td>Dari</td>
                <td>:</td>
                <td>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_jabatan']}}</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td>Penugasan Tim Uji Terima Pekerjaan <strong>{{ $dt['dt_sp']['nama_pekerjaan']  }}</strong></td>
            </tr>
        </table>
    </div>

    <div style="height: 20px"></div>

    <div style="text-align: justify">

        <ol style="padding-left: 15px">
            <li>Menindak lanjuti:
                <ol style="padding-left: 15px" type="a">
                    <li>Perjanjian Kerja Sama Kontrak Harga Satuan (KHS) Pekerjaan Pengadaan dan Pemasangan Outside Plant Fiber Optik (OSP-FO) Nomor : <strong>{{ $dt['dt_sp']['khs_induks']['no'] }}</strong> Tanggal  <strong>{{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_berlaku'])->isoFormat('DD MMMM Y') }}.</strong></li>

                    @if (count($dt['aman_khs'])>0)

                        @foreach ($dt['aman_khs'] as $i=>$item)

                            <li>Amandemen {{$i+1}} Perjanjian Kerja Sama Kontrak Harga Satuan (KHS) Pekerjaan Pengadaan dan Pemasangan Outside Plant Fiber Optik (OSP-FO) Nomor : {{ $item['no'] }} Tanggal {{ Carbon\Carbon::parse($item['tgl_berlaku'])->isoFormat('DD MMMM Y') }}</li>

                        @endforeach

                    @endif

                    <li>Surat Pesanan Nomor : {{ $dt['dt_sp']['no_sp'] }} Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }} Perihal Pekerjaan {{ $dt['dt_sp']['nama_pekerjaan']  }}.</li>
                    @if (count($dt['aman_sp'])>0)

                        @foreach ($dt['aman_sp'] as $i=>$item)

                            <li>Amandemen {{$i+1}} Surat Pesanan Nomor : {{ $item['no_sp'] }} Tanggal {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('DD MMMM Y') }} Perihal Pekerjaan {{ json_decode($item['json'], true)['nama_pekerjaan'] }}.</li>

                        @endforeach

                    @endif
                    <li>Surat Direktur {{ $dt['dt_sp']['khs_induks']['json']['perusahaan'] }} Nomor : {{ $dt['dt_sp']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }}, Perihal : Permohonan Uji Terima Pekerjaan {{ $dt['dt_sp']['nama_pekerjaan'] }}</li>
                </ol>
            </li>

            <li>Sehubungan dengan hal tersebut di atas, Saudara Kami tunjuk sebagai Petugas Tim Uji Terima Pekerjaan {{ $dt['dt_sp']['nama_pekerjaan'] }}.</li>
            <li>Adapun tugas dan tanggung jawab Tim Uji Terima adalah sebagai berikut :
                <ol style="padding-left: 15px" type="a">
                    <li>Melaksanakan Uji Terima bersama dengan Mitra sesuai dengan Protokol Uji Terima</li>
                    <li>Melaksanakan pemeriksaan fisik, teknis dan administrasi (kesesuaian BoQ) terkait jenis material</li>
                    <li>Membuat laporan Uji Terima dan menandatangani Berita Acara Uji Terima (BAUT)</li>
                </ol>
            </li>

            <li>Demikian disampaikan agar Saudara laksanakan dengan penuh tanggung jawab.Salam 3S,DIQITAL , 6R</li>
        </ol>

    </div>

    <div style="height: 30px;"></div>

    <div style="page-break-inside: avoid">
        Medan, {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_nodin'])->isoFormat('DD MMMM Y') }}
        <div style="height: 100px"></div>
        <u>{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_pejabat']}}</u>
        <br>
        <span style="text-transform: uppercase">{{$dt['dt_tagihan']['dt_ttd']['mgr_unit_jabatan']}}</span>
    </div>
</div>

