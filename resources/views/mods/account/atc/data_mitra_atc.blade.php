@section('style')
        <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')

    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        
    <script>

    var dtTable = $('#myTable').DataTable({
        processing: true,serverSide: true,pageLength: 25,sDom: 'lrtip',
        order: [[1, 'asc']],
        columnDefs: [
            { className: 'text-center', targets: ['_all'] },
        ],
        ajax: '{{ route("account.mitra.dt") }}',
        columns: [
            { data: 'action', name: 'action', orderable: false, searchable:false },
            { data: 'username', name: 'username', orderable: true, searchable:true },
            { data: 'master_users.nama', name: 'master_users.nama', orderable: false, searchable:true },
            { data: 'detail_json.perusahaan', name: 'master_users.detail', orderable: false, searchable:true },
            { data: 'detail_json.direktur', name: 'master_users.detail', orderable: false, searchable:true },
            { data: 'detail_json.lokasi', name: 'master_users.detail', orderable: false, searchable:true },
            { data: 'detail_json.alamat', name: 'master_users.detail', orderable: false, searchable:true },
            { data: 'detail_json.telepon', name: 'master_users.detail', orderable: false, searchable:true },
            { data: 'detail_json.email', name: 'master_users.detail', orderable: false, searchable:true },
            { data: 'created_at_id', name: 'created_at', orderable: true, searchable:true },
        ],
        initComplete: function(settings){
            table = settings.oInstance.api();
            initSearchCol(table,'#header-filter','search-col-dt');
        }
    });

    

    </script>

@endsection