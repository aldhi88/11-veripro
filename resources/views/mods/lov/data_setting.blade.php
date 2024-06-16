<div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="dt-responsive table-responsive mt-2">
                        <table id="myTable" class="table table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center" width="10"></th>
                                <th class="text-center">Keyword</th>
                                <th class="text-center">Value</th>
                                <th class="text-center">Deskripsi</th>
                            </tr>
                            </thead>

                            <thead id="header-filter">
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
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

    @include('mods.lov.atc.data_setting_atc')

</div>
