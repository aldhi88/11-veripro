<div class="tab-pane {{ $tab==3?'active':null }}">
    <div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-group">
                    <label>Tgl. Turnkey</label>
                    <input disabled ="date" wire:model="dt.dt_tagihan.dt_turnkey.tgl_turnkey" class="bg-light form-control @error('dt.dt_tagihan.dt_turnkey.tgl_turnkey') is-invalid @enderror">
                    @error('dt.dt_tagihan.dt_turnkey.tgl_turnkey')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-3">
            <div class="col">
                <h4 class="card-title">Rincian Serah Terima</h4>
                <p class="card-title-desc">Beri centang terhadap rincian berikut:</p>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Dokumen</th>
                                <th colspan="2">Keterangan</th>
                            </tr>
                            <tr>
                                <th>Ada</th>
                                <th width="100">Tdk Ada</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php $index = 0; @endphp
                            @foreach ($doc as $i=>$item)
                                @if (is_array($item))
                                    @foreach ($item as $iSub=>$itemSub)
                                        @php $index = $index+$iSub; @endphp
                                        <tr>
                                            @if ($iSub==0) <td rowspan="2">{{$i+1}}</td> @endif
                                            <td class="text-left">{{$itemSub}} {{$index}}</td>
                                            <td><input disabled type="radio" wire:model="dt.dt_tagihan.dt_turnkey.rincian.{{$index}}" value="1" {{ $dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==1?"cheked":null }}></td>
                                            <td><input type="radio" disabled wire:model="dt.dt_tagihan.dt_turnkey.rincian.{{$index}}" value="0" {{ $dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==0?"cheked":null }}></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td class="text-left">{{ $item }} {{$index}}</td>
                                        <td><input type="radio" disabled wire:model="dt.dt_tagihan.dt_turnkey.rincian.{{$index}}" value="1" {{ $dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==1?"cheked":null }}></td>
                                        <td><input type="radio" disabled wire:model="dt.dt_tagihan.dt_turnkey.rincian.{{$index}}" value="0" {{ $dt['dt_tagihan']['dt_turnkey']['rincian'][$index]==0?"cheked":null }}></td>
                                    </tr>
                                @endif
                                @php $index +=1; @endphp
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
