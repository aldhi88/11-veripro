<div class="tab-pane {{ $tab==-3?'active':null }}">
    <div class="row">
        <div class="col-12">
            <h4 class="card-title">Informasi Pembayaran</h4>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>No. Surat Permohonan Pembayaran</label>
                <input type="text" wire:model="dt.dt_tagihan.no_bayar" class="form-control @error('dt.dt_tagihan.no_bayar') is-invalid @enderror">
                @error('dt.dt_tagihan.no_bayar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>Tgl. Surat Permohonan Pembayaran</label>
                <input type="date" wire:model="dt.dt_tagihan.tgl_bayar" class="form-control @error('dt.dt_tagihan.tgl_bayar') is-invalid @enderror">
                @error('dt.dt_tagihan.tgl_bayar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>No. Invoice</label>
                <input type="text" wire:model="dt.dt_tagihan.no_invoice" class="form-control @error('dt.dt_tagihan.no_invoice') is-invalid @enderror">
                @error('dt.dt_tagihan.no_invoice')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>Tgl. Invoice</label>
                <input type="date" wire:model="dt.dt_tagihan.tgl_invoice" class="form-control @error('dt.dt_tagihan.tgl_invoice') is-invalid @enderror">
                @error('dt.dt_tagihan.tgl_invoice')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>No. Kwitansi</label>
                <input type="text" wire:model="dt.dt_tagihan.no_kwitansi" class="form-control @error('dt.dt_tagihan.no_kwitansi') is-invalid @enderror">
                @error('dt.dt_tagihan.no_kwitansi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>Tgl. Kwitansi</label>
                <input type="date" wire:model="dt.dt_tagihan.tgl_kwitansi" class="form-control @error('dt.dt_tagihan.tgl_kwitansi') is-invalid @enderror">
                @error('dt.dt_tagihan.tgl_kwitansi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
    </div>
</div>