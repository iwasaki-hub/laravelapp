<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// global 変数
global $head, $style, $body, $end;
$head='<html></head>';
$style=<<<EOF
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
EOF;
$body= '</head><body>';
$end='</body></html>';

function tag($tag, $txt){
    return "<{$tag}>" . $txt . "</{$tag}>";
};



class HelloController extends Controller
{
    public function index($id='noname', $pass='unknown') {
        return <<<EOF
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
            <h1>Index</h1>
            <p>これは、Helloコントローラのindexアクションです。</p>
            <ul>
            <li>ID: {$id}</li>
            <li>PASS: {$pass}</li>
            </ul>
        </body>
        </html>
        EOF;
    }

    public function index2(){
        global $head, $style, $body, $end;
        
        $html = $head . tag('title', 'Hello/Index') . $style . $body . tag("h1", "Index") . tag('p', 'This is Index page') . '<a href="/hello3/other">go to other page</a>' . $end;

        return $html;
    }

    public function other(){
        global $head, $style, $body, $end;
        
        $html = $head . tag('title', 'Hello/Other') . $style . $body . tag("h1", "Other") . tag('p', 'This is Other page') . '<a href="/hello3/index">go to index page</a>' . $end;

        return $html;

    }

    


    
}
