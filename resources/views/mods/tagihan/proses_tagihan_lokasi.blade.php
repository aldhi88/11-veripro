<div>
    <div class="row mb-2 text-dark">
        <div class="col">
            <table class="w-100">
                <tr class="text-center bg-soft-success">
                    <td class="border border-success p-1 bg-success">
                        <h5 class="mb-0">SP</h5>
                    </td>
                    <td class="border border-success p-1">
                        <h4 class="card-title m-0">Jumlah Lokasi</h4>
                        <span>{{count($dt['dt_sp']['json']['dtLokasi']['lokasi'])}}</span>
                    </td>
                    <td class="border border-success p-1">
                        <h4 class="card-title m-0">Grand Total Material</h4>
                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_material'],0,',','.')}}</span>
                    </td>
                    <td class="border border-success p-1">
                        <h4 class="card-title m-0">Grand Total Jasa</h4>
                        <span>{{number_format($dt['dt_tagihan']['dt_lokasi']['grand_total_jasa'],0,',','.')}}</span>
                    </td>
                    <td class="border border-success p-1">
                        <h4 class="card-title m-0">Grand Total</h4>
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