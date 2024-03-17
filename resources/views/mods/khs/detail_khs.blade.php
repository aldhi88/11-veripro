<div>
    <div class="loading-50" wire:loading><div class="loader"></div></div>
    
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a wire:click="changeTab('induk','')" class="nav-link {{ $activeTab=="induk_"?'active':null }}" data-toggle="tab" href="#content" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-file-archive"></i></span>
                                <span class="d-none d-sm-block">KHS Induk</span>    
                            </a>
                        </li>
                        
                        @foreach ($dtAman as $i => $item)
                        <li class="nav-item">
                            <a wire:click="changeTab('aman',{{$item['id']}})" class="nav-link {{ $activeTab=="aman_".$item['id']?'active':null }}" data-toggle="tab" href="#content" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-file-alt"></i></span>
                                <span class="d-none d-sm-block">Amandemen {{ $i+1 }}</span>    
                            </a>
                        </li>
                        @endforeach
                        
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-pane active" id="content" role="tabpanel">
                        <div class="tab-content p-3 text-muted">
                            @if ($activeTab != 'induk_')
                                @if (isset($isAllowEdit) && $isAllowEdit)
                                    <a href="{{ route('khs.editAman', $dtKhs['id']) }}" class="btn btn-sm btn-warning mb-2">Edit</a>
                                @endif

                                @if (isset($isAllowDelete) && $isAllowDelete)
                                    @php
                                        unset($dtJson);
                                        $dtJson['msg'] = 'menghapus data Amandemen KHS '.$dtKhs['no'];
                                        $dtJson['attr'] = $dtKhs['no'];
                                        $dtJson['id'] = $dtKhs['id'];
                                        $dtJson['callback'] = "detailkhs-delete";
                                        $dtJson = json_encode($dtJson);
                                    @endphp     
                                    <a class="btn btn-danger btn-sm mb-2" data-emit="modalconfirm-prepare" data-toggle="modal" data-target="#modalConfirm" href="javascript:void(0);" data-json="{{$dtJson}}"><i class="fas fa-trash-alt fa-fw"></i> Hapus</a>
                                @endif
                                
                            @endif
                            <div>
                                <h6 class="bg-light p-1 text-center">
                                    <span>DATA KONTRAK</span>
                                </h6>
                                <div class="row">
                                    <div class="form-group mb-0 col-12 col-md">
                                        <h6>Nomor</h6>
                                        <p>{{ $dtKhs['no'] }}</p>
                                    </div>
                                    <div class="form-group mb-0 col-12 col-md">
                                        <h6>Judul</h6>
                                        <p>{{ $dtKhs['no'] }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-0 col-12 col-md">
                                        <h6>Mitra</h6>
                                        <p>{{ $dtKhs['json']['perusahaan'] }}</p>
                                    </div>
                                    <div class="form-group mb-0 col-12 col-md">
                                        <h6>Tanggal</h6>
                                        <p>{{ \Carbon\Carbon::parse($dtKhs['tgl_berlaku'])->format('d M Y') }}</p>
                                    </div>
                                    <div class="form-group mb-0 col-12 col-md">
                                        <h6>Direktur</h6>
                                        <p>{{ $dtKhs['json']['direktur'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h6 class="bg-light p-1 text-center">
                                    <span>DATA REKENING</span>
                                </h6>
                                <div class="row">
                                    <div class="form-group mb-0 col-12 col-md">
                                        <h6>Bank</h6>
                                        <p>{{ $dtKhs['json']['bank'] }}</p>
                                    </div>
                                    <div class="form-group mb-0 col-12 col-md">
                                        <h6>Cabang</h6>
                                        <p>{{ $dtKhs['json']['cabang'] }}</p>
                                    </div>
                                    <div class="form-group mb-0 col-12 col-md">
                                        <h6>No.Rekening</h6>
                                        <p>{{ $dtKhs['json']['rekening'] }}</p>
                                    </div>
                                    <div class="form-group mb-0 col-12 col-md">
                                        <h6>Pemilik</h6>
                                        <p>{{ $dtKhs['json']['nama_rekening'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h6 class="bg-light p-1 text-center">
                                    <span>DATA ALAMAT</span>
                                </h6>
                                <div class="row">
                                    <div class="form-group mb-0 col-12 col-md">
                                        <p>{{ $dtKhs['json']['alamat'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h6 class="bg-light p-1 text-center">
                                    <span>DATA DESIGNATOR</span>
                                </h6>
                                <div class="row">
                                    <div class="form-group mb-0 col-12 col-md">
                                        <div class="table-responsive mt-2" wire:ignore>
                                            <table id="myTable" class="small nowrap table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th rowspan="2" class="text-center" width="10"></th>
                                                    <th colspan="3" class="text-center">Designator</th>
                                                    <th rowspan="2" class="text-center" style="max-width: 50px;">Uraian</th>
                                                    <th rowspan="2" class="text-center">Satuan</th>
                                                    <th rowspan="2" class="text-center">Material</th>
                                                    <th rowspan="2" class="text-center">Jasa</th>
                                                    <th rowspan="2" class="text-center">Fix Price</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Nama Material</th>
                                                    <th class="text-center">Nama Jasa</th>
                                                    <th class="text-center">Nama</th>
                                                </tr>
                                                </thead>

                                                <thead id="header-filter">
                                                    <tr>
                                                        <th class="text-center"></th>
                                                        <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                                        <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                                        <th class="text-center"><input type="text" class="form-control form-control-sm text-center search-col-dt"></th>
                                                        <th class="text-center"></th>
                                                        <th class="text-center"></th>
                                                        <th class="text-center"></th>
                                                        <th class="text-center"></th>
                                                        <th class="text-center"></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    @include('mods.khs.atc.detail_khs_atc')
</div>
