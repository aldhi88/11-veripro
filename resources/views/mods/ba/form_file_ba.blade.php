<div>
    <div wire:ignore.self class="modal fade" id="fileBaModal" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-info-circle"> </i> File BA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>

                <form method="POST" wire:submit.prevent="lihats">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-sm">
                                        <thead class="bg-light">
                                            <tr class="text-center">
                                                <th>
                                                    Pilih Semua  
                                                    <input wire:click="checkUncheck" type="checkbox" {{$isChecked}}>
                                                </th>
                                                <th>No</th>
                                                <th>Nama File</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($dtFileBa as $i => $item)
                                                <tr>
                                                    <td>
                                                        <input wire:click="makeUrl" type="checkbox" wire:model.defer="file" value="{{$i}}" @if(in_array($i, $file)) checked @endif>
                                                    </td>
                                                    <td>{{$i+1}}</td>
                                                    <td class="text-left">{{$item}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
    
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Tutup</button>

                        @if (is_null($url))
                            <button disabled type="button" class="btn btn-primary close-btn"><i class="far fa-check-square fa-fw"></i> Lihat File</button>
                        @else
                            <a href="{{route('ba.file', $tagihanId)}}?file={{$url}}" class="btn btn-primary close-btn" target="_blank"><i class="far fa-check-square fa-fw"></i> Lihat File</a>
                        @endif



                    </div>

                </form>
    
    
            </div>
        </div>
    </div>
    
</div>
