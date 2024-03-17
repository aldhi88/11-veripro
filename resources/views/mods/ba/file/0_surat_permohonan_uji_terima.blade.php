<div class="margin" style="text-align: justify; page-break-after: always">
    <div>
        <strong>Medan, {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_ut'])->isoFormat('D MMMM Y') }}</strong>
        <br><br>
        
        <table class="table-no-padding" style="border-collapse: collapse">
            <tr>
                <td style="width: 70px">Nomor</td>
                <td width="20">:</td>
                <td> {{ $dt['dt_tagihan']['no_ut'] }}</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td width="20">:</td>
                <td> -</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td width="20">:</td>
                <td> Permohonan Uji Terima</td>
            </tr>
        </table>
    </div>
    
    <div style="height: 20px"></div>
    
    <div>
        Kepada <br>
        PT. Telkom Akses <br>
        Jalan Gaharu No. 1 <br>
        Medan
    </div>
    
    <div style="height: 20px"></div>
    
    <div>
        
        <p style="text-align: justify">
            Dengan Hormat, <br><br>
            Menunjuk surat pesanan pekerjaan <strong>{{ $dt['dt_sp']['json']['nama_pekerjaan'] }}</strong> antara PT. Telkom Akses dan {{ $dt['dt_sp']['mitras']['master_users']['detail']['perusahaan'] }} Nomor : <strong>{{ $dt['dt_sp']['no_sp'] }} Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }}</strong>. 
            <br><br>
            Semua progres pelaksanaan pekerjaan dilapangan saat ini kami telah menyelesaikan {{ count($dt['dt_tagihan']['dt_lokasi']) }} lokasi : <br>
    
            <ol>
                @foreach ($dt['dt_tagihan']['dt_lokasi'] as $item)
                    <li>{{ $item['nama_lokasi'] }}</li>
                @endforeach
            </ol>
            <br>
            Telah selesai dilaksanakan pekerjaan fisik di lapangan dan bersama ini kami mohon agar dapat di laksanakan Uji Terima sebagai dasar rekonsiliasi tahap akhir.
            <br><br>
            Demikianlah surat permohonan ini kami sampaikan, atas perhatian dan kerjasamanya, kami ucapkan terima kasih.
        </p>
    
    </div>
    
    <br><br><br>
        
    <div style="page-break-inside: avoid">
        Hormat kami <br>
        <strong>{{ $dt['dt_sp']['mitras']['master_users']['detail']['perusahaan'] }}</strong>
        <div style="height: 100px"></div>
        <strong>{{ $dt['dt_sp']['mitras']['master_users']['detail']['direktur'] }}</strong>
        <br>
        DIREKTUR
    </div>
    
</div>