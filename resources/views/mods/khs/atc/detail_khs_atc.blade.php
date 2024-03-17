@section('style')
        <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')

    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        
    <script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('reloadDt', (param) => {
            var dt = param.data;
            dataId = dt.dataId;
            route = dt.route;
            table.ajax.url(route).load();
        });
    
        var dataId = {{$dtKhs['id']}};
        var route = '{{ route("khs.detailKhsIndukDt") }}';
    
        var dtTable = $('#myTable').DataTable({
            processing: true,serverSide: true,pageLength: 10,
            order: [[0, 'asc']],
            columnDefs: [
                { className: 'text-center', targets: ['_all'] },
            ],
            ajax: {
                url: route,
                data: function(d){ 
                    d.dataId = dataId;
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'id', orderable: true, searchable:false },
                { data: 'nama_material', name: 'nama_material', orderable: true, searchable:true },
                { data: 'nama_jasa', name: 'nama_jasa', orderable: true, searchable:true },
                { data: 'nama', name: 'nama', orderable: true, searchable:true },
                { data: 'uraian', name: 'uraian', orderable: false, searchable:false,render: function(data, type, row) 
                    {
                        var el = '<span title="'+data+'">'+data.substring(0, 20)+'...</span>'
                        return el;
                    }
                },
                { data: 'satuan', name: 'satuan', orderable: false, searchable:false },
                { data: 'material', name: 'material', orderable: false, searchable:false,render: function(data, type, row) 
                    {return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");}
                },
                { data: 'jasa', name: 'jasa', orderable: false, searchable:false,render: function(data, type, row) 
                    {return data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");}
                },
                { data: 'fix_price', name: 'fix_price', orderable: false, searchable:false },
            ],
            initComplete: function(settings){
                table = settings.oInstance.api();
                initSearchCol(table,'#header-filter','search-col-dt');
    
                $('table').on('change', 'input[type="checkbox"]', function() {
                    var dt = {
                        val: $(this).val(),
                        id: $(this).attr('key'),
                        table: $(this).attr('table')
                    };
                    @this.dispatch('detailkhs-changeFixPrice',{'dt':dt});
                });
            }
        });
    })

    </script>

@endsection

