<?php

namespace App\Providers;

use App\Http\Validators\HelloValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HelloServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer(
            // "hello.index", function($view){
            //     $view->with("view_message", "composer message!");
            // }

            "hello.index", 'App\Http\Composers\HelloComposer'
        );

        $validator = $this->app['validator'];
        $validator->resolver(function($translator, $data, $rules, $messages)
        {
            return new HelloValidator($translator, $data, $rules, $messages);
        });
        
        Validator::extend("hello", function($attribute, $value, $parameters, $validator){
            return $value % 2 == 0;
        });
    }
}
