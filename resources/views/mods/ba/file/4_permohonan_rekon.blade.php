<div class="margin" style="text-align: justify; page-break-after: always;">
    <div>
        Medan, {{ Carbon\Carbon::parse($dt['dt_tagihan']['tgl_mohon'])->isoFormat('DD MMMM Y') }}
        <table class="table-box">
            <tr>
                <td style="width: 70px">Nomor</td>
                <td width="20">:</td>
                <td>{{ $dt['dt_tagihan']['no_mohon'] }}</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td width="20">:</td>
                <td>-</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td width="20">:</td>
                <td>Permohonan Rekon</td>
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
            Dengan Hormat, 
            <br><br>
            Sehubungan dengan Pekerjaan {{ $dt['dt_sp']['json']['nama_pekerjaan'] }} antara PT. Telkom Akses dan {{ $dt['dt_sp']['mitras']['master_users']['detail']['perusahaan'] }} dengan Surat Pesanan Nomor : {{ $dt['dt_sp']['no_sp'] }} Tanggal {{ Carbon\Carbon::parse($dt['dt_sp']['tgl_sp'])->isoFormat('DD MMMM Y') }} bahwa pekerjaan untuk lokasi :
    
            <ol>
                @foreach ($dt['dt_tagihan']['dt_lokasi'] as $item)
                    <li>{{ $item['nama_lokasi'] }}</li>
                @endforeach
            </ol>
            <br>
            Telah selesai dilaksanakan Uji Terima dan sudah dituangkan dalam Berita Acara Uji Terima Pertama. Bersama ini kami mohon agar dapat dilaksanakan Rekonsiliasi sebagai dasar Serah Terima Pekerjaan (BAST-I).
            <br><br>
            
        </p>
    
    </div>
    
    
    
    <div>
        <p>Demikianlah surat permohonan ini kami sampaikan, atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>
        <div style="height: 30px;"></div>
        <span style="text-transform: uppercase">
            <strong>{{ $dt['dt_sp']['mitras']['master_users']['detail']['perusahaan'] }}</strong>
            <div style="height: 100px"></div>
            <strong>{{ $dt['dt_sp']['mitras']['master_users']['detail']['direktur'] }}</strong>
            <br>
            DIREKTUR
        </span>
    </div>
    
</div>