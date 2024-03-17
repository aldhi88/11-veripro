@section('style')
        <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')

    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        
    <script>

    var dtTable = $('#myTable').DataTable({
        processing: true,serverSide: true,pageLength: 25,
        order: [[1, 'asc']],
        columnDefs: [
            { className: 'text-center', targets: ['_all'] },
        ],
        ajax: '{{ route("account.dt") }}',
        columns: [
            { data: 'action', name: 'action', orderable: false, searchable:false },
            { data: 'username', name: 'username', orderable: true, searchable:true },
            { data: 'master_users.auth_roles.name', name: 'master_users.auth_role_id', orderable: true, searchable:true },
            { data: 'master_users.master_units.nama', name: 'master_users.master_units.id', orderable: true, searchable:true },
            { data: 'created_at_id', name: 'created_at', orderable: true, searchable:true },
        ],
        initComplete: function(settings){
            table = settings.oInstance.api();
            initSearchCol(table,'#header-filter','search-col-dt');
        }
    });

    

    </script>

@endsection