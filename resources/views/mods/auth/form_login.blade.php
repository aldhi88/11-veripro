<div>
    <div class="text-center">
        <div>
            <a href="javascript:void(0)" class="logo"><img src="{{ asset('assets/images/veripro.png') }}" height="20" alt="logo"></a>
        </div>

        <h4 class="font-size-18 mt-0 mb-0">Selamat Datang</h4>
        <p class="text-muted">Silahkan login ke aplikasi Veripro</p>
    </div>

    <div class="p-2 mt-2">
        @if (session()->has('message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-block-helper mr-2"></i>
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        <form class="form-horizontal" wire:submit="login">

            <div class="form-group auth-form-group-custom">
                <i class="ri-user-2-line auti-custom-input-icon"></i>
                <label for="username">ID Pengguna</label>
                <input autofocus type="text" class="form-control @error('username') is-invalid @enderror" wire:model="username" placeholder="Ketik ID login anda..">
                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group auth-form-group-custom">

                <i style="cursor: pointer;" wire:click="changeSeePass('{{$eyeIcon}}')" class="ri-{{$eyeIcon}} auti-custom-input-icon"></i>
                <label for="userpassword">Kata Sandi</label>
                <input type="{{$seePass}}" class="form-control @error('password') is-invalid @enderror" wire:model="password" placeholder="Ketik kata sandi anda..">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror

            </div>

            <div class="form-group auth-form-group-custom">
                <i class="ri-shield-user-line auti-custom-input-icon"></i>
                <label for="userpassword">Login Sebagai</label>
                <select wire:model="auth_role_id" class="form-control">
                    <option value="1">Pilih anda login sebagai apa..</option>
                    @foreach ($roles as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customControlInline">
                <label class="custom-control-label" for="customControlInline">Remember me</label>
            </div> --}}

            <div class="mt-4 text-center">
                <button class="btn btn-primary w-md waves-effect waves-light btn-block" type="submit">Masuk</button>
            </div>

            {{-- <div class="mt-3 text-center">
                <a href="{{ route('auth.forgot') }}" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Lupa kata sandi?</a>
            </div> --}}
        </form>
    </div>

    <div class="mt-3 text-center">
        <p>Anda mitra dan belum memiliki akun ? <a href="{{ route('auth.register') }}" class="font-weight-medium text-primary"> Daftar </a> </p>
        <p>© 2023 Veripro. Hak Cipta oleh Telkom Akses Medan</p>

    </div>
</div>
