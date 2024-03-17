@section('style')
        <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')

    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        
    <script>

        $("#historyModal").on("show.bs.modal", function(e) {
            var id = $(e.relatedTarget).data('id');
            Livewire.dispatch('detaistatustagihan-prepare', {id:id});
        });


    var dtTable = $('#myTable').DataTable({
        processing: true,serverSide: true,pageLength: 25,
        order: [[0, 'desc']],
        columnDefs: [
            { className: 'text-center', targets: ['_all'] },
        ],
        ajax: '{{ route("dashboard.index.dt") }}',
        columns: [
            { data: 'updated_at_format', name: 'updated_at', orderable: false, searchable:false },
            { data: 'status_label', name: 'status', orderable: true, searchable:true },
            { data: 'sp_induks.no_sp', name: 'sp_induks.no_sp', orderable: true, searchable:true },
            { data: 'sp_induks.khs_induks.no_kontrak', name: 'sp_induks.khs_induks.no_kontrak', orderable: true, searchable:true },
            { data: 'json_format.lokasi.length', name: 'json', orderable: false, searchable:true },
            { data: 'json_format.json_sp.json.lokasi.length', name: 'json', orderable: false, searchable:true },
            { data: 'total_sp', name: 'json', orderable: false, searchable:true },
            { data: 'total_rekon', name: 'json', orderable: false, searchable:true },
            
        ],
        initComplete: function(settings){
            table = settings.oInstance.api();
            initSearchCol(table,'#header-filter','search-col-dt');
        }
    });

    

    </script>

@endsection