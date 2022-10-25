<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\PersonCOntroller;
use App\Http\Controllers\RestappController;
use App\Http\Middleware\HeloMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

$html = <<<EOF
<html>
    <head>
        <title>Hello</title>
        <style>
        body{
            font-size: 16px;
            color:#999;
        }
        h1{
            font-size:100pt;
            text-align:right;
            color:#eee;
            margin:-40px 0px -50px 0px;
        }
        </style>
    </head>
    <body>
        <h1>Hello</h1>
        <p>This is sample page.</p>
        <p>これは、サンプルで作ったページです。</p>
    </body>
</html>
EOF;

// Auth
Route::get('/hello/auth', [HelloController::class, "getAuth"]);
Route::post('/hello/auth', [HelloController::class, "postAuth"]);


// Person
Route::get('/person', [PersonCOntroller::class, "index"]);
Route::get('/person/find', [PersonCOntroller::class, "find"]);
Route::post('/person/find', [PersonCOntroller::class, "search"]);
Route::get('/person/add', [PersonCOntroller::class, 'add']);
Route::post('/person/add', [PersonCOntroller::class, 'create']);
Route::get('/person/edit', [PersonCOntroller::class, 'edit']);
Route::post('/person/edit', [PersonCOntroller::class, 'update']);
Route::get('/person/del', [PersonCOntroller::class, 'delete']);
Route::post('/person/del', [PersonCOntroller::class, 'remove']);

// Borad
Route::get('/board', [BoardController::class, "index"]);
Route::get('/board/add', [BoardController::class, "add"]);
Route::post('/board/add', [BoardController::class, "create"]);

// RestApp
Route::resource("rest", RestappController::class);
Route::get('/hello/rest', [HelloController::class, "rest"]);

// Session
Route::get('/hello/session', [HelloController::class, "session_get"]);
Route::post('/hello/session', [HelloController::class, "session_put"]);





// DBセクション
Route::get("/helloo/add", [HelloController::class, "add"]);
Route::post("/helloo/add", [HelloController::class, "create"]);

Route::get('/helloo/edit', [HelloController::class, "edit"]);
Route::post('/helloo/edit', [HelloController::class, "update"]);

Route::get('/helloo/del', [HelloController::class, "del"]);
Route::post('/helloo/del', [HelloController::class, "remove"]);

Route::get('/helloo/show',  [HelloController::class, "show"]);



Route::get("/helloo/{id?}", [HelloController::class, "index"])->middleware('hello')->middleware('auth');

// middlewareを利用する
// Route::get("/helloo/{id?}", [HelloController::class, "index"])->middleware(HeloMiddleware::class);

// Cookie
Route::post("/helloo",[HelloController::class, "postCookie"]);

// Validate
// Route::post("/helloo",[HelloController::class, "postValidate"]);


Route::get("/hello", function () {
    return view('hello.index');
});

// ヒアドキュメント
Route::get("/hello2", function () use ($html){
    return $html;
});

//　パラメーターを利用する デフォルトの設置
Route::get("/hello/{msg?}", function ($msg="no message.") {

    $html = <<<EOF
    <html>
        <head>
            <title>Hello</title>
            <style>
            body{
                font-size: 16px;
                color:#999;
            }
            h1{
                font-size:100pt;
                text-align:right;
                color:#eee;
                margin:-40px 0px -50px 0px;
            }
            </style>
        </head>
        <body>
            <h1>Hello</h1>
            <p>This is sample page.</p>
            <p>{$msg}</p>
            <p>これは、サンプルで作ったページです。</p>
        </body>
    </html>
    EOF;
    return $html;
});

// バージョン８以降
// Route::get('/hello3', 'App\Http\Controllers\HelloController@index');
Route::get('/hello3/index', [HelloController::class, 'index2']);
Route::get('/hello3/other', [HelloController::class, 'other']);
Route::get('/hello3/{id?}/{pass?}', [HelloController::class, 'index']);




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
