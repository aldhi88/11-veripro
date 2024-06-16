<div>
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Form Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="edit">
                    <input type="hidden" wire:model="keyword">
                    <div class="modal-body">

                        <div class="form-group">
                            <h6>Value</h6>
                            <input type="number" required min="1" value="{{$value}}" wire:model="value" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    @push('push-script')
        <script>
            $("#editModal").on("show.bs.modal", function(e) {
                var id = $(e.relatedTarget).data('id');
                Livewire.dispatch('editlov-prepareEditModal', {param:id});
            });

        </script>
    @endpush
</div>
