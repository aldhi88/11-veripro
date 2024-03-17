<div>
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        <div class="col text-right">
            <a href="{{ route('account.mitra') }}" class="btn btn-success btn-sm">Data Mitra</a>
            <a href="{{ route('account.mitraPending') }}" class="btn btn-success btn-sm">Persetujuan Data Mitra</a>
        </div>
    </div>
    <hr>
    <div class="row">
        
        <div class="col col-md-4">
            <form wire:submit="submit">

            <div class="form-group">
                <label>ID Pengguna</label>
                <input autofocus type="text" readonly disabled wire:model="username" class="bg-light form-control @error('username') is-invalid @enderror">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Ubah Sandi Login</label>
                <input type="text" wire:model.lazy="password" placeholder="Biarkan kosong jika tidak ingin merubah" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>

        </form>

        </div>
    </div>
</div>
