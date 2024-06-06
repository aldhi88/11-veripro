<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File BA</title>


</head>


<body>
    @foreach ($dt['file'] as $i => $item)
        @if ($i==6)
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
