@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    <script>
        var trixEditor = document.getElementById("{{ $trixId }}")

        addEventListener("trix-blur", function(event) {
            @this.set('dtTagih.revisi', trixEditor.getAttribute('value'))
        })
    </script>

@endsection
