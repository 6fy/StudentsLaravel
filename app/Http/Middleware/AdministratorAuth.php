<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class AdministratorAuth
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
        if (!Session()->has('loginId')) {
            return redirect('/login')->with('failed', 'You are not logged in!');
        }

        $user = User::where('id', '=', Session()->get('loginId'))->first();
        if (!$user->is_admin == 1) {
            return redirect('/admin')->with('failed', 'You are not an administrator!');
        }
        
        return $next($request);
    }
}
