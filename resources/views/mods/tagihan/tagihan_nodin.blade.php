<div class="tab-pane {{ $tab==-1?'active':null }}">

    <div class="row">
        <div class="col-12">
            <h4 class="card-title">Data Nota Dinas</h4>
            <p class="card-title-desc">Lengkapi data jika anda ingin menyetujui tagihan ini.</p>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>Nomor Nota Dinas</label>
                <input type="text" wire:model="dt.dt_tagihan.no_nodin" class="form-control @error('dt.dt_tagihan.no_nodin') is-invalid @enderror">
                @error('dt.dt_tagihan.no_nodin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>Tanggal Nota Dinas</label>
                <input type="date" wire:model="dt.dt_tagihan.tgl_nodin" class="form-control @error('dt.dt_tagihan.tgl_nodin') is-invalid @enderror">
                @error('dt.dt_tagihan.tgl_nodin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            @php
                $dtJes1['msg'] = 'menyetujui data tagihan ini ';
                $dtJes1['attr'] = '';
                $dtJes1['id'] = $dtTagih['id'];
                $dtJes1['callback'] = "prosesusertagihan-submit";
                $dtJes1 = json_encode($dtJes1);
            @endphp
            <button class="btn btn-success" type="button" data-toggle="modal" data-emit="modalpassword-prepare" data-target="#modalPassword" data-json='{{$dtJes1}}'>Setujui Tagihan</button>
        </div>
        

    </div>

    <hr>

    <div class="row" wire:ignore>
        <div class="col-12">
            <h4 class="card-title">Pesan Revisi</h4>
            <p class="card-title-desc">Tulis pesan revisi anda disini.</p>

            <input id="{{ $trixId }}" type="hidden" name="content" value="{{ $dtTagih['revisi'] }}">
            <trix-editor input="{{ $trixId }}" style="height: 200px" input="{{ $trixId }}"></trix-editor>
            
        </div> 
        <div class="col-12 mt-2">

            @php
                $dtJes2['msg'] = 'mengirimkan revisi pada tagihan ini ';
                $dtJes2['attr'] = '';
                $dtJes2['id'] = $dtTagih['id'];
                $dtJes2['callback'] = "prosesusertagihan-revisi";
                $dtJes2 = json_encode($dtJes2);
            @endphp

            <button class="btn btn-danger" type="button" data-toggle="modal" data-emit="modalpassword-prepare" data-target="#modalPassword" data-json='{{$dtJes2}}'>Kirim Data Revisi</button>
        </div>
    </div> 

</div>