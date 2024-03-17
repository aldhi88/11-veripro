<div>
    <center>

        <strong>
            AMANDEMEN PENUTUP <br>
            PERJANJIAN KERJA SAMA KONTRAK HARGA SATUAN (KHS)  <br>
            PEKERJAAN PENGADAAN DAN/ATAU PEMASANGAN <br>
            OUTSIDE PLANT FIBER OPTIK (OSP-FO)
        </strong>
       

    </center>
</div>
<div style="height: 15px;"></div>
<div>
    <style>
        td {
            vertical-align: top;
            padding: 0px 5px;
        }
    </style>
    <table style="width: 100%; vertical-align: top;">
        <tr style="font-weight: bold">
            <td width="100">PEKERJAAN</td>
            <td width="10">:</td>
            <td>{{ $tagihan['sp_induks']['json']['nama_pekerjaan'] }}</td>
        </tr>
        <tr style="font-weight: bold">
            <td>REGIONAL</td>
            <td>:</td>
            <td>SUMATERA</td>
        </tr>
        <tr style="font-weight: bold">
            <td>WITEL</td>
            <td>:</td>
            <td>MEDAN</td>
        </tr>
        <tr style="font-weight: bold">
            <td>ID PROJECT</td>
            <td>:</td>
            <td>{{ $tagihan['json']['json_sp']['json']['id_project'] }}</td>
        </tr>
        
    </table>

</div>
<div style="height: 15px;"></div>

<div>
    <style>
        table.duabelas td {
            vertical-align: middle;
            padding: 15px 5px;
        }

        table.duabelas td table td {
            vertical-align: top;
            padding: 0;
            border: none;
        }
    </style>
    <table class="duabelas table-border" style="width: 100%; vertical-align: top;">
        <tr>
            <td style="text-align: center;">
                <strong>I. ADMINISTRASI</strong>
            </td>
        </tr>
        <tr>
            <td>
                <table style="font-weight: bold">
                    <tr>
                        <td width="250">1. Nomor Amandemen</td>
                        <td width="20">:</td>
                        <td>{{$tagihan['json']['aman_penutup']}}</td>
                    </tr>
                    <tr>
                        <td width="250">2. Tanggal Penerbitan</td>
                        <td width="20">:</td>
                        <td>{{ Carbon\Carbon::parse($tagihan['json']['tgl_ba_rekon'])->isoFormat('D MMMM Y') }}</td>
                    </tr>
                    <tr>
                        <td width="250">3. Para Pihak</td>
                        <td width="20">:</td>
                        <td>
                            PT. TELKOM AKSES (Selanjutnya disebut Telkom Akses) <br>
                            {{ $tagihan['mitras']['master_users']['detail']['perusahaan'] }} (selanjutnya disebut MITRA)
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <strong> II. SYARAT-SYARAT DAN KETENTUAN UMUM</strong>
            </td>
        </tr>
        <tr>
            <td>
                <ol type="a" style="padding-left: 1rem">
                    <li>
                        Perjanjian Kerjasama Kontrak Harga Satuan (KHS) Pekerjaan Pengadaan dan Pemasangan Outside Plant Fiber Optik (OSP-FO) Nomor : {{ $tagihan['sp_induks']['khs_induks']['no_kontrak'] }}, tanggal {{ Carbon\Carbon::parse($tagihan['sp_induks']['khs_induks']['tgl_kontrak'])->isoFormat('D MMMM Y') }} antara PT. TELKOM AKSES dan {{ $tagihan['mitras']['master_users']['detail']['perusahaan'] }}.
                    </li>

                    @if (count($amanKhs)>0)

                        @foreach ($amanKhs as $i=>$item)

                            <li>Amandemen {{$i+1}} Perjanjian Kerja Sama Kontrak Harga Satuan (KHS) Pekerjaan Pengadaan dan Pemasangan Outside Plant Fiber Optik (OSP-FO) Nomor : {{ $item['no_aman'] }} Tanggal {{ Carbon\Carbon::parse($item['tgl_aman'])->isoFormat('D MMMM Y') }}</li>
                            
                        @endforeach
                    
                    @endif

                    <li>
                        Surat Pesanan Nomor : {{ $tagihan['sp_induks']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($tagihan['sp_induks']['tgl_sp'])->isoFormat('D MMMM Y') }} Perihal Pekerjaan {{$tagihan['json']['json_sp']['json']['nama_pekerjaan']}}.
                    </li>

                    @if (count($tagihan['sp_induks']['sp_amandemens'])>0)

                        @foreach ($tagihan['sp_induks']['sp_amandemens'] as $i=>$item)

                            <li>Amandemen {{$i+1}} Surat Pesanan Nomor : {{ $item['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('D MMMM Y') }}</li>

                        @endforeach
                    
                    @endif

                    <li>
                        Bahwa TELKOM AKSES dan MITRA telah melaksanakan perhitungan realisasi Pekerjaan {{$tagihan['json']['json_sp']['json']['nama_pekerjaan']}} sebagaimana telah dituangkan dalam Berita Acara Rekonsiliasi tanggal {{ Carbon\Carbon::parse($tagihan['json']['tgl_ba_rekon'])->isoFormat('D MMMM Y') }}.
                    </li>
                </ol>

            </td>
        </tr>

        <tr>
            <td style="text-align: center;">
                <strong> III. PENYEBAB PERUBAHAN</strong>
            </td>
        </tr>
        <tr>
            <td>
                Setelah dilakukan perhitungan Realisasi Pekerjaan {{$tagihan['json']['json_sp']['json']['nama_pekerjaan']}} terdapat pekerjaan Tambah dan Kurang.
            </td>
        </tr>

        <tr>
            <td style="text-align: center;">
                <strong>IV. HAL-HAL LAIN YANG DISEPAKATI DALAM SURAT PESANAN INI</strong>
            </td>
        </tr>
        <tr>
            <td>
                Harga Borongan <br>
                TELKOM AKSES dan MITRA sepakat merubah harga borongan yang tertuang dalam Surat Pesanan Nomor : {{ $tagihan['sp_induks']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($tagihan['sp_induks']['tgl_sp'])->isoFormat('D MMMM Y') }} dan 
                @if (count($tagihan['sp_induks']['sp_amandemens'])>0)

                    @foreach ($tagihan['sp_induks']['sp_amandemens'] as $i=>$item)
                        Amandemen {{$i+1}} surat pesanan nomor: {{ $item['no_sp'] }}, {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('D MMMM Y') }}
                    @endforeach
                
                @endif
                 
                adalah sebesar Rp. {{number_format($data['total_sp_ppn'],0,',','.')}},- ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($data['total_sp_ppn']))}} Rupiah) sudah termasuk PPN {{$data['json_sp']['json']['ppn']}}%. Berdasarkan Berita Acara Rekonsiliasi Tahap Akhir tanggal 02 Desember 2022 maka terjadi perubahan Harga Borongan Pekerjaan menjadi Rp. {{number_format($data['total_rekon_ppn'],0,',','.')}},- ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($data['total_rekon_ppn']))}} Rupiah) sudah termasuk PPN {{$data['json_sp']['json']['ppn']}}%.

            </td>
        </tr>

        <tr>
            <td style="text-align: center;">
                <strong>V. PERSETUJUAN</strong>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                Amandemen Surat Pesanan ini dibuat dengan itikad baik untuk dipatuhi dan dilaksanakan oleh Para Pihak.
            </td>
        </tr>
        <tr style="text-align: center">
            <td>
                <table style="font-weight: bold; width: 100%">
                    <tr>
                        <td>
                            {{ Str::upper($tagihan['mitras']['master_users']['detail']['perusahaan']) }}
                            <div style="height: 100px"></div>
                            <u>{{ Str::upper($tagihan['mitras']['master_users']['detail']['direktur']) }}</u>
                            <br>
                            DIREKTUR
                        </td>
                        <td>
                            PT. TELKOM AKSES
                            <div style="height: 100px"></div>
                            <u>{{$data['gm_ta']}}</u>
                            <br>
                            <span>GM TA MEDAN</span>
                        </td>
                    </tr>
            
                </table>
            </td>
        </tr>

        
    </table>
</div>

