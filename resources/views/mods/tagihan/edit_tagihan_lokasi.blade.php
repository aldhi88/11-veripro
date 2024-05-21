<div>
    <div class="row">
        <div class="col">
            <div class="alert alert-warning text-center" role="alert">
                Perubahan data designator akan menghapus data gudang.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="custom-file">
                <input type="file" wire:model="formUpload.file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Upload File Lokasi Rekon</label>
            </div>
            @error('formUpload.file')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-12 col-md-2">
            <div class="form-group">
                <input type="text" readonly min="1" placeholder="jumlah lokasi" wire:model="formUpload.jumlah" class="form-control bg-light">
                @error('formUpload.jumlah')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md">
            <button type="button" wire:click="uploadLokasi" class="btn btn-success btn-block">Upload & Proses File</button>
        </div>
        <div class="col-12 col-md">
            <a href="{{ asset($dt['dt_sp']['file_lokasi']) }}" class="btn btn-danger btn-block">Download File Excel</a>
        </div>
    </div>
    @if (session()->has('msg-upload-ok'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('msg-upload-ok') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <hr>

    <h6 class="bg-secondary text-light p-1 text-center">
        <span>DATA GRAND TOTAL</span>
    </h6>
    
    <div class="row">
        <div class="col">
            <table class="w-100">
                <tr class="text-center bg-soft-success">
                    <td class="border border-success p-1 bg-success">
                        <h5 class="mb-0">SP</h5>
                    </td>
                    <td class="border border-success p-1">
                        <h4 class="card-title m-0">Jumlah Lokasi</h4>
                        <span>{{count($dt['dt_tagihan']['dt_lokasi']['lokasi'])}}</span>
                    </td>
                    <td class="border border-success p-1">
                        <h4 class="card-title m-0">Grand Total Material SP</h4>
                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material'],0,',','.')}}</span>
                    </td>
                    <td class="border border-success p-1">
                        <h4 class="card-title m-0">Grand Total Jasa SP</h4>
                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa'],0,',','.')}}</span>
                    </td>
                    <td class="border border-success p-1">
                        <h4 class="card-title m-0">Grand Total SP</h4>
                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total'],0,',','.')}}</span>
                    </td>
                </tr>
                <tr class="text-center bg-soft-warning">
                    <td class="border border-warning p-1 bg-warning">
                        <h5 class="mb-0">Rekon</h5>
                    </td>
                    <td class="border border-warning p-1">
                        <h4 class="card-title m-0">Jumlah Lokasi</h4>
                        <span>{{count($dt['dt_tagihan']['dt_lokasi']['lokasi'])}}</span>
                    </td>
                    <td class="border border-warning p-1">
                        <h4 class="card-title m-0">Grand Total Material Rekon</h4>
                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material_rekon'],0,',','.')}}</span>
                    </td>
                    <td class="border border-warning p-1">
                        <h4 class="card-title m-0">Grand Total Jasa Rekon</h4>
                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa_rekon'],0,',','.')}}</span>
                    </td>
                    <td class="border border-warning p-1">
                        <h4 class="card-title m-0">Grand Total Rekon</h4>
                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_rekon'],0,',','.')}}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <h6 class="bg-secondary text-light p-1 text-center">
        <span>DATA LOKASI</span>
    </h6>
    @foreach ($dt['dt_tagihan']['dt_lokasi']['lokasi'] as $iLok => $vLok)

        <div class="table-responsive mb-2">
            <table class="w-100">
                <tr class="text-center bg-soft-secondary">
                    <td colspan="3" class="border border-secondary p-1">
                        <h4 class="card-title m-0">Lokasi {{$iLok+1}}</h4>
                    </td>
                </tr>
                <tr class="text-center bg-soft-secondary">
                    <td class="border border-secondary p-1">
                        <h4 class="card-title m-0">Nama Lokasi</h4>
                        <span>{{$vLok['nama_lokasi']}}</span>
                    </td>
                    <td class="border border-secondary p-1">
                        <h4 class="card-title m-0">Nama STO</h4>
                        <span>{{$vLok['sto']}}</span>
                    </td>
                    <td class="border border-secondary p-1">
                        <h4 class="card-title m-0">ID Project</h4>
                        <span>{{$vLok['id_project']}}</span>
                    </td>
                </tr>
            </table>
            <table class="w-100 mt-1">
                <tr class="text-center bg-soft-success">
                    <td class="border border-success p-1 bg-success">
                        <h5 class="mb-0">SP</h5>
                    </td>
                    <td class="border border-success p-1">
                        <h4 class="card-title m-0">Total Material</h4>
                        <span>{{number_format($vLok['total_material_lokasi'],0,',','.')}}</span>
                    </td>
                    <td class="border border-success p-1">
                        <h4 class="card-title m-0">Total Jasa</h4>
                        <span>{{number_format($vLok['total_jasa_lokasi'],0,',','.')}}</span>
                    </td>
                    <td class="border border-success p-1">
                        <h4 class="card-title m-0">Total</h4>
                        <span>{{number_format($vLok['total_lokasi'],0,',','.')}}</span>
                    </td>
                </tr>
                <tr class="text-center bg-soft-warning">
                    <td class="border border-warning p-1 bg-warning">
                        <h5 class="mb-0">Rekon</h5>
                    </td>
                    <td class="border border-warning p-1">
                        <h4 class="card-title m-0">Total Material</h4>
                        <span>{{number_format($vLok['total_material_lokasi_rekon'],0,',','.')}}</span>
                    </td>
                    <td class="border border-warning p-1">
                        <h4 class="card-title m-0">Total Jasa</h4>
                        <span>{{number_format($vLok['total_jasa_lokasi_rekon'],0,',','.')}}</span>
                    </td>
                    <td class="border border-warning p-1">
                        <h4 class="card-title m-0">Total</h4>
                        <span>{{number_format($vLok['total_lokasi_rekon'],0,',','.')}}</span>
                    </td>
                </tr>
            </table>
            <div class="table-responsive mt-1">
                <table class="lh-80 small td-middle table table-sm table-bordered table-striped m-0">
                    <thead class="bg-light text-center">
                        <tr>
                            <th rowspan="2">No</th>
                            <th colspan="3">Quality Enhancement (QE) Akses</th>
                            <th colspan="2">Harga Satuan</th>
                            <th rowspan="2" class="bg-soft-success">Vol <br> SP</th>
                            <th colspan="3" class="bg-soft-success">Total Harga SP</th>
                            <th rowspan="2" class="bg-soft-warning">Vol <br> Re <br> Kon</th>
                            <th colspan="3" class="bg-soft-warning">Total Harga Rekon</th>
                        </tr>
                        <tr>
                            <th>Material <br> Designator</th>
                            <th>Jasa <br> Designator</th>
                            <th>Item Designator</th>
                            <th>Material</th>
                            <th>Jasa</th>
                            <th>Material</th>
                            <th>Jasa</th>
                            <th>Total</th>
                            <th>Material</th>
                            <th>Jasa</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($vLok['desig_items'] as $iDes=>$vDes)
                            <tr>
                                <td class="text-center">{{$iDes+1}}</td>
                                <td class="text-center">{{$vDes['nama_material']}}</td>
                                <td class="text-center">{{$vDes['nama_jasa']}}</td>
                                <td class="text-center">{{$vDes['nama_designator']}}</td>
                                <td class="text-right">{{number_format($vDes['material'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['jasa'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['vol'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['total_material'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['total_jasa'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['total'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['volume_rekon'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['total_material_rekon'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['total_jasa_rekon'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['total_rekon'],0,',','.')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endforeach
</div>