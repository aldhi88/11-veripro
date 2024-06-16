<div>
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

                    <div class="table-responsive mt-2">
                        <table id="myTable" class="small table table-bordered table-striped" style="width: 100%">
                            <thead>
                            <tr>
                                <th class="text-center" width="10"></th>
                                <th class="text-center">Tanggal <br> ToC</th>
                                <th class="text-center">Mitra</th>
                                <th class="text-center">SP</th>
                                <th class="text-center">KHS</th>
                                <th class="text-center">Jumlah <br> Lokasi</th>
                                <th class="text-center">Total SP</th>
                                <th class="text-center">Total Rekon</th>
                                <th class="text-center" width="50">Status</th>

                            </tr>
                            </thead>

                            <thead id="header-filter">
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center"></th>
                                    <th class="text-center">
                                        <input type="text" class="form-control text-center search-col-dt">
                                    </th>
                                    <th class="text-center">
                                        <input type="text" class="form-control text-center search-col-dt">
                                    </th>
                                    <th class="text-center">
                                        <input type="text" class="form-control text-center search-col-dt">
                                        {{-- <select class="select2-dt form-control text-center search-col-dt mt-1" style="width: 100%">
                                            <option value="">Semua</option>
                                            @foreach ($dtKhs as $key => $item)
                                                <option value="{{$item['no_kontrak']}}">{{$item['no_kontrak']}}</option>
                                            @endforeach
                                        </select> --}}
                                    </th>
                                    <th class="text-center"><input type="hidden" class="form-control text-center search-col-dt"></th>
                                    <th class="text-center"></th>
                                    <th class="text-center"></th>
                                    <th class="text-center">
                                        <select name="" class="form-control text-center search-col-dt">
                                            <option value="">Semua</option>
                                            @foreach ($status as $key => $item)
                                                <option value="{{$key}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                </tr>
                            </thead>


                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('mods.tagihan.atc.data_tagihan_pro_atc')

</div>
