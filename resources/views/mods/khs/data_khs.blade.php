<div>
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        <div class="col text-right">
            <a href="{{ route('khs.create') }}" class="btn btn-success btn-sm">Form KHS Induk Baru</a>
            {{-- <div class="btn-group">
                <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Import <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="">
                    <a class="dropdown-item" href="#">Import File Excel</a>
                    <a class="dropdown-item" href="#">Download Sample File</a>
                </div>
            </div> --}}
        </div>
    </div><hr>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive mt-2">
                        <table id="myTable" class="small table table-bordered table-striped" style="width: 100%">
                            <thead>
                            <tr>
                                <th class="text-center" width="10"></th>
                                <th class="text-center">Mitra</th>
                                <th class="text-center">No <br> KHS</th>
                                <th class="text-center">Judul <br> KHS</th>
                                <th class="text-center" width="50">Tagggal <br> Berlaku</th>
                                <th class="text-center" width="50">Jumlah <br> Amandemen</th>
                                <th class="text-center" width="50">Jumlah <br> Designator</th>
                                
                            </tr>
                            </thead>
                
                            <thead id="header-filter">
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="date" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"></th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                    
                    
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('mods.khs.atc.data_khs_atc')

</div>