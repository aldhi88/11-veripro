<div>
    <div class="text-center">
        <div>
            <a href="javascript:void(0)" class="logo"><img src="{{ asset('assets/images/veripro.png') }}" height="20" alt="logo"></a>
        </div>
    
        <h4 class="font-size-18 mt-4">Selamat Datang</h4>
        <p class="text-muted">Silahkan login ke aplikasi Veripro</p>
    </div>
    
    <div class="p-2 mt-3">
        <div class="alert alert-warning" role="alert">
            Lakukan konfirmasi ke bagian Procurement untuk melakukan perubahan Kata Sandi
        </div>
        <form class="form-horizontal" action="index.html">
    
            <div class="form-group auth-form-group-custom">
                <i class="ri-mail-send-line auti-custom-input-icon"></i>
                <label for="username">Email</label>
                <input type="text" class="form-control" id="username" placeholder="Ketik ID login anda">
            </div>
    
            <div class="form-group auth-form-group-custom mb-1">
                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                <label for="userpassword">Kata Sandi Baru</label>
                <input type="password" class="form-control" id="userpassword" placeholder="Ketik kata sandi anda">
            </div>
            <div class="form-group auth-form-group-custom">
                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                <label for="userpassword">Konfirmasi Kata Sandi Baru</label>
                <input type="password" class="form-control" id="userpassword" placeholder="Ketik kata sandi anda">
            </div>
    
            <div class="mt-4 text-center">
                <button class="btn btn-primary w-md waves-effect waves-light btn-block" type="submit">Kirim Permintaan Reset</button>
            </div>
    
        </form>
    </div>
    
    <div class="mt-3 text-center">
        <p>
            Anda mitra dan belum memiliki akun ? <a href="{{ route('auth.register') }}" class="font-weight-medium text-primary"> Daftar </a> <br>
    
            Anda sudah memiliki akun ? <a href="{{ route('auth.login') }}" class="font-weight-medium text-primary"> Login </a>
        </p>
    
        <p>© 2023 Veripro. Hak Cipta oleh Telkom Akses Medan</p>
    </div>
</div>