<div>
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-success btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        <div class="col text-right">
            <a href="{{ route('account.create') }}" class="btn btn-success btn-sm">Buat Baru</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="dt-responsive table-responsive mt-2">
                        <table id="myTable" class="table table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th class="text-center" width="10"></th>
                                <th class="text-center">ID Pengguna</th>
                                <th class="text-center">Peran</th>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Tanggal <br> Terdaftar</th>
                            </tr>
                            </thead>
                
                            <thead id="header-filter">
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center">
                                        <select name="" class="form-control form-control-sm text-center search-col-dt">
                                            <option value="">Semua</option>
                                            @foreach ($role as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th class="text-center">
                                        <select name="" class="form-control form-control-sm text-center search-col-dt">
                                            <option value="">Semua</option>
                                            @foreach ($units as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @endforeach
                                        </select>
                                    </th>
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

    @include('mods.account.atc.data_account_atc')

</div>