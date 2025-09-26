<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class CheckAuthenticate
{

    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $password_changed_at = new Carbon(($user->password_changed_at) ? $user->password_changed_at : $user->created_at);
        //dd($user->IsTempPassword);
        if ((Carbon::now()->diffInDays($password_changed_at) >= 90) OR ($user->IsTempPassword == 1)) {
            return redirect()->route('password.expired');
        }
//        $roles = \App\Http\Controllers\HomeController::getAllPermissionsPerUser();

        return $next($request);
    }
}