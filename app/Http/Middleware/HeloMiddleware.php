<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HeloMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // 前処理
        $data =[
            ["name"=>"taro", "mail"=>'taro@yamada'],
            ["name"=>"taro", "mail"=>'taro@yamada'],
            ["name"=>"taro", "mail"=>'taro@yamada']
        ];
        $request->merge(['data'=>$data]);
        // return $next($request);
        // 後処理
        $response = $next($request);
        $content = $response->content();

        $pattern = '/<middleware>(.*)<\/middleware>/i';
        $replace = '<a href="http://$1">$1</a>';
        $content = preg_replace($pattern, $replace, $content);
        $response->setContent($content);
        return $response;
    }
}
