<div>
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}" class="btn btn-warning btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
        </div>
        <div class="col text-right">
            <a href="{{ route('khs.index') }}" class="btn btn-success btn-sm">Data KHS Induk</a>
            <div class="btn-group">
                <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Template <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="">
                    <a class="dropdown-item" href="{{ asset('assets/import/sample_designator.xlsx') }}">File Excel Designator</a>
                </div>
            </div>
        </div>
    </div><hr>

    {{-- ======== --}}

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <form wire:submit="updateKhs">

                        <h6 class="bg-light p-1 text-center">DATA KHS</h6>
                        <div class="row">
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <label>Nomor</label>
                                    <input autofocus type="text" wire:model="dt.no" class="form-control @error('dt.no') is-invalid @enderror">
                                    @error('dt.no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" wire:model="dt.judul" class="form-control @error('dt.judul') is-invalid @enderror">
                                    @error('dt.judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <label>Mitra</label>
                                    <div wire:ignore>
                                        <select id="select2-mitra" class="form-control @error('dt.auth_login_id') is-invalid @enderror">
                                            <option value="">Pilih</option>
                                            @foreach ($mitras as $item)
                                                <option {{$item['auth_login_id']==$dt['auth_login_id']?'selected':null}} value="{{$item['auth_login_id']}}">{{$item['detail']['perusahaan']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('dt.auth_login_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" wire:model="dt.tgl_berlaku" class="form-control @error('dt.tgl_berlaku') is-invalid @enderror">
                                    @error('dt.tgl_berlaku')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <label>Nama Direktur</label>
                                    <input type="text" wire:model="dt.json.direktur" class="form-control @error('dt.json.direktur') is-invalid @enderror">
                                    @error('dt.json.direktur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <h6 class="bg-light p-1 text-center">DATA REKENING</h6>
                        <div class="row">
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" wire:model="dt.json.bank" class="form-control @error('dt.json.bank') is-invalid @enderror">
                                    @error('dt.json.bank')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="text" wire:model="dt.json.rekening" class="form-control @error('dt.json.rekening') is-invalid @enderror">
                                    @error('dt.json.rekening')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <label>Kantor Cabang</label>
                                    <input type="text" wire:model="dt.json.cabang" class="form-control @error('dt.json.cabang') is-invalid @enderror">
                                    @error('dt.json.cabang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <label>Nama Pemilik Rekening</label>
                                    <input type="text" wire:model="dt.json.nama_rekening" class="form-control @error('dt.json.nama_rekening') is-invalid @enderror">
                                    @error('dt.json.nama_rekening')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h6 class="bg-light p-1 text-center">DATA ALAMAT</h6>
                        <div class="row">
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <textarea class="form-control @error('dt.json.alamat') is-invalid @enderror" wire:model="dt.json.alamat" rows="3"></textarea>
                                    @error('dt.json.alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        
                        {{-- <h6 class="bg-light p-1 text-center">DATA DESIGNATOR</h6>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Upload File Excel</label>
                                    <input id="{{ $rand }}" type="file" wire:model="desig" class="form-control @error('desig') is-invalid @enderror">
                                    @error('desig')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                        </div> --}}

                        <hr>

                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-light" wire:click="resetForm">Reset Form</button>
                            </div>
                            <div class="col text-right">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    @include('mods.khs.atc.edit_khs_atc')

</div>