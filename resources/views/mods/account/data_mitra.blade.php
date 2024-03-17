<div>
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        <div class="col text-right">
            <a href="{{ route('account.mitraPending') }}" class="btn btn-success btn-sm">Persetujuan Akun Mitra</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive mt-2">
                        <table id="myTable" class="small table table-bordered table-striped" style="width: 100%">
                            <thead>
                            <tr>
                                <th class="text-center" width="10"></th>
                                <th class="text-center">ID Pengguna</th>
                                <th class="text-center">Nama Admin</th>
                                <th class="text-center">Perusahaan</th>
                                <th class="text-center">Direktur</th>
                                <th class="text-center">Lokasi</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Telepon</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Tanggal <br> Terdaftar</th>
                            </tr>
                            </thead>
                
                            <thead id="header-filter">
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="date" class="form-control form-control-sm text-center search-col-dt"></th>

                                </tr>
                            </thead>
                    
                    
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('mods.account.atc.data_mitra_atc')

</div>