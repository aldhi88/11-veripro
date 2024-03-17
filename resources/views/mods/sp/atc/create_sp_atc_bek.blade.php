@section('style')
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <script>
        $('#select2-mitra').select2();
        $('#select2-mitra').on('change', function (e) {
            var val = $('#select2-mitra').select2("val");
            var selectedText = $(this).find("option:selected").text();
            if (val !== '') {
                $(this).find('option[value=""]').remove();
            }
            $("#select2-khs").attr('disabled', false);
            @this.set('dt.mitra_id', val);
            // @this.set('dt_sp.nama_mitra', selectedText);
            @this.dispatch('createsp-pickMitra');
        });

        window.addEventListener('livewire:initialized', () => {
            @this.on('createspatc-generateKhs', (param) => {
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
        $('#select2-khs').on('change', function (e) {
            var data = $('#select2-khs').select2("val");
            if (data !== '') {
                $(this).find('option[value=""]').remove();
            }
            @this.set('dt.khs_induk_id', data);
            @this.dispatch('createsp-pickKhs');
        });

        // window.addEventListener('livewire:initialized', () => {
        //     @this.on('init-select2', (param) => {
        //         var index = 'select_'+param.data.lokasi+'_'+param.data.row
        //         $('#'+index).select2();
        //         $('#'+index).empty();
        //         var newOption = new Option('Pilih', '', false, true);
        //         $('#'+index).append(newOption);

        //         var data = param.data.desigs;
        //         data.forEach(item => {
        //             var nama_material = (item.nama_material==null)?'':(item.nama_material)+', ';
        //             var nama_jasa = (item.nama_jasa==null)?'':(item.nama_jasa)+', ';
        //             var nama = (item.nama==null)?'-':item.nama;
        //             var designator = nama_material+nama_jasa+nama;
        //             var newOption = new Option(designator, item.id, false, false);
        //             $('#'+index).append(newOption);
        //         });

        //         if('selected' in param.data){ //if call from delete location
        //             $('#'+index).val(param.data.selected);
        //             $('#'+index).trigger('change');
        //         }

        //         $('#'+index).on('change', function (e) {
        //             var lokasi = $(e.currentTarget).attr('data-lokasi');
        //             var row = $(e.currentTarget).attr('data-row');
        //             var val = $('#'+index).select2("val");
        //             @this.set('dt_desigs.'+lokasi+'.desig_items.'+row+'.id', parseInt(val));
        //             if (val !== '') {
        //                 $(this).find('option[value=""]').remove();
        //             }
        //             var dt = {
        //                 indexLokasi : lokasi,
        //                 indexRow : row,
        //                 value: val
        //             }
        //             @this.dispatch('createsp-onSelectDesignatorJs', {param:dt});
        //         });
                
        //     });
        // })

        // window.addEventListener('livewire:initialized', () => {
        //     @this.on('init-select2-after', (param) => {
        //         @this.dispatch('createsp-initSelect2', {data:param.data});
        //     });
        // })

        // window.addEventListener('livewire:initialized', () => {
        //     @this.on('createsp-reselected', (param) => {

        //         if(param.data.row == 0){ //if from delete location

        //             var dataLocation = param.data.locations;
        //             dataLocation.forEach(function(itemLocation, iLok) {
        //                 if(iLok >= param.data.lokasi){
        //                     var dataRow = itemLocation.desig_items;
        //                     dataRow.forEach(function(itemRow, iRow) {
        //                         var index = '#select_'+iLok+'_'+iRow
        //                         @this.dispatch('createsp-initSelect2', {data:{lokasi:iLok, row:iRow, selected:itemRow.id}});
        //                     });
        //                 }
        //             });

        //         }else{ //if from delete desigs row

        //             var data = param.data.desigs;
        //             data.forEach(function(item, i) {
        //                 if(i >= param.data.row){
        //                     var index = '#select_'+param.data.lokasi+'_'+i
        //                     $(index).val(item.id);
        //                     $(index).trigger('change');

        //                     var indexBoxMat = '#boxmat_'+param.data.lokasi+'_'+i;
        //                     if(item.boxmat == ""){
        //                         $(indexBoxMat).prop('checked', false);
        //                     }

        //                     var indexBoxJas = '#boxjas_'+param.data.lokasi+'_'+i;
        //                     if(item.boxjas == ""){
        //                         $(indexBoxJas).prop('checked', false);
        //                     }
        //                 }
        //             });

        //         }
        //     });
        // })

        

    </script>

@endsection

