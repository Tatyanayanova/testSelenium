<?php

namespace App\Http\Middleware;


class Test
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    //protected $key;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct()
    {
        //$this->key = $key;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $key = 'no')
    {
        var_dump('test');
        var_dump('keytest',$key);
//        if ($this->auth->guard($guard)->guest()) {
//            return response('Unauthorized.', 401);
//        }

        return $next($request);
    }
}
