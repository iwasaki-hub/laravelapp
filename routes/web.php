<?php

use App\Http\Controllers\HelloController;
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

Route::get("/helloo/{id?}", [HelloController::class, "index"]);

Route::post("/helloo",[HelloController::class, "post"]);


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

