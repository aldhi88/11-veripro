<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>{{$data['title']}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="{{ env('APP_DESC') }}" name="description" />
        <meta content="{{ env('APP_AUTHOR') }}" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">


        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/mine/google.font.css') }}" rel="stylesheet" type="text/css" />

        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/mine/style.css') }}" rel="stylesheet" type="text/css" />


    </head>

    <body class="auth-body-bg">
        <div class="loading"><div class="loader"></div></div>

        {{-- <div class="home-btn d-none d-sm-block">
            <a href="index.html"><i class="mdi mdi-home-variant h2 text-white"></i></a>
        </div> --}}
        <div>
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col{{$data['page'] != 'register'?'-lg-4':null}}">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col{{$data['page'] == 'register'?'-md-6':null}}">
                                        <div>

                                            @yield('content')
                                            
                                        </div>
                                        
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="logo"><img src="{{ asset('assets/images/logo-dark.png') }}" height="45" alt="logo"></a>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>

                    

                    @if ($data['page'] != 'register')

                        <div class="col-lg-8">
                            <div class="authentication-bg">
                                <div class="bg-overlay"></div>
                            </div>
                        </div>
                        
                    @endif
                    
                </div>
                
            </div>
            
        </div>

        

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('assets/mine/script.js') }}"></script>


    </body>
</html>
