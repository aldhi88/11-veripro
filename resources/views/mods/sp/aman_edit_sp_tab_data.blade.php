<div>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>File SP</label>
                <input type="file" wire:model="dt.file_sp" class="form-control @error('dt.file_sp') is-invalid @enderror">
                @error('dt.file_sp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Nomor SP</label>
                <input autofocus type="text" wire:model="dt.no_sp" class="form-control @error('dt.no_sp') is-invalid @enderror">
                @error('dt.no_sp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label>Tujuan Mitra</label>

                @if ($hasTagihan)
                <input type="text" value="{{ $dtEdit['khs_induks']['json']['perusahaan'] }}" class="bg-light form-control" readonly>
                @else
                <div wire:ignore>
                    <select id="select2-mitra" wire:model="dt.mitra_id" class="form-control">
                        @foreach ($mitras as $item)
                            <option value="{{$item['auth_login_id']}}">{{ json_decode($item['detail'], true)['perusahaan'] }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                @error('dt.mitra_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>KHS Induk</label>
                <div wire:ignore>
                    <select id="select2-khs" wire:model="dt.khs_induk_id" class="form-control">
                        @foreach ($dtKhs as $item)
                        <option value="{{$item['id']}}">{{$item['no']}}</option>
                        @endforeach
                    </select>
                </div>
                @error('dt.khs_induk_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>KHS Amandemen</label>
                <input placeholder="-" type="text" readonly value="{{$noAman}}" class="form-control bg-light">
                <small>Pilih KHS Induk, amandemen yang sesuai akan terpilih otomatis Tanggal SP dipilih.</small>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Tanggal SP</label>
                <input {{ $openTglSpToc?null:'readonly' }} wire:change="changeTglSp" type="date" min="{{ $minTglSp }}" wire:model="dt.tgl_sp" class="{{ $openTglSpToc?null:'bg-light' }} form-control @error('dt.tgl_sp') is-invalid @enderror">
                @error('dt.tgl_sp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Tanggal TOC</label>
                <input {{ $openTglSpToc?null:'readonly' }} type="date" min="{{ isset($dt['tgl_sp'])?$dt['tgl_sp']:null }}" wire:model="dt.tgl_toc" class="{{ $openTglSpToc?null:'bg-light' }} form-control @error('dt.tgl_toc') is-invalid @enderror">
                @error('dt.tgl_toc')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>Jenis Pekerjaan</label>
                <select wire:model="dt.master_unit_id" class="form-control @error('dt.master_unit_id') is-invalid @enderror">
                    <option value="">Pilih</option>
                    @foreach ($units as $item)
                        <option value="{{$item['id']}}">{{$item['nama']}}</option>
                    @endforeach
                </select>
                @error('dt.master_unit_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="form-group">
                <label>PPN %</label>
                <input type="number" min="0" wire:model="dt.ppn" class="form-control @error('dt.ppn') is-invalid @enderror">
                @error('dt.ppn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>Nama Pekerjaan</label>
                <input type="text" wire:model="dt.nama_pekerjaan" class="form-control @error('dt.nama_pekerjaan') is-invalid @enderror">
                @error('dt.nama_pekerjaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
    </div>
    

@if (!is_null($msgLokasi))
<div class="alert alert-danger" role="alert">
    {{$msgLokasi}}
</div>
@endif
</div>