<div>
    <div class="text-center">
        <div>
            <a href="javascript:void(0)" class="logo"><img src="{{ asset('assets/images/veripro.png') }}" height="20" alt="logo"></a>
        </div>
    
        <h4 class="font-size-18 mt-0 mb-0">Form Pendaftaran Mitra</h4>
        <p class="text-muted">Silahkan lengkapi form dibawah ini</p>
    </div>


    @if (session()->has('msg'))
        <div class="alert alert-{{session('status')}} alert-dismissible fade show" role="alert">
            
            @if (session('status') == 'success')
                <i class="mdi mdi-check-bold mr-2"></i>
            @else
                <i class="mdi mdi-block-helper mr-2"></i>
            @endif

            {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <form wire:submit="register">

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group auth-form-group-custom mb-1">
                    <i class="ri-building-4-line auti-custom-input-icon"></i>
                    <label for="username">Nama Mitra</label>
                    <input wire:model.lazy="perusahaan" type="text" class="form-control @error('perusahaan') is-invalid @enderror" id="username" placeholder="Nama perusahaan anda">
                    @error('perusahaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    
                </div>
            </div>
        
            <div class="col-12 col-md-6">
                <div class="form-group auth-form-group-custom mb-1">
                    <i class="ri-user-settings-line auti-custom-input-icon"></i>
                    <label for="username">Nama Admin</label>
                    <input wire:model.lazy="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="username" placeholder="Nama admin perusahaan">
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group auth-form-group-custom mb-1">
                    <i class="ri-user-2-fill auti-custom-input-icon"></i>
                    <label for="username">Nama Direktur</label>
                    <input wire:model.lazy="direktur" type="text" class="form-control @error('direktur') is-invalid @enderror" id="username" placeholder="Nama direktur perusahaan">
                    @error('direktur') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        
            <div class="col-12 col-md-6">
                <div class="form-group auth-form-group-custom mb-1">
                    <i class="ri-phone-line auti-custom-input-icon"></i>
                    <label for="username">Telepon</label>
                    <input wire:model.lazy="telepon" type="text" class="form-control @error('telepon') is-invalid @enderror" id="username" placeholder="Nomor telepon perusahaan">
                    @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group auth-form-group-custom mb-1">
                    <i class="ri-mail-send-line auti-custom-input-icon"></i>
                    <label for="username">Email</label>
                    <input wire:model.lazy="email" type="text" class="form-control @error('email') is-invalid @enderror" id="username" placeholder="Alamat email perusahaan">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        
            <div class="col-12 col-md-6">
                <div class="form-group auth-form-group-custom mb-1">
                    <i class="ri-map-pin-line auti-custom-input-icon"></i>
                    <label for="username">Lokasi</label>
                    <input wire:model.lazy="lokasi" type="text" class="form-control @error('lokasi') is-invalid @enderror" id="username" placeholder="Lokasi oprasional perusahaan">
                    @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <div class="form-group auth-form-group-custom">
                    <i class="ri-road-map-line auti-custom-input-icon"></i>
                    <label for="username">Alamat</label>
                    <input wire:model.lazy="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" id="username" placeholder="Alamat perusahaan">
                    @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
        
            </div>
        </div>
        
        <h5>Data Login</h5>
        
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group auth-form-group-custom mb-1">
                    <i class="ri-user-2-line auti-custom-input-icon"></i>
                    <label for="username">ID Pengguna</label>
                    <input wire:model.lazy="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="ID Login">
                    @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group auth-form-group-custom mb-1">
                    <i class="ri-lock-2-line auti-custom-input-icon"></i>
                    <label for="userpassword">Kata Sandi</label>
                    <input wire:model.lazy="password" type="password" class="form-control @error('password') is-invalid @enderror" id="username" placeholder="Sandi login">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        
            <div class="col-12 col-md-6">
                <div class="form-group auth-form-group-custom mb-1">
                    <i class="ri-lock-2-line auti-custom-input-icon"></i>
                    <label for="userpassword">Konfirmasi Kata Sandi</label>
                    <input wire:model.lazy="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="username" placeholder="Konfirmasi sandi login">
                    @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <div class="mt-4 text-center">
                    <button class="btn btn-primary w-md waves-effect waves-light btn-block" type="submit">Daftar Sekarang</button>
                </div>
            </div>
        </div>

    </form>
    
    
    
    
    <div class="mt-3 text-center">
        <p>Anda sudah memiliki akun ? <a href="{{ route('auth.login') }}" class="font-weight-medium text-primary"> Login </a> </p>
        <p>© 2023 Veripro. Hak Cipta oleh Telkom Akses Medan</p>
    </div>
</div>