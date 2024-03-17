<div>
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        <div class="col text-right">
            <a href="{{ route('account.index') }}" class="btn btn-success btn-sm">Semua Data</a>
            <a href="{{ route('account.create') }}" class="btn btn-success btn-sm">Data Baru</a>
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
                <input type="text" wire:model="password" placeholder="Biarkan kosong jika tidak ingin merubah" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Peran</label>
                <select wire:model.lazy="auth_role_id" class="form-control @error('auth_role_id') is-invalid @enderror">
                    <option value="">- pilih peran -</option>
                    @foreach ($roles as $item)
                        <option wire:click="genMasterUnit({{$item->id}})" value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('auth_role_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Peran</label>
                <select wire:model="master_unit_id" class="form-control @error('master_unit_id') is-invalid @enderror">
                    <option value="">- pilih unit -</option>
                    @foreach ($units as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('master_unit_id')
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
