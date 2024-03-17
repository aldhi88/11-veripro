<div>
    {{-- <div class="modal fade" id="modalDesig" tabindex="-1"> --}}
    <div wire:ignore.self class="modal fade" id="modalDesig" tabindex="-1">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-info-circle"> </i> Data Designator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="modalConfirmProcess">
    
                    <div class="modal-body">

                        <div class="table-responsive">

                            {{-- <table class="lh-80 small table table-sm m-0 table-bordered table-striped nowarp" id="datatable"> --}}
                                <table class="table table-sm table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th colspan="2">Quality Enhancement (QE) Akses</th>
                                        <th rowspan="2">Item Designator <br> OSP-FO</th>
                                        <th rowspan="2" width="180">Uraian Pekerjaan</th>
                                        <th rowspan="2">Satuan</th>
                                        <th colspan="2">Harga Satuan</th>
                                    </tr>
                                    <tr>
                                        <th>Material <br> Designator</th>
                                        <th>Jasa <br> Designator</th>
                                        <th>Material</th>
                                        <th>Jasa</th>
                                    </tr>
                                </thead>
    
                                <thead id="header-filter">
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center"><input type="text" wire:model="nama_material" class="text-center"></th>
                                        <th class="text-center"><input type="text" wire:model="nama_jasa" class="text-center"></th>
                                        <th class="text-center"><input type="text" wire:model.live="nama" class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    @foreach ($result as $i=>$item)
                                        <tr class="text-center">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item['nama_material'] }}</td>
                                            <td>{{ $item['nama_jasa'] }}</td>
                                            <td>{{ $item['nama'] }}</td>
                                            <td>
                                                <span title="{{$item['uraian']}}">
                                                    <small>{{ Str::limit($item['uraian'], 25, '...') }}</small>
                                                </span>
                                            </td>
                                            <td>{{ $item['satuan'] }}</td>
                                            <td class="text-right">{{ number_format($item['material'],0,',','.') }}</td>
                                            <td class="text-right">{{ number_format($item['jasa'],0,',','.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        

                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-danger">Yakin & Lanjutkan</button>
                    </div>
    
                </form>
            </div>
        </div>
    </div>

</div>