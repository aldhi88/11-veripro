<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('assets/favicon.ico')}}">
    <title>File BA</title>
    <script>
        var userAgent = navigator.userAgent;
        var isChromium = userAgent.includes("Chrome");
    </script>
</head>


<body>
    @foreach ($dt['file'] as $i => $item)
        @if ($item=='6_rekap_lampiran_ba_rekonsiliasi')
            @include('mods.ba.file.inc.index_lanscape_inc')
            <div class="a4">
                @include('mods.ba.file.' . $item)
            </div>
        @else
            @include('mods.ba.file.inc.index_inc')
            <div class="a4">
                @include('mods.ba.file.' . $item)
            </div>
        @endif


    @endforeach

</body>

</html>
