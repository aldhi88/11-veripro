<div class="tab-pane {{ $tab==-2?'active':null }}">

    <div class="row">
        <div class="col-12">
            <h4 class="card-title">Data Berita Acara Serah Terima (BAST)</h4>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>No. Lamp Acara Uji Terima</label>
                <input type="text" readonly value="{{$dt['dt_tagihan']['no_laut']}}" class="bg-light form-control">
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Nomor BAST</label>
                <input type="text" readonly value="{{$dt['dt_tagihan']['no_bast']}}" class="bg-light form-control">
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Tanggal BAST</label>
                <input type="date" readonly value="{{$dt['dt_tagihan']['tgl_bast']}}" class="bg-light form-control">
            </div>
        </div>
        
        <div class="col-12 col-md">
            <div class="form-group">
                <label>Nomor BAUT</label>
                <input type="text" readonly value="{{$dt['dt_tagihan']['no_baut']}}" class="bg-light form-control">
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="form-group">
                <label>Nomor BA Rekon</label>
                <input type="text" readonly value="{{$dt['dt_tagihan']['no_ba_rekon']}}" class="bg-light form-control">
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="form-group">
                <label>Nomor BA Gambar</label>
                <input type="text" readonly value="{{$dt['dt_tagihan']['no_ba_gambar']}}" class="bg-light form-control">
            </div>
        </div>

        @if ($isAmanPenutup)
            <div class="col-12 col-md">
                <div class="form-group">
                    <label>Nomor Amandemen Penutup</label>
                    <input type="text" readonly value="{{$dt['dt_tagihan']['aman_penutup']}}" class="bg-light form-control">
                </div>
            </div>
        @endif

    </div>

</div>