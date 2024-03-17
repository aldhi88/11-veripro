<div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    
                    <div>
                        <div class="mt-4 mt-md-0 text-center">
                            <img class="img-thumbnail rounded-circle avatar-xl" alt="200x200" src="{{ $oldPhoto }}?{{rand()}}" data-holder-rendered="true">
                            <h5 class="mt-2 mb-0"></h5>
                            <span class="badge badge-soft-primary"></span>
                        </div>
                        <hr>
                        <h5 class="font-size-14 mb-3 text-muted">DATA AKUN</h5>
                        <div class="pl-2">
                            <table class="table table-sm table-borderless table-striped">
                                <tr>
                                    <td><label class="mb-0 pr-2">ID Pengguna</label></td>
                                    <td>:</td>
                                    <td>{{ $username }}</td>
                                </tr>
                                <tr>
                                    <td><label class="mb-0 pr-2">Nama</label></td>
                                    <td>:</td>
                                    <td>{{ Auth::user()->master_users->nama }}</td>
                                </tr>
                                <tr>
                                    <td><label class="mb-0 pr-2">Peran</label></td>
                                    <td>:</td>
                                    <td>{{ $account->master_users->auth_roles->name }}</td>
                                </tr>

                                @if ( 
                                        $account->master_users->auth_role_id != 1 &&
                                        $account->master_users->auth_role_id != 4
                                    )
                                    <tr>
                                        <td><label class="mb-0 pr-2">Unit</label></td>
                                        <td>:</td>
                                        <td>{{ $account->master_users->master_units->nama }}</td>
                                    </tr>
                                @endif


                            </table>
                        </div>
                    </div>
                    
    
                </div>
            </div>
        </div>
        <div class="col">
    
            <div class="card">
                <div class="card-body">
                    
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" wire:click="changeTab('info')">
                            <a class="nav-link {{$tabActive=='info'?'active':null}}" data-toggle="tab" href="#home" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Akun</span>    
                            </a>
                        </li>
                        <li class="nav-item" wire:click="changeTab('pass')">
                            <a class="nav-link {{$tabActive=='pass'?'active':null}}" data-toggle="tab" href="#profile" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Password</span>    
                            </a>
                        </li>
                        
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane {{$tabActive=='info'?'active':null}}" id="home" role="tabpanel">
                            <h5>Edit Informasi Akun</h5><hr>

                            <form wire:submit="updateInfo">

                                <div class="row">
                                    <div class="col col-md-8">
                                        <div class="form-group">
                                            <label>Nama Pengguna</label>
                                            <input type="text" wire:model.lazy="nama" class="form-control @error('nama') is-invalid @enderror">
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
            
                                        <div class="form-group">
                                            <label>Foto Baru</label>
                                            <div class="custom-file">
                                                <input accept="image/png, image/jpeg , image/jpg" wire:model.lazy="photo" type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="customFile">
                                                <label class="custom-file-label" for="customFile">Pilih file foto</label>
                                                @error('photo')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                                
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                        <button type="button" wire:click="default" class="btn btn-sm bg-light">Reset Form</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <div class="tab-pane {{$tabActive=='pass'?'active':null}}" id="profile" role="tabpanel">
                            <h5>Edit Informasi Akun</h5><hr>

                            <form wire:submit="changePass">

                                <div class="row">
                                    <div class="col col-md-8">
                                        <div class="form-group">
                                            <label>Sandi Baru</label>
                                            <input type="password" wire:model.lazy="newPass" class="form-control @error('newPass') is-invalid @enderror">
                                            @error('newPass')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Konfirmasi Sandi Baru</label>
                                            <input type="password" wire:model.lazy="newPass_confirmation" class="form-control @error('newPass_confirmation') is-invalid @enderror">
                                            @error('newPass_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                        <button type="button" wire:click="default" class="btn btn-sm bg-light">Reset Form</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        
                    </div>

                    
                    
                </div>
            </div>
    
        </div>
    </div>
    

</div>