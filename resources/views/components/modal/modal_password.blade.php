<div>
    <div wire:ignore.self class="modal fade" id="modalPassword" tabindex="-1">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-info-circle"> </i> Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="process">
    
                    <div class="modal-body">
                        
                        Apakah anda yakin {{ isset($data['msg'])?$data['msg']:null}}?


                        <div class="form-group mt-2">
                            <label>Kata Sandi Login</label>
                            <input type="password" wire:model="password" class="form-control modalOnFocus @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary close-btn" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-sm btn-danger">Ya & Proses</button>
                    </div>
    
                </form>
            </div>
        </div>
    </div>
    
</div>
