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
        

        @if ($data['page']=='my-account')
            
            @livewire('account.my-account')
            @livewire('components.modal-password')
        
        @elseif ($data['page'] == 'create')

            @livewire('account.form-account')
        
        @elseif ($data['page'] == 'index')

            @livewire('account.data-account')
            @livewire('account.delete-account')
            @livewire('components.modal-confirm')
        
        @elseif ($data['page'] == 'edit')

            @livewire('account.edit-account',['data' => $data])

        @elseif ($data['page'] == 'mitra')

            @livewire('account.data-mitra')
            @livewire('components.modal-confirm')
            @livewire('account.delete-mitra')

        @elseif ($data['page'] == 'change-pass-mitra')

            @livewire('account.change-pass-mitra',['data' => $data])

        
        @elseif ($data['page'] == 'mitra-pending')

            @livewire('account.data-mitra-pending')
            @livewire('components.modal-confirm')
            @livewire('account.approve-mitra')
            @livewire('account.delete-mitra')
        
        @endif

    </div>
</div>

@endsection