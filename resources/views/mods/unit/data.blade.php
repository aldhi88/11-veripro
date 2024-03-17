<div class="row">
    <div class="col text-right">
        <a href="javascript:void(0);" class="btn btn-primary mb-2"><i class="mdi mdi-plus mr-2"></i> Tambah Data</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                

                <div class="dt-responsive table-responsive mt-2">
                    <table id="myTable" class="table table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th class="text-center" width="10"></th>
                            <th class="text-center">Unit</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Jabatan</th>
                        </tr>
                        </thead>
            
                        <thead id="header-filter">
                            <tr>
                                <th class="text-center"></th>
                                {{-- <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th> --}}
                                
                                <th>
                                    <select class="form-control form-control-sm text-center search-col-dt">
                                        <option value="Semua">Semua</option>
                                        <option value="Konstruksi">Konstruksi</option>
                                        <option value="Maintenance">Maintenance</option>
                                    </select>
                                </th>

                                <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                            </tr>
                        </thead>
                
                
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('mods.unit.atc.data_atc')