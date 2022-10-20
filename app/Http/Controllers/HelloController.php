<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HelloController extends Controller
{
   public function index(Request $request, Response $response, $id="zero"){

    $date = [
        "msg"=>"", 
        "id"=>$request->id
    ];
    $data = [
        "one", "two","three","four"
    ];

    return view("hello.index", $date, ["data"=>$data]);
    return 
    $html = <<<EOF
    <html>
    <head>
    <title>Hello/Index</title>
    <style>
    body{z
        font-size: 16pt;
        color:#999;
    }
    h1{
        font-size:120pt;
        text-align:right;
        color: gray;
        margin:-50px 0px -120px 0px;
    }
    </style>
    </head>
    <body>
        <h1>Hello</h1>
        <h3>Request</h3>
        <pre>{$request}</pre>
        <h3>Response</h3>
        <pre>{$response}</pre>
        <p>{$request->url()}</p>
        <p>{$request->fullUrl()}</p>
        <p>{$request->path()}</p>
        <p>{$response->status()}</p>
    </body>
    </html>
    EOF;

    $response->setContent($html);
    return $response;
   }

//    POST送信された時の処理
   public function post(Request $request){
        $msg = $request->msg;
        $data =[
            "msg"=>"こんにちは" . $msg . "さん！", 
        ];
        return view("hello.index", $data);
   }


  
     
}
