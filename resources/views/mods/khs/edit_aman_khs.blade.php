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

                    <form wire:submit="submit">

                        <h6 class="bg-light p-1 text-center">DATA AMANDEMEN {{ $amanKe }}</h6>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Nomor Amandemen</label>
                                    <input autofocus type="text" wire:model="dtEdit.no" class="form-control @error('dtEdit.no') is-invalid @enderror">
                                    @error('dtEdit.no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Judul Amandemen</label>
                                    <input type="text" wire:model="dtEdit.judul" class="form-control @error('dtEdit.judul') is-invalid @enderror">
                                    @error('dtEdit.judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input min="{{$tgl_before}}" type="date" wire:model="dtEdit.tgl_berlaku" class="form-control @error('dtEdit.tgl_berlaku') is-invalid @enderror">
                                    @error('dtEdit.tgl_berlaku')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <label>Nama Direktur</label>
                                    <input type="text" wire:model="dtEdit.json.direktur" class="form-control @error('dtEdit.json.direktur') is-invalid @enderror">
                                    @error('dtEdit.json.direktur')
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
                                    <input type="text" wire:model="dtEdit.json.bank" class="form-control @error('dtEdit.json.bank') is-invalid @enderror">
                                    @error('dtEdit.json.bank')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="text" wire:model="dtEdit.json.rekening" class="form-control @error('dtEdit.json.rekening') is-invalid @enderror">
                                    @error('dtEdit.json.rekening')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <label>Kantor Cabang</label>
                                    <input type="text" wire:model="dtEdit.json.cabang" class="form-control @error('dtEdit.json.cabang') is-invalid @enderror">
                                    @error('dtEdit.json.cabang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <label>Nama Pemilik Rekening</label>
                                    <input type="text" wire:model="dtEdit.json.nama_rekening" class="form-control @error('dtEdit.json.nama_rekening') is-invalid @enderror">
                                    @error('dtEdit.json.nama_rekening')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h6 class="bg-light p-1 text-center">DATA ALAMAT</h6>
                        <div class="row">
                            <div class="col-12 col-md">
                                <div class="form-group">
                                    <textarea class="form-control @error('dtEdit.json.alamat') is-invalid @enderror" wire:model="dtEdit.json.alamat" rows="3"></textarea>
                                    @error('dtEdit.json.alamat')
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
                                    <input id="{{$rand}}" type="file" wire:model="desigFile" class="form-control @error('desigFile') is-invalid @enderror">
                                    @error('desigFile')
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
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>