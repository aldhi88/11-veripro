@section('style')
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <script>
        // $('#datatable').DataTable();

        $('#select2-mitra').select2();
        $('#select2-mitra').on('change', function (e) {
            var data = $('#select2-mitra').select2("val");
            @this.set('dt.auth_login_id', data);
            @this.dispatch('createkhs-pickMitra');
        });

        

    </script>

@endsection

