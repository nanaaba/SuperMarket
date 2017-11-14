<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace App\Http\Middleware;

use Closure;

class CheckUserSession 
{

    public function handle($request, Closure $next)
    {
         if (!$request->session()->exists('setupdata')) {
            // user value cannot be found in session
            return redirect('/');
        }

        return $next($request);
    }

}