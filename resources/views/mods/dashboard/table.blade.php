<div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="dt-responsive table-responsive mt-2">
                        <table id="myTable" class="table table-bordered table-striped dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th class="text-center" width="10"></th>
                                <th class="text-center">Status</th>
                                <th class="text-center">SP</th>
                                <th class="text-center">KHS</th>
                                <th class="text-center">Jumlah <br> Lokasi <br> SP</th>
                                <th class="text-center">Jumlah <br> Lokasi <br> Rekon</th>
                                <th class="text-center">Total SP</th>
                                <th class="text-center">Total Rekon</th>

                            </tr>
                            </thead>
                
                            <thead id="header-filter">
                                <tr>
                                    {{-- <th class="text-center"></th> --}}
                                    <th class="text-center"></th>
                                    <th class="text-center">
                                        <select name="" class="form-control form-control-sm text-center search-col-dt">
                                            <option value="">Semua</option>
                                            @foreach ($status as $key => $item)
                                                <option value="{{$key}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="hidden" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="hidden" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                    <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
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
    

    @include('mods.dashboard.atc.data_atc')
    
</div>