<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello/Index</title>
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
    <h1>Index</h1>
    <p>This is a sample page with php-template.</p>
    <p><?php echo $msg;?></p>
    <p><?php echo date("y年n月j日"); ?></p>
    <p>ID=<?php echo $id; ?></p>
    
</body>
</html>