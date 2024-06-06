@extends('components.layouts.app',["data" => $data])

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">{{$data['title']}}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{$data['title']}}</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col">


        @if ($data['page']=='index')

            @livewire('tagihan.data-tagihan-mitra')
            @livewire('components.modal-confirm')
            @livewire('tagihan.delete-tagihan')
            @livewire('tagihan.detail-status-tagihan')
            @livewire('ba.file-ba',['data' => $data])

        @elseif ($data['page']=='index-user')

            @livewire('tagihan.data-tagihan-user')
            @livewire('tagihan.detail-status-tagihan')

        @elseif ($data['page']=='index-pro')

            @livewire('tagihan.data-tagihan-pro')
            @livewire('tagihan.detail-status-tagihan')
            @livewire('ba.file-ba',['data' => $data])

        @elseif ($data['page'] == 'create')

            @livewire('tagihan.create-tagihan',['data' => $data])

        @elseif ($data['page'] == 'edit')

            @livewire('tagihan.edit-tagihan',['data' => $data])

        @elseif ($data['page'] == 'invoice')

            @livewire('tagihan.invoice-tagihan',['data' => $data])

        @elseif ($data['page'] == 'invoice-revisi')

            @livewire('tagihan.invoice-revisi-tagihan',['data' => $data])

        @elseif ($data['page'] == 'revisi')

            @livewire('tagihan.revisi-tagihan',['data' => $data])

        @elseif ($data['page'] == 'proses-user')

            @livewire('tagihan.proses-user-tagihan',['data' => $data])
            @livewire('components.modal-password')

        @elseif ($data['page'] == 'proses-pro')

            @livewire('tagihan.proses-pro-tagihan',['data' => $data])
            @livewire('components.modal-password')

        @elseif ($data['page'] == 'proses2-pro')

            @livewire('tagihan.proses2-pro-tagihan',['data' => $data])
            @livewire('components.modal-password')

        @elseif ($data['page'] == 'detail')

            @livewire('tagihan.detail-tagihan',['data' => $data])

        @elseif ($data['page'] == 'detail')

            @livewire('khs.detail-khs',['param' => $data])

        @endif

    </div>
</div>

@endsection
