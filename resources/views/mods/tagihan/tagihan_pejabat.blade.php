<div class="tab-pane {{ $tab==4?'active':null }}">
    
    <div class="row">
        <div class="col">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label>GM. Telkom Akses (Pejabat)</label>
                        <select wire:model="dt.dt_tagihan.dt_ttd.gm_ta_pejabat" class="form-control @error('dt.dt_tagihan.dt_ttd.gm_ta_pejabat') is-invalid @enderror">
                            <option value="">Pilih nama</option>
                            @foreach ($pejabat['gm_ta']['value']['nama'] as $item)
                            <option value="{{ $item }}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('dt.dt_tagihan.dt_ttd.gm_ta_pejabat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>GM. Telkom Akses (Jabatan)</label>
                        <select wire:model="dt.dt_tagihan.dt_ttd.gm_ta_jabatan" class="form-control @error('dt.dt_tagihan.dt_ttd.gm_ta_jabatan') is-invalid @enderror">
                            <option value="">Pilih jabatan</option>
                            @foreach ($pejabat['gm_ta']['value']['jabatan'] as $item)
                            <option value="{{ $item }}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('dt.dt_tagihan.dt_ttd.gm_ta_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label>Mgr. {{$dt['dt_sp']['master_units']['nama']}} (Pejabat)</label>
                        <select wire:model="dt.dt_tagihan.dt_ttd.mgr_unit_pejabat" class="form-control @error('dt.dt_tagihan.dt_ttd.mgr_unit_pejabat') is-invalid @enderror">
                            <option value="">Pilih nama</option>
                            
                            @foreach ($pejabat['mgr_'.strtolower($dt['dt_sp']['master_units']['nama'])]['value']['nama'] as $item)
                            <option value="{{ $item }}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('dt.dt_tagihan.dt_ttd.mgr_unit_pejabat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>Mgr. {{$dt['dt_sp']['master_units']['nama']}} (Jabatan)</label>
                        <select wire:model="dt.dt_tagihan.dt_ttd.mgr_unit_jabatan" class="form-control @error('dt.dt_tagihan.dt_ttd.mgr_unit_jabatan') is-invalid @enderror">
                            <option value="">Pilih jabatan</option>
                            
                            @foreach ($pejabat['mgr_'.strtolower($dt['dt_sp']['master_units']['nama'])]['value']['jabatan'] as $item)
                            <option value="{{ $item }}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('dt.dt_tagihan.dt_ttd.mgr_unit_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label>SM. {{$dt['dt_sp']['master_units']['nama']}} (Pejabat)</label>
                        <select wire:model="dt.dt_tagihan.dt_ttd.sm_unit_pejabat" class="form-control @error('dt.dt_tagihan.dt_ttd.sm_unit_pejabat') is-invalid @enderror">
                            <option value="">Pilih nama</option>@foreach ($pejabat['sm_'.strtolower($dt['dt_sp']['master_units']['nama'])]['value']['nama'] as 
                            $item)
                            <option value="{{ $item }}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('dt.dt_tagihan.dt_ttd.sm_unit_pejabat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>SM. {{$dt['dt_sp']['master_units']['nama']}} (Jabatan)</label>
                        <select wire:model="dt.dt_tagihan.dt_ttd.sm_unit_jabatan" class="form-control @error('dt.dt_tagihan.dt_ttd.sm_unit_jabatan') is-invalid @enderror">
                            <option value="">Pilih jabatan</option>@foreach ($pejabat['sm_'.strtolower($dt['dt_sp']['master_units']['nama'])]['value']['jabatan'] as 
                            $item)
                            <option value="{{ $item }}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('dt.dt_tagihan.dt_ttd.sm_unit_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label>Mgr. Shared Service (Pejabat)</label>
                        <select wire:model="dt.dt_tagihan.dt_ttd.mgr_shared_pejabat" class="form-control @error('dt.dt_tagihan.dt_ttd.mgr_shared_pejabat') is-invalid @enderror">
                            <option value="">Pilih nama</option>
                            @foreach ($pejabat['mgr_shared']['value']['nama'] as $item)
                            <option value="{{ $item }}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('dt.dt_tagihan.dt_ttd.mgr_shared_pejabat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>Mgr. Shared Service (Jabatan)</label>
                        <select wire:model="dt.dt_tagihan.dt_ttd.mgr_shared_jabatan" class="form-control @error('dt.dt_tagihan.dt_ttd.mgr_shared_jabatan') is-invalid @enderror">
                            <option value="">Pilih jabatan</option>
                            @foreach ($pejabat['mgr_shared']['value']['jabatan'] as $item)
                            <option value="{{ $item }}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('dt.dt_tagihan.dt_ttd.mgr_shared_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label>Waspang (Pejabat)</label>
                        <select wire:model="dt.dt_tagihan.dt_ttd.waspang_pejabat" class="form-control @error('dt.dt_tagihan.dt_ttd.waspang_pejabat') is-invalid @enderror">
                            <option value="">Pilih nama</option>
                            @foreach ($pejabat['waspang']['value']['nama'] as $item)
                            <option value="{{ $item }}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('dt.dt_tagihan.dt_ttd.waspang_pejabat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>Waspang (Jabatan)</label>
                        <select wire:model="dt.dt_tagihan.dt_ttd.waspang_jabatan" class="form-control @error('dt.dt_tagihan.dt_ttd.waspang_jabatan') is-invalid @enderror">
                            <option value="">Pilih jabatan</option>
                            @foreach ($pejabat['waspang']['value']['jabatan'] as $item)
                            <option value="{{ $item }}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('dt.dt_tagihan.dt_ttd.waspang_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label>Petugas Gudang (Pejabat)</label>
                        <select wire:model="dt.dt_tagihan.dt_ttd.gudang_pejabat" class="form-control @error('dt.dt_tagihan.dt_ttd.gudang_pejabat') is-invalid @enderror">
                            <option value="">Pilih nama</option>
                            @foreach ($pejabat['gudang']['value']['nama'] as $item)
                            <option value="{{ $item }}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('dt.dt_tagihan.dt_ttd.gudang_pejabat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>Petugas Gudang (Jabatan)</label>
                        <select wire:model="dt.dt_tagihan.dt_ttd.gudang_jabatan" class="form-control @error('dt.dt_tagihan.dt_ttd.gudang_jabatan') is-invalid @enderror">
                            <option value="">Pilih jabatan</option>
                            @foreach ($pejabat['gudang']['value']['jabatan'] as $item)
                            <option value="{{ $item }}">{{$item}}</option>
                            @endforeach
                        </select>
                        @error('dt.dt_tagihan.dt_ttd.gudang_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>