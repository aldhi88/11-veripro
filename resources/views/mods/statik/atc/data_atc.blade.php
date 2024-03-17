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
        processing: true,serverSide: true,pageLength: 25,
        order: [[1, 'asc']],
        columnDefs: [
            { className: 'text-center', targets: ['_all'] },
        ],
        ajax: '{{ route("master.statik.dt") }}',
        columns: [
            { data: 'action', name: 'action', orderable: false, searchable:false },
            { data: 'keyword', name: 'unit', orderable: true, searchable:true },
            { data: 'value', name: 'value', orderable: true, searchable:true },
        ],
        initComplete: function(settings){
            table = settings.oInstance.api();
            initSearchCol(table,'#header-filter','search-col-dt');
        }
    });

    </script>

@endsection