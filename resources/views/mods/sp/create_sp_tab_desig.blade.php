<div>
@if (!isset($dt['tgl_sp']))
    <div class="alert alert-info text-center" role="alert">
        Tanggal SP belum dipilih.
    </div>
@else
    
    <form wire:submit="uploadLokasi">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="custom-file">
                    <input type="file" wire:model="formUpload.file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Upload File Lokasi</label>
                </div>
                @error('formUpload.file')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <input type="number" min="1" value="1" placeholder="jumlah lokasi" wire:model="formUpload.jumlah" class="form-control">
                    @error('formUpload.jumlah')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md">
                <button type="submit" class="btn btn-success btn-block">Upload & Proses File</button>
            </div>
            {{-- <div class="col-12 col-md-3">
                <a href="{{ asset('assets/import/sample_import_lokasi.xlsx') }}" class="btn btn-light btn-block">
                    <i class="far fa-file-excel fa-fw"></i> Download Format
                </a>
            </div> --}}
        </div>
    </form>
    @if (session()->has('msg-upload-ok'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('msg-upload-ok') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    <hr>

    @if (session()->has('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    {{-- @if (isset($dtError) && count($dtError)>0)
        <div class="alert alert-danger" role="alert">
            <h6>Error Data Designator Tidak Sesuai dengan KHS : </h6>
            <ol>
                @foreach ($dtError as $iErrorSheet => $vErrorSheet)
                    <li>
                        Lokasi: {{$iErrorSheet+1}}: 
                        <ul>
                        @foreach ($vErrorSheet as $iErrorRow => $vErrorRow)
                            <li>Baris: {{$vErrorRow['row']}}</li>
                        @endforeach
                        </ul>
                    </li>
                @endforeach
            </ol>
        </div>
    @else
        @if (is_null($dtError) && count($dtLok)>0)
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check fa-fw"></i> Data lokasi valid.
            </div>
        @endif
    @endif --}}

    @if (isset($dtError) && $dtError=='pass')
        
        <div class="row">
            <div class="col">
                <table class="w-100">
                    <tr class="text-center bg-soft-success">
                        <td class="border border-success p-1">
                            <h4 class="card-title m-0">Jumlah Lokasi</h4>
                            <span>{{count($dtLok['lokasi'])}}</span>
                        </td>
                        <td class="border border-success p-1">
                            <h4 class="card-title m-0">Grand Total Material SP</h4>
                            <span>{{number_format($dtLok['grand_total_material'],0,',','.')}}</span>
                        </td>
                        <td class="border border-success p-1">
                            <h4 class="card-title m-0">Grand Total Jasa SP</h4>
                            <span>{{number_format($dtLok['grand_total_jasa'],0,',','.')}}</span>
                        </td>
                        <td class="border border-success p-1">
                            <h4 class="card-title m-0">Grand Total SP</h4>
                            <span>{{number_format($dtLok['grand_total'],0,',','.')}}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>

        @foreach ($dtLok['lokasi'] as $iLok => $vLok)
            
            <div class="table-responsive mb-2">
                <table class="w-100">
                    <tr class="text-center bg-warning">
                        <td colspan="3" class="border border-warning p-1">
                            <h4 class="card-title m-0">Lokasi {{$iLok+1}}</h4>
                        </td>
                    </tr>
                    <tr class="text-center bg-soft-warning">
                        <td class="border border-warning p-1">
                            <h4 class="card-title m-0">Nama Lokasi</h4>
                            <span>{{$vLok['nama_lokasi']}}</span>
                        </td>
                        <td class="border border-warning p-1">
                            <h4 class="card-title m-0">Nama STO</h4>
                            <span>{{$vLok['sto']}}</span>
                        </td>
                        <td class="border border-warning p-1">
                            <h4 class="card-title m-0">Nama Pekerjaan</h4>
                            <span>{{$vLok['id_project']}}</span>
                        </td>
                    </tr>
                    <tr class="text-center bg-soft-warning">
                        <td class="border border-warning p-1">
                            <h4 class="card-title m-0">Total Material</h4>
                            <span>{{number_format($vLok['total_material_lokasi'],0,',','.')}}</span>
                        </td>
                        <td class="border border-warning p-1">
                            <h4 class="card-title m-0">Total Jasa</h4>
                            <span>{{number_format($vLok['total_jasa_lokasi'],0,',','.')}}</span>
                        </td>
                        <td class="border border-warning p-1">
                            <h4 class="card-title m-0">Total</h4>
                            <span>{{number_format($vLok['total_lokasi'],0,',','.')}}</span>
                        </td>
                    </tr>
                </table>
                <table class="lh-80 small table table-sm m-0 table-bordered table-striped nowrap">
                    <thead class="bg-light text-center">
                        <tr>
                            <th rowspan="2">No</th>
                            <th colspan="3">Quality Enhancement (QE) Akses</th>
                            <th colspan="2">Harga Satuan</th>
                            <th rowspan="2">Vol</th>
                            <th colspan="3">Total Harga</th>
                        </tr>
                        <tr>
                            <th>Material <br> Designator</th>
                            <th>Jasa <br> Designator</th>
                            <th>Item Designator</th>
                            <th>Material</th>
                            {{-- <th>Item <br> Mitra</th> --}}
                            <th>Jasa</th>
                            <th>Material</th>
                            <th>Jasa</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($vLok['desigs'] as $iDes=>$vDes)
                            <tr>
                                <td class="text-center">{{$iDes+1}}</td>
                                <td class="text-center">{{$vDes['nama_material']}}</td>
                                <td class="text-center">{{$vDes['nama_jasa']}}</td>
                                <td class="text-center">{{$vDes['nama_designator']}}</td>
                                <td class="text-right">{{number_format($vDes['material'],0,',','.')}}</td>
                                {{-- <td class="text-right">{!!$vDes['material_mitra']?'<i class="fas fa-check"></i>':''!!}</td> --}}
                                <td class="text-right">{{number_format($vDes['jasa'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['vol'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['total_material'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['total_jasa'],0,',','.')}}</td>
                                <td class="text-right">{{number_format($vDes['total'],0,',','.')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endforeach

    @endif


@endif
@if (count($errors)>0)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    Masih terdapat error pada input form data SP silahkan cek kembali
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
</div>