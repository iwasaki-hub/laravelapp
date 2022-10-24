<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
        *{
            border: 1px solid blue;
            margin: 2%;
            padding: 2%;
            text-align: center;
        }
        body{
            font-size: 16px;
            color: #999999;
            margin: 5px;
        }
        h1{
            font-size: 50px;
            text-align: right;
            color: #f6f6f6;
            margin: -20px 0px -30px 0px;
            letter-spacing: -4px;
        }
        ul{
            font-size: 12px;
        }
        hr{
            margin: 25px 100px;
            border-top: 1px dashed #ddd;
        }
        .menutitle{
            font-size: 14px;
            font-weight: bold;
            margin: 0px;
        }
        .content{
            margin: 10px;
        }
        .footer{
            text-align: right;
            font-size: 10px;
            margin: 10px;
            border-bottom: solid 1px #ccc;
            color: #ccc;
        }
        th{
            background-color: #999;
            color: #fff;
            padding: 5px 10px;
        }
        td{
            border: solid 1px #aaa;
            color: #999;
            padding: 5px 10px;
        }
        nav{
            margin: 3%;
        }
        h3{
            background-color: coral;
            color: white;
        }

    </style>
</head>
<body>
    <a id="trigger" style="
            background-color: #000;
            display: inline-block;
            color: #fff;
            padding: 10px 15px;
            border-radius: 10px;
            margin: 2rem 0;
            cursor: pointer;
    ">最下部へ</a>

    <nav>
        <a href="/helloo">Hello</a>
        <a href="/person">Person</a>
        <a href="/board">Board</a>
    </nav>

    {{-- <h1>@yield('title')</h1>
    @section('menubar')
    <h2 class="menutitle">※メニュー</h2>
    <ul>
        <li>@show</li>
    </ul>
    <hr size="1"> --}}
    <div class="content">
        @yield('content')
    </div>
    <div class="footer">
        <a href="/helloo">Home</a>
        <a href="/helloo/add">Add</a>
        @yield('footer')
    </div>

    <script>
    window.onload = function() {
        var trigger = document.getElementById('trigger');

        trigger.onclick = function() {
            var element = document.documentElement;
            var bottom = element.scrollHeight - element.clientHeight;
            window.scrollTo({top: bottom, left: 0, behavior: 'smooth'});
        }
    }
    </script>
</body>
</html>