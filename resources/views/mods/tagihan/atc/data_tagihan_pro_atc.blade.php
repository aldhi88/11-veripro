@section('style')
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        
    <script>

        $('.select2-dt').select2();

        $("#historyModal").on("show.bs.modal", function(e) {
            var id = $(e.relatedTarget).data('id');
            Livewire.dispatch('detaistatustagihan-prepare', {id:id});
        });

        $("#fileBaModal").on("show.bs.modal", function(e) {
            var id = $(e.relatedTarget).data('id');
            Livewire.dispatch('fileba-setup', {data:id});
        });


        var dtTable = $('#myTable').DataTable({
            processing: true,serverSide: true,pageLength: 25,sDom: 'lrtip',
            order: [[0, 'desc']],
            columnDefs: [
                { className: 'text-center', targets: ['_all'] },
            ],
            ajax: '{{ route("tagihan.indexPro.dt") }}',
            columns: [
                { data: 'action', name: 'created_at', orderable: true, searchable:false},
                { data: 'sp_induks.khs_induks.json', name: 'sp_induks.khs_induks.json', orderable: false, searchable:true ,render: function (data, type, row) {
                    const decodedJsonString = data.replace(/&quot;/g, '"');
                    const jsonObject = JSON.parse(decodedJsonString);
                    return jsonObject.perusahaan;
                }},
                { data: 'sp_induks.no_sp', name: 'sp_induks.no_sp', orderable: false, searchable:true },
                { data: 'sp_induks.khs_induks.no', name: 'sp_induks.khs_induks.no', orderable: false, searchable:true },
                { data: 'json_format.dt_sp.json.dtLokasi.lokasi.length', name: 'json', orderable: false, searchable:true },
                { data: 'json_format.dt_tagihan.dt_lokasi.grand_total', name: 'json', orderable: false, searchable:false, render: function (data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        return data.toLocaleString('id-ID');;
                    }
                    return data;
                }},
                { data: 'json_format.dt_tagihan.dt_lokasi.grand_total_rekon', name: 'json', orderable: false, searchable:false, render: function (data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        return data.toLocaleString('id-ID');;
                    }
                    return data;
                }},
                { data: 'status_label', name: 'status', orderable: true, searchable:true },
            ],
            initComplete: function(settings){
                table = settings.oInstance.api();
                initSearchCol(table,'#header-filter','search-col-dt');
            }
        });

    

    </script>

@endsection