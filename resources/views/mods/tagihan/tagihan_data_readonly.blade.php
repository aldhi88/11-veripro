<div class="tab-pane {{ $tab==1?'active':null }}">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Tgl. Uji Terima</label>
                <input disabled type="date" wire:model="dt.dt_tagihan.tgl_ut" class="bg-light form-control @error('tgl_ut') is-invalid @enderror">
                @error('tgl_ut')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>No. Uji Terima</label>
                <input disabled type="text" wire:model="dt.dt_tagihan.no_ut" class="bg-light form-control @error('no_ut') is-invalid @enderror">
                @error('no_ut')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Tgl. Berita Acara Uji Terima</label>
                <input disabled type="date" wire:model="dt.dt_tagihan.tgl_baut" class="bg-light form-control @error('tgl_baut') is-invalid @enderror">
                @error('tgl_baut')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Tgl. Laporan Acara Uji Terima</label>
                <input disabled type="date" wire:model="dt.dt_tagihan.tgl_laut" class="bg-light form-control @error('tgl_laut') is-invalid @enderror">
                @error('tgl_laut')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Tgl. Permohonan Rekon</label>
                <input disabled type="date" wire:model="dt.dt_tagihan.tgl_mohon" class="bg-light form-control @error('tgl_mohon') is-invalid @enderror">
                @error('tgl_mohon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>No. Permohonan Rekon</label>
                <input disabled type="text" wire:model="dt.dt_tagihan.no_mohon" class="bg-light form-control @error('no_mohon') is-invalid @enderror">
                @error('no_mohon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Tgl. BA Rekon</label>
                <input disabled type="date" wire:model="dt.dt_tagihan.tgl_ba_rekon" class="bg-light form-control @error('tgl_ba_rekon') is-invalid @enderror">
                @error('tgl_ba_rekon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Tgl. Turnkey</label>
                <input disabled type="date" wire:model="dt.dt_tagihan.dt_turnkey.tgl_turnkey" class="bg-light form-control @error('tgl_turnkey') is-invalid @enderror">
                @error('tgl_turnkey')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Tgl. BA Gambar</label>
                <input disabled type="date" wire:model="dt.dt_tagihan.tgl_ba_gambar" class="bg-light form-control @error('tgl_ba_gambar') is-invalid @enderror">
                @error('tgl_ba_gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
