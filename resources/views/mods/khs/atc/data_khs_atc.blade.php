@section('style')
        <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')

    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        
    <script>

    window.addEventListener('reloadDt', param => {
        dtTable.ajax.reload();
    });

    $("#deleteModal").on("show.bs.modal", function(e) {
        var attr = $(e.relatedTarget).data('attr');
        var id = $(e.relatedTarget).data('id');
        window.Livewire.emit('prepareModalDelete', {'attr':attr, 'id':id});
    });
    
    var dtTable = $('#myTable').DataTable({
        processing: true,serverSide: true,pageLength: 25,sDom: 'lstrip',
        order: [[4, 'desc']],
        columnDefs: [
            { className: 'text-center', targets: ['_all'] },
        ],
        ajax: '{{ route("khs.index.dt") }}',
        columns: [
            { data: 'action', name: 'action', orderable: false, searchable:false },
            { data: 'master_users_detail_json.perusahaan', name: 'auth_logins.master_users.detail.perusahaan', orderable: false, searchable:true },
            { data: 'no', name: 'no', orderable: false, searchable:true },
            { data: 'judul', name: 'json', orderable: true, searchable:true },
            { data: 'tgl_berlaku_format', name: 'tgl_berlaku', orderable: true, searchable:true },
            { data: 'khs_amandemens_count', name: 'khs_amandemens_count', orderable: false, searchable:false },
            { data: 'khs_induk_designators_count', name: 'khs_induk_designators_count', orderable: false, searchable:false },
        ],
        initComplete: function(settings){
            table = settings.oInstance.api();
            initSearchCol(table,'#header-filter','search-col-dt');
        }
    });

    </script>

@endsection

