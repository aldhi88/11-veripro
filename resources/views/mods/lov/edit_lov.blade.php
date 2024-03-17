<div>
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Form Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="edit">
                    <input type="hidden" wire:model="editId" name="editId">
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <h6>Keyword</h6>
                            <input readonly disabled  type="text" value="{{$keyword}}" class="form-control bg-light">
                        </div>
                        <div class="form-group">
                            @if (isset($value))
                            <div class="row">
                                <div class="col">
                                    <h6>Pejabat</h6>
                                    @foreach ($value['nama'] as $i=>$item)
                                        <div class="d-flex mb-1">
                                            @if ($i==0)
                                            <button type="button" wire:click="addList({{count($value['nama'])}},'nama')" class="btn btn-sm btn-success mr-1"><i class="fa fa-plus fa-fw"></i></button>
                                            @else
                                            <button type="button" wire:click="removeList({{$i}},'nama')" class="btn btn-sm btn-danger mr-1"><i class="fa fa-times fa-fw"></i></button>
                                            @endif
                                            <input class="w-100" type="text" wire:model="value.nama.{{intval($i)}}">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col">
                                    <h6>Jabatan</h6>
                                    @foreach ($value['jabatan'] as $i=>$item)
                                        <div class="d-flex mb-1">
                                            @if ($i==0)
                                            <button type="button" wire:click="addList({{count($value['jabatan'])}},'jabatan')" class="btn btn-sm btn-success mr-1"><i class="fa fa-plus fa-fw"></i></button>
                                            @else
                                            <button type="button" wire:click="removeList({{$i}},'jabatan')" class="btn btn-sm btn-danger mr-1"><i class="fa fa-times fa-fw"></i></button>
                                            @endif
                                            <input class="w-100" type="text" wire:model="value.jabatan.{{intval($i)}}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            @endif


                            
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
