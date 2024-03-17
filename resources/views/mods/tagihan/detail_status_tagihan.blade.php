<div>
    <div wire:ignore.self class="modal fade" id="historyModal" tabindex="-1">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-info-circle"> </i> History Tagihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
    
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col">
                            <table class="table table-striped table-bordered table-sm mb-5">
                                <thead class="bg-light">
                                    <tr class="text-center">
                                        <th>Tanggal</th>
                                        {{-- <th>Procurement</th> --}}
                                        <th width="50">Status</th>
                                        <th>Keterangan</th>
                                        {{-- <th>Detail</th> --}}
                                    </tr>
                                    
                                </thead>
                                <tbody class="text-center">
                                    @if (count($dtAwal) > 0)
                                        <tr>
                                            <td>
                                                {{ Carbon\Carbon::parse($dtAwal['created_at'])->setTimezone('Asia/Jakarta')->isoFormat('DD MMMM YYYY, HH:m') }} WIB
                                            </td>
                                            {{-- <td>{{ $dtAwal['tagihans']['sp_induks']['auth_logins']['master_users']['nama'] }}</td> --}}
                                            <td><h5 class="mb-0"><span class="w-100 badge badge-info">SP Dikirim ke Mitra</span></h5></td>
                                            <td class="text-left">SP baru diterbitkan dan terkirim ke Mitra</td>
                                        </tr>
                                    @endif
                                    
                                    @foreach ($dtDetails as $i => $item)
                                        <tr>
                                            <td>
                                                {{ Carbon\Carbon::parse($item['created_at'])->setTimezone('Asia/Jakarta')->isoFormat('DD MMMM YYYY, HH:m') }} WIB
                                            </td>
                                            {{-- <td>{{ $item->tagihans->auth_logins->master_users->nama }}</td> --}}
                                            <td>{!! $item->status_label !!}</td>
                                            <td class="text-left">{{ $item->status_desc }}</td>
                                            
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Tutup</button>
                </div>
    
            </div>
        </div>
    </div>

    
    
</div>
