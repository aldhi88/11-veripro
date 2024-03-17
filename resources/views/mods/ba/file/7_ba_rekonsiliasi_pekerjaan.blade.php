<div class="margin" style="text-align: justify; page-break-after: always;">
    <div>
        <center>
    
            <strong>
                BERITA ACARA REKONSILIASI PEKERJAAN <br>
                BERDASARKAN <br>
                PERJANJIAN KERJA SAMA KONTRAK HARGA SATUAN (KHS) PEKERJAAN PENGADAAN DAN/ATAU <br>
                PEMASANGAN OUTSIDE PLANT FIBER OPTIK (OSP-FO) <br>
            </strong>
            <br>
            Nomor : {{ $dt['dt_tagihan']['no_baut'] }}
    
        </center>
    </div>
    <hr>
    
    <div style="height: 15px;"></div>
    
    <div>
        <style>
            td {
                vertical-align: top;
                padding: 0px 5px;
            }
        </style>
        <table style="width: 100%; vertical-align: top;" class="table-border">
            <tr style="font-weight: bold">
                <td width="200">Pekerjaan</td>
                <td width="20" style="text-align: center">:</td>
                <td>{{ $dt['dt_sp']['json']['nama_pekerjaan'] }}</td>
            </tr>
            <tr style="font-weight: bold">
                <td>Perjanjian Kerjasama</td>
                <td style="text-align: center">:</td>
                <td>{{ $dt['dt_sp']['khs_induks']['no_kontrak']  }}, Tanggal: {{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_kontrak'])->isoFormat('D MMMM Y') }}</td>
            </tr>
            
            @if (count($dt['aman_khs'])>0)
    
                @foreach ($dt['aman_khs'] as $i=>$item)
    
                    <tr style="font-weight: bold;">
                        <td>
                            <ol style="margin: 0; padding-left: 25px;">
                                <li>No Amandemen {{$i+1}}</li>
                            </ol>
                        </td>
                        <td style="text-align: center">:</td>
                        <td>{{ $item['no_aman'] }}, Tanggal: {{ Carbon\Carbon::parse($item['tgl_aman'])->isoFormat('D MMMM Y') }}</td>
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
                            <ol style="margin: 0; padding-left: 25px;">
                                <li>No. Amandemen {{$i+1}}</li>
                            </ol>
                        </td>
                        <td style="text-align: center">:</td>
                        <td>{{ $item['no_sp'] }}, Tanggal: {{ Carbon\Carbon::parse($item['tgl_sp'])->isoFormat('D MMMM Y') }}</td>
                    </tr>
    
                @endforeach
            
            @endif
    
            
            <tr style="font-weight: bold">
                <td>Pelaksana Pekerjaan</td>
                <td style="text-align: center">:</td>
                <td>{{ $dt['dt_sp']['mitras']['master_users']['detail']['perusahaan'] }}</td>
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
                <td>{{ $dt['dt_sp']['json']['id_project'] }}</td>
            </tr>
            
        </table>
    
    </div>
    
    <div style="height: 15px;"></div>
    
    <div style="text-align: justify;">
        Pada hari ini Jumat tanggal {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('dddd') }}, tanggal {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('D')))}}, bulan {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('MMMM') }}, tahun {{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make(Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ba_rekon'])->isoFormat('Y')))}}, bertempat di Kantor Telkom Akses Area Medan, telah dilakukan rekonsiliasi terhadap pelaksanaan Pekerjaan {{ $dt['dt_sp']['json']['nama_pekerjaan'] }}, antara PT. TELKOM AKSES selanjutnya disebut TELKOM AKSES dengan {{ $dt['dt_sp']['mitras']['master_users']['detail']['perusahaan'] }} selanjutnya disebut MITRA, dengan kesepakatan sebagai berikut: 
    </div>
    
    <div style="height: 15px;"></div>
    
    <div>
        <ol style="padding-left: 15px">
            <li>
                <strong>Obyek Rekonsiliasi</strong> <br>
                Lingkup Rekonsiliasi ini meliputi  : <br>
                <span>
                    <div>
                        <table class="table-border" style="width: 100%">
                            <tr style="text-align: center">
                                <td width="50">No</td>
                                <td>Lokasi</td>
                                <td>STO</td>
                                <td>Keterangan</td>
                                
                            </tr>
                    
                            @foreach ($dt['dt_tagihan']['dt_lokasi'] as $i=>$item)
                                <tr style="text-align: center">
                                    <td>{{$i+1}}</td>
                                    <td>{{$item['nama_lokasi']}}</td>
                                    <td>{{$item['nama_sto']}}</td>
                                    <td>-</td>
                                </tr>
                            @endforeach
                            
                        </table>
                    </div>
                </span>
            </li>
            <li style="padding-top: 20px">
                <strong>Hasil Rekonsiliasi</strong> <br>
                <ol type="a." style="padding-left: 15px">
                    <li>
                        Lingkup Pekerjaan (SoW) <br>
                        TELKOM AKSES dan Mitra sepakat bahwa lingkup pekerjaan (SoW) berdasarkan hasil Rekonsiliasi pekerjaan dimaksud adalah sebagaimana BoQ detail terlampir.
                    </li>
                    <li>
                        Harga Borongan <br>
                        TELKOM AKSES dan Mitra sepakat bahwa harga borongan berdasarkan hasil rekonsiliasi tahap I pekerjaan dimaksud (belum termasuk PPN {{$dt['dt_sp']['json']['ppn']}}%) adalah sebesar Rp . {{number_format($dt['dt_tagihan']['grand_total_all_rekon'],0,',','.')}},00 ({{ucwords(Riskihajar\Terbilang\Facades\Terbilang::make($dt['dt_tagihan']['grand_total_all_rekon']))}} Rupiah) dengan rincian sebagai berikut:
                    </li>
                </ol>
                 
            </li>
        </ol>
    </div>

    <table class="table-border" style="width: 100%">
        <tr style="text-align: center">
            <td width="50">No</td>
            <td>Deskripsi</td>
            <td>Rp</td>
        </tr>
        <tr>
            <td style="text-align: center">1</td>
            <td>Harga Borongan Berdasarkan Surat Pesanan <br>
                {{ $dt['dt_sp']['no_sp'] }}, Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }}
                <ol type="a" style="padding-left: 0; list-style-position: inside">
                    <li>Material</li>
                    <li>Jasa</li>
                    <li><strong>TOTAL NILAI</strong></li>
                </ol>
            </td>
            <td style="vertical-align: bottom; text-align: right">
                <ol style="padding-left: 0; list-style-position: inside; list-style-type: none">
                    <li>{{number_format($dt['dt_sp']['json']['grand_total_material'],0,',','.')}}</li>
                    <li>{{number_format($dt['dt_sp']['json']['grand_total_jasa'],0,',','.')}}</li>
                    <li>{{number_format($dt['dt_sp']['json']['grand_total_all'],0,',','.')}}</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td style="text-align: center">1</td>
            <td><strong>Pekerjaan Tambah Rekon</strong> <br>
                <ol type="a" style="padding-left: 0; list-style-position: inside">
                    <li>Material</li>
                    <li>Jasa</li>
                    <li><strong>TOTAL NILAI</strong></li>
                </ol>
            </td>
            <td style="vertical-align: bottom; text-align: right">
                <ol style="padding-left: 0; list-style-position: inside; list-style-type: none">
                    <li>{{number_format($dt['dt_sp']['json']['grand_total_material'],0,',','.')}}</li>
                    <li>{{number_format($dt['dt_sp']['json']['grand_total_jasa'],0,',','.')}}</li>
                    <li>{{number_format($dt['dt_sp']['json']['grand_total_all'],0,',','.')}}</li>
                </ol>
            </td>
        </tr>
    </table>
    
    
    {{-- <div style="text-align: justify;">
        <ol style="padding-left: 15px;">
            <li>
                Berdasarkan hasil pemeriksaan yang dilaksanakan pada tanggal <span>{{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_nodin'])->isoFormat('D MMMM Y') }}</span>, oleh Tim Uji Terima terhadap Pekerjaan {{ $dt['dt_sp']['json']['nama_pekerjaan'] }} yang dilaksanakan oleh {{ $dt['dt_sp']['mitras']['master_users']['detail']['perusahaan'] }} berdasarkan Perjanjian Kerjasama Pekerjaan Pengadaan dan Pemasangan Outside Plant Fiber Optik (OSP-FO), Nomor: {{ $dt['dt_sp']['khs_induks']['no_kontrak']  }}, tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['khs_induks']['tgl_kontrak'])->isoFormat('D MMMM Y') }}, Surat Pesanan Nomor: {{ $dt['dt_sp']['no_sp'] }}, tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('D MMMM Y') }}
            </li>
    
            <li>
                Bahwa Pekerjaan tersebut diatas dinyatakan TELAH sesuai dengan spesifikasi teknis yang ditentukan di dalam Perjanjian Perjanjian Kerjasama Pekerjaan Pengadaan Barang dan Jasa Pemasangan Outside Plant Fiber Optik (OSP-FO) serta Surat Pesanan, dan dinyatakan:
                <br>
                <strong><center>DITERIMA / <del>DITOLAK</del></center></strong>
            </li>
    
            <li>
                Apabila berdasarkan Uji Terima terdapat penggantian dan/atau perbaikan, maka penggantian dan/atau perbaikan tersebut dituangkan pada Lembar Catatan Hasil Uji Terima dalam Lampiran Berita Acara Uji Terima ini dan wajib diperbaiki secepatnya.
            </li>
        </ol>
    </div> --}}
    
    
    {{-- <div>
        <table style="width: 100%; vertical-align: top; text-align:center; font-weight: bold;" class="table-border">
            <tr>
                <td style="width: 50%">
                    {{ $dt['dt_sp']['mitras']['master_users']['detail']['perusahaan'] }}
                    <div style="height: 100px"></div>
                    <u>{{ $dt['dt_sp']['mitras']['master_users']['detail']['direktur'] }}</u>
                    <br>
                    DIREKTUR
                </td>
                <td>
                    PT. TELKOM AKSES
                    <div style="height: 100px"></div>
                    <u>{{$data['unit_sm']['nama']}}</u>
                    <br>
                    <span>{{$data['unit_sm']['jabatan']}}</span>
                </td>
            </tr>
    
            <tr>
                <td colspan="2" style="padding: 5px;">Mengetahui/Menyetujui</td>
            </tr>
    
            <tr>
                <td>
                    PT. TELKOM AKSES
                    <div style="height: 100px"></div>
                    <u>{{$data['unit_mgr']['nama']}}</u>
                    <br>
                    <span>{{$data['unit_mgr']['jabatan']}}</span>
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
    </div> --}}
</div>