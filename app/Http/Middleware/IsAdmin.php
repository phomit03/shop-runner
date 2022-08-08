<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        //kiem tra da dang nhap hay chua
        if (!Auth::check()){     //chua
            return redirect()->route("login");  //tra ve lai login (middleware = auth)
        } else {
            $user = Auth::user();
            if (!$user->isAdmin){  //neu khong phai admin
                abort(404);
            }
        }

        return $next($request);
    }
}
