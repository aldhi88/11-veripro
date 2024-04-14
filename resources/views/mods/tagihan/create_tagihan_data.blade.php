<div class="row">
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label>Tgl. Permohonan Uji Terima</label>
            <input type="date" wire:model="dt.dt_tagihan.tgl_ut" class="form-control @error('dt.dt_tagihan.tgl_ut') is-invalid @enderror">
            @error('dt.dt_tagihan.tgl_ut')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label>No. Permohonan Uji Terima</label>
            <input type="text" wire:model="dt.dt_tagihan.no_ut" class="form-control @error('dt.dt_tagihan.no_ut') is-invalid @enderror">
            @error('dt.dt_tagihan.no_ut')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label>Tgl. Berita Acara Uji Terima</label>
            <input type="date" wire:model="dt.dt_tagihan.tgl_baut" class="form-control @error('dt.dt_tagihan.tgl_baut') is-invalid @enderror">
            @error('dt.dt_tagihan.tgl_baut')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label>Tgl. Lamp Acara Uji Terima</label>
            <input type="date" wire:model="dt.dt_tagihan.tgl_laut" class="form-control @error('dt.dt_tagihan.tgl_laut') is-invalid @enderror">
            @error('dt.dt_tagihan.tgl_laut')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label>Tgl. Permohonan Rekon</label>
            <input type="date" wire:model="dt.dt_tagihan.tgl_mohon" class="form-control @error('dt.dt_tagihan.tgl_mohon') is-invalid @enderror">
            @error('dt.dt_tagihan.tgl_mohon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label>No. Permohonan Rekon</label>
            <input type="text" wire:model="dt.dt_tagihan.no_mohon" class="form-control @error('dt.dt_tagihan.no_mohon') is-invalid @enderror">
            @error('dt.dt_tagihan.no_mohon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label>Tgl. BA Rekon</label>
            <input type="date" wire:model="dt.dt_tagihan.tgl_ba_rekon" class="form-control @error('dt.dt_tagihan.tgl_ba_rekon') is-invalid @enderror">
            @error('dt.dt_tagihan.tgl_ba_rekon')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label>Tgl. BA Gambar</label>
            <input type="date" wire:model="dt.dt_tagihan.tgl_ba_gambar" class="form-control @error('dt.dt_tagihan.tgl_ba_gambar') is-invalid @enderror">
            @error('dt.dt_tagihan.tgl_ba_gambar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>