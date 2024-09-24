@section('style')
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script>
        $('#select2-mitra').select2();
        $('#select2-khs').val('{{$dt["mitra_id"]}}').trigger('change');
        $('#select2-mitra').on('change', function (e) {
            var val = $('#select2-mitra').select2("val");
            var selectedText = $(this).find("option:selected").text();
            if (val !== '') {
                $(this).find('option[value=""]').remove();
            }
            $("#select2-khs").attr('disabled', false);
            @this.set('dt.mitra_id', val);
            // @this.set('openTglSpToc', null);
            // @this.set('dt.mitra_id', val);
            @this.dispatch('editsp-pickMitra');
        });

        window.addEventListener('livewire:initialized', () => {
            @this.on('editspatc-generateKhs', (param) => {
                $('#select2-khs').select2();
                $('#select2-khs').empty();
                var newOption = new Option('Pilih', "", false, true);
                $('#select2-khs').append(newOption);
                var data = param.data;
                data.forEach(item => {
                    var newOption = new Option(item.no, item.id, false, false);
                    $('#select2-khs').append(newOption);
                });
            });
        })

        $('#select2-khs').select2();
        $('#select2-khs').val('{{$dt["khs_induk_id"]}}').trigger('change');
        $('#select2-khs').on('change', function (e) {
            var data = $('#select2-khs').select2("val");
            if (data !== '') {
                $(this).find('option[value=""]').remove();
            }
            @this.set('dt.khs_induk_id', data);
            @this.dispatch('editsp-pickKhs');
        });

    </script>

@endsection

