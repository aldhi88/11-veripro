@section('style')
        <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('script')

    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <script>
    $('.select2').select2();

    var dtTable = $('#myTable').DataTable({
        processing: true,serverSide: true,pageLength: 25,
        order: [[0, 'desc']],
        columnDefs: [
            { className: 'text-center', targets: ['_all'] },
        ],
        ajax: '{{ route("sp.index.dt") }}',
        columns: [
            { data: 'action', name: 'created_at', orderable: false, searchable:false },
            { data: 'status_label', name: 'status', orderable: true, searchable:true },
            { data: 'khs_induks.auth_logins.master_users.nama', name: 'khs_induks.auth_logins.master_users.nama', orderable: true, searchable:true },
            { data: 'khs_induks.no', name: 'khs_induks.no', orderable: true, searchable:true },
            { data: 'no_sp', name: 'no_sp', orderable: true, searchable:true },
            { data: 'tgl_sp_format', name: 'tgl_sp', orderable: true, searchable:true },
            { data: 'toc_format', name: 'tgl_toc', orderable: true, searchable:true },
            { data: 'ppn', name: 'ppn', orderable: true, searchable:true },
            { data: 'nama_pekerjaan', name: 'nama_pekerjaan', orderable: true, searchable:true },
            { data: 'sp_amandemens_count', name: 'sp_amandemens_count', orderable: false, searchable:false },
        ],
        initComplete: function(settings){
            table = settings.oInstance.api();
            initSearchCol(table,'#header-filter','search-col-dt');
        }
    });



    </script>

@endsection
