<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExampleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {     
        //var_dump('key',$key);
        var_dump($request->route()[2]['key']);
        $user = new User();
        if($request->input('key')){
            if(!$user->authkey($request->input('key'))){
                return 'OK :)!';
            } 
        }
        return $next($request);
    }
}
