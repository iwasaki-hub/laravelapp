<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello/Rest</title>
    <style>
        body{
            font-size: 16px;
            color: #999;
            margin: 5px;
        }
        h1{
            font-size: 50px;
            text-align: right;
            color: #464242;
            margin: 20px 0px 30px 0px;
            letter-spacing: 4px;
        }
        th{
            background-color: #999;
            color: #fff;
            padding: 5px 10px;
        }
        td{
            border: 1px solid #aaa;
            color: #999;
            padding: 5px 10px;
        }
        .content{
            margin: 10px;
        }
    </style>
</head>
<body>
    <h1>Rest</h1>

    @include('rest.create')
    
</body>
</html>