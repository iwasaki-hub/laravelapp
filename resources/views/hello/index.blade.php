<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            font-size: 16px;
            color: #999;
        }
        h1{
            font-size: 100px;
            text-align: right;
            color: gray;
            margin: 50px 0px 5r0px 0px;
        }
    </style>
</head>
<body>
    <h1>Blade/Index</h1>
    <p>{{$msg}}</p>
    {{-- <p>{{$id}}</p> --}}
    <hr>

    {{-- @ifディレクティブ --}}
    @if ($msg != '')
        <p>Hello, {{$msg}}</p>
    @else
        <p>Input your name from if ディレクティブ</p>
    @endif

    {{-- @issetディレクティブ --}}
    @isset($msg)
    <p>Hello, {{$msg}} from isset ディレクティブ</p>
    @else
    <p>Input your name from isset ディレクティブ</p>
    @endisset
    
    {{-- @foreachディレクティブ --}}
    <p>&#064;foreachディレクティブの例</p>
    <ol>
        @foreach ($data as $item)
            <li>{{$item}}</li>
        @endforeach
    </ol>

    {{-- @forディレクティブ --}}
    <p>&#064;forディレクティブの例</p>
    <ol>
        @for ($i = 1; $i < 100; $i++)

        @if ($i % 2 == 1)
            @continue
        @elseif ($i <= 10)
        <li>No, {{$i}}</li>
        @else
            @break
        @endif
        @endfor
    </ol>

    {{-- $loopディレクティブ --}}
    <p>&#064;loopディレクティブの例</p>
    @foreach ($data as $item)

    @if ($loop->first)
    <p>※データ一覧</p><ul>   
    @endif
    <li>No, {{$loop->iteration}} . {{$item}}</li>
    @if ($loop->last)
    </ul><p>---ここまで</p>
    @endif
    @endforeach

    {{-- $whileディレクティブ --}}
    <p>&#064;whileディレクティブの例</p>
    <ol>
        @php
            $counter = 0;
        @endphp
        @while ($counter < count($data))
            <li>{{$data[$counter]}}</li>
        @php
            $counter++;
        @endphp    
        @endwhile
    </ol>

    {{-- /hellooにPOSTされる --}}
    <form method="POST" action="/helloo">
        {{-- Bladeディレクティブ --}}
        {{-- CSRF対策 --}}
        @csrf
        <input type="text" name="msg">
        <input type="submit">
        

    </form>
</body>
</html>


