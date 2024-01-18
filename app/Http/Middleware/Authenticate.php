<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
      /**
         * CHECKING REDIRECT FOR JSON RESPONSE From API OR WEB MIDDLEWARE
         */
        if(empty($request->header('Authorization')) &&  in_array('api',$request->route()->getAction('middleware'))){
            abort(response()->json([
                    'status' => false,
                    'message' => 'UnAuthenticated',
                ], Response::HTTP_UNAUTHORIZED));
        }else{ 
            if (! $request->expectsJson()) {
                return route('login'); 
            } 
        }   
    }
}
