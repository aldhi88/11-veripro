<div>
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        <div class="col text-right">
            <a href="{{ route('sp.create') }}" class="btn btn-success btn-sm">Buat SP Baru</a>
        </div>
    </div><hr>

    @if (session()->has('message'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>

    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="dt-responsive table-responsive mt-2">
                        <table id="myTable" class="table table-bordered table-striped dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center" width="10"></th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Mitra</th>
                                <th class="text-center">KHS</th>
                                <th class="text-center">Nomor SP</th>
                                <th class="text-center">Tanggal SP</th>
                                <th class="text-center">Tanggal <br> TOC</th>
                                <th class="text-center">PPN(%)</th>
                                <th class="text-center">Nama <br> Pekerjaan</th>
                                <th class="text-center">Aman <br> demen</th>


                            </tr>
                            </thead>

                            <thead id="header-filter">
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">
                                        <select name="" class="form-control form-control-sm text-center search-col-dt">
                                            <option value="">Semua</option>
                                            @foreach ($dtStatus as $key => $item)
                                                <option value="{{$key}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th class="text-center">
                                        <select style="width: 100%" class="select2 form-control form-control-sm text-center search-col-dt">
                                            <option value="">Semua</option>
                                            @foreach ($dtMitras as $item)
                                                <option value="{{$item->id}}">{{$item->master_users->nama}}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="date" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="date" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>


                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('mods.sp.atc.data_sp_atc')

</div>
