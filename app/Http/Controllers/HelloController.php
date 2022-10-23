<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelloRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class HelloController extends Controller
{
   public function index(Request $request, Response $response, $id="zero"){
       
    // クッキーを保存
    if($request->hasCookie("msg")){
        $msg = "Cookie: " . $request->cookie("msg");
    }else{
        $msg = "Cookieはありません。";
    }

    $date = [
        // "msg"=>"hi", 
        "id"=>$request->id
    ];
    // $data = [
    //     "one", "two","three","four"
    // ];
    $data = [
        ["name"=>"山田たろう", "mail"=>"taro@yamada"],
        ["name"=>"山田たろう", "mail"=>"taro@yamada"],
        ["name"=>"山田たろう", "mail"=>"taro@yamada"]
    ];

    $validator = Validator::make($request->query(), [
        'id' => 'required',
        'pass' => 'required',
    ]);

    if($validator->fails()){
        $msg = 'クエリーに問題があります。';
    } else {
        $msg = "ID/PASSを受けました。フォームを入力下さい。";
    };


    return view("hello.index", $date, ["data"=>$data,"message"=>"Hello!", "data"=>$request->data, "msg" =>$msg,]);
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

//    POST送信（バリデーション）
   public function postValidate(HelloRequest $request){
    // $validate_rule =[
    //     "name" => "required",
    //     "mail" => 'email',
    //     "age" => 'numeric|between:0,150',
    // ];
    // バリデーションの実行
    // $this->validate($request, $validate_rule);

    
    $rules = [
        "name" => "required",
        "mail" => "email",
        "age" => "numeric|between:0,150",
    ];
    
    $messages = [
        "name.required" => "名前は必ず入れてください",
        "mail.email" => "メールアドレスが必要です。",
        "age.numeric" => "年齢を整数で記入してください。",
        "age.min" => "年齢はゼロ歳以上を記入下さい",
        "age.max" => "年齢は200歳以下を記入下さい",
        "age.between" => "年齢は0～150の間で入力下さい。",
    ];
    
    
    $validator = Validator::make($request->all(), $rules, $messages);

    // ルールを追加
    $validator->sometimes("age", "min:0", function($input) {
        return !is_int($input->age);
    });

    $validator->sometimes("age", "max:200", function($input) {
        return !is_int($input->age);
    });
    


    if($validator->fails()){
        return redirect('/helloo')->withErrors($validator)->withInput();
    }
    return view('hello.index', ['msg'=>"successfully!"]);
   }

   public function postCookie(Request $request)
   {
     $validate_rule = [
        "msg" => "required",
     ];

     $this->validate($request, $validate_rule);
     $msg = $request->msg;
     $response = response()->view('hello.index', [
        "msg" => '『' . $msg . '』をクッキーにほぞんしました。'
     ]);
     $response->cookie("msg", $msg, 100);
     return $response;
   }


  
     
}
