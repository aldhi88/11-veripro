<div class="tab-pane {{ $tab==-1?'active':null }}">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>Nomor Nota Dinas</label>
                <input readonly type="text" value="{{$dt['dt_tagihan']['no_nodin']}}" class="form-control bg-light">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>Tanggal Nota Dinas</label>
                <input readonly type="date" value="{{$dt['dt_tagihan']['tgl_nodin']}}" class="form-control bg-light">
            </div>
        </div>
    </div>
</div>