<div class="tab-pane {{ $tab==-2?'active':null }}">

    <div class="row">
        <div class="col-12">
            <h4 class="card-title">Data Berita Acara Serah Terima (BAST)</h4>
            <p class="card-title-desc">Lengkapi data jika anda ingin menyetujui tagihan ini.</p>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>No. Lamp Acara Uji Terima</label>
                <input type="text" wire:model="dt.dt_tagihan.no_laut" class="form-control @error('dt.dt_tagihan.no_laut') is-invalid @enderror">
                @error('dt.dt_tagihan.no_laut')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Nomor BAST</label>
                <input type="text" wire:model="dt.dt_tagihan.no_bast" class="form-control @error('dt.dt_tagihan.no_bast') is-invalid @enderror">
                @error('dt.dt_tagihan.no_bast')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Tanggal BAST</label>
                <input type="date" wire:model="dt.dt_tagihan.tgl_bast" class="form-control @error('dt.dt_tagihan.tgl_bast') is-invalid @enderror">
                @error('dt.dt_tagihan.tgl_bast')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="col-12 col-md">
            <div class="form-group">
                <label>Nomor BAUT</label>
                <input type="text" wire:model="dt.dt_tagihan.no_baut" class="form-control @error('dt.dt_tagihan.no_baut') is-invalid @enderror">
                @error('dt.dt_tagihan.no_baut')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="form-group">
                <label>Nomor BA Rekon</label>
                <input type="text" wire:model="dt.dt_tagihan.no_ba_rekon" class="form-control @error('dt.dt_tagihan.no_ba_rekon') is-invalid @enderror">
                @error('dt.dt_tagihan.no_ba_rekon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md">
            <div class="form-group">
                <label>Nomor BA Gambar</label>
                <input type="text" wire:model="dt.dt_tagihan.no_ba_gambar" class="form-control @error('dt.dt_tagihan.no_ba_gambar') is-invalid @enderror">
                @error('dt.dt_tagihan.no_ba_gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        @if ($isAmanPenutup)
            <div class="col-12 col-md">
                <div class="form-group">
                    <label>Nomor Amandemen Penutup</label>
                    <input type="text" wire:model="dt.dt_tagihan.aman_penutup" class="form-control @error('dt.dt_tagihan.aman_penutup') is-invalid @enderror">
                    @error('dt.dt_tagihan.aman_penutup')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endif

        
        

    </div>

</div>