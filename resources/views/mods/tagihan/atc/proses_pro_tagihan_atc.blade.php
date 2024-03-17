@section('style')
    <link rel="stylesheet" href="{{asset('assets/libs/trix/cdnjs.cloudflare.com_ajax_libs_trix_1.3.1_trix.min.css')}}" />
@endsection

@section('script')
    <script src="{{asset('assets/libs/trix/cdnjs.cloudflare.com_ajax_libs_trix_1.3.1_trix.min.js')}}"></script>
    <script>
        var trixEditor = document.getElementById("{{ $trixId }}")

        addEventListener("trix-blur", function(event) {
            @this.set('dtTagih.revisi', trixEditor.getAttribute('value'))
        })
    </script>

@endsection
