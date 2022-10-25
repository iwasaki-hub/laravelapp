<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelloRequest;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HelloController extends Controller
{

   public function index(Request $request, Response $response, $id="zero"){

    function noUse() {
        
        // クエリビルダ
        // 並び順 orderBy()
        $items = DB::table('people')->orderBy("age", "asc")->get();

    }

    // rogin
    $user = Auth::user();
    $sort = $request->sort;
    $items = Person::orderBy($sort, "asc")->simplePaginate(5);
    $param = ['items' => $items, "sort" => $sort, 'user' => $user];
    return view('hello.index', $param);

    


    //　ペジネーション
    $items = DB::table("people")->simplePaginate(5);
    //　ペジネーション(昇順)
    $items = DB::table("people")->orderBy("age", "asc")->simplePaginate(5);
    //　ペジネーション(昇順) Personクラスからでも可能
    $items = Person::orderBy("age", "asc")->simplePaginate(5);

    // sort
    $sort = $request->sort;
    // $items = DB::table('people')->orderBy($sort, "asc")->simplePaginate(5);
    $items = Person::orderBy($sort, "asc")->simplePaginate(5);
    $param = ['items' => $items, 'sort' => $sort];
    return view('hello.index',$param, ['items' => $items, "msg" => "クエリビルダ"]);

    
    
    
    // DBへのアクセス
    if(isset($request->id)){
        $param = ['id' => $request->id];
        $items = DB::select("select * from people where id = :id", $param);
    }else{
        $items = DB::select("select * from people");
    }

    

       
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


    return view("hello.index", $date, ["data"=>$data,"message"=>"Hello!", "data"=>$request->data, "msg" =>$msg, "items" => $items]);
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

//    入力フォームの表示
   public function add(Request $request)
   {
    return view('hello.add');
   }

//    Createメソッド
   public function create(Request $request)
   {
     $param = [
        'name' => $request->name,
        "mail" => $request->mail,
        "age" => $request->age,
     ];

    //  旧
     DB::insert('INSERT INTO people (name, mail, age) values (:name, :mail, :age)', $param);

    //  クエリビルダでの記述
    DB::table("people")->insert($param);

     return redirect('/helloo');
   }

   public function edit(Request $request)
   {
    //  旧
    $param = ['id' => $request->id];
    $item = DB::select("SELECT * FROM people WHERE id = :id", $param);

    //  クエリビルダでの記述
    $item = DB::table("people")->where("id", $request->id)->first();


    // return view('hello.edit', ['form' => $item[0]]);
    return view('hello.edit', ['form' => $item]);
   }

   public function update(Request $request)
   {
    $param = [
        "id" => $request->id,
        "name" => $request->name,
        "mail" => $request->mail,
        "age" => $request->age,
    ];

    //  旧
    DB::update("UPDATE people SET name = :name, mail = :mail, age = :age WHERE id = :id", $param);

    //  クエリビルダでの記述
    DB::table("people")->where("id", $request->id)->update($param);

    return redirect('/helloo');
   }

   public function del(Request $request)
   {

    //  旧
    $param = ['id' => $request->id];
    $item = DB::select("SELECT * FROM people WHERE id = :id", $param);

    //  クエリビルダでの記述
    $item = DB::table("people")->where("id", $request->id)->first();


    // return view('hello.delete', ['form' => $item[0]]);
    return view('hello.delete', ['form' => $item]);
   }

   public function remove(Request $request)
   {

    //  旧
    $param = ['id' => $request->id];
    DB::delete("DELETE FROM people WHERE id = :id", $param);

    //  クエリビルダでの記述
    DB::table('people')->where('id', $request->id)->delete();


    return redirect('/helloo');
   }

   public function show(Request $request)
   {
    $id = $request->id;
    // 最初のレコードだけを返す first() オブジェクトが戻ってくる
    $item = DB::table("people")->where("id", $id)->first();
    // 複数のレコードを取得
    $items = DB::table("people")->where("id", '<=', $id)->get();
    // 複数の条件
    $name = $request->name;
    $items = DB::table("people")->where("name", 'like', '%' . $name . '%')->orWhere("mail", 'like', '%' . $name . '%')->get();
    // whereRaw
    $min = $request->min;
    $max = $request->max;
    $items = DB::table("people")->whereRaw("age >= ? and age <= ?", [$min, $max])->get();
    // offset limit
    $page = $request->page;
    $items = DB::table("people")->offset($page * 3)->limit(3)->get();


    return view('hello.show', ['item' => $item, 'items' => $items]);
   }

    //    RestApp
   public function rest(Request $request){
    return view('hello.rest');
   }

    //    session
   public function session_get(Request $request){
    $sessionData = $request->session()->get("msg");
    return view('hello.session', ['session_data' => $sessionData]);
   }

   public function session_put(Request $request){
    $msg = $request->input;
    $request->session()->put("msg", $msg);
    return redirect('/hello/session');
   }

    //    auth関連
    public function getAuth(Request $request){
        $param =['message' => 'ログインしてください。'];
        return view('hello.auth', $param);
    }

    public function postAuth(Request $request){
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $msg = 'ログインしました。（' . Auth::user()->name . '）';
        }else{
            $msg = 'ログインに失敗しました。';
        }
        return view('hello.auth', ['message' => $msg]);
    }





  
     
}
