<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Error 404</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{ env('APP_DESC') }}" name="description" />
        <meta content="{{ env('APP_AUTHOR') }}" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/mine/google.font.css') }}" rel="stylesheet" type="text/css" />

        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <div class="my-5 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center my-5">
                            <h1 class="font-weight-bold text-error">4 <span class="error-text">0<img src="{{ asset('assets/images/error-img.png') }}" alt="" class="error-img"></span> 4</h1>
                            <h3 class="text-uppercase">Maaf, halaman tidak ditemukan</h3>
                            <div class="mt-5 text-center">
                                <a class="btn btn-primary waves-effect waves-light" href="{{ route('dashboard.index') }}">Kembali ke Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    </body>
</html>
