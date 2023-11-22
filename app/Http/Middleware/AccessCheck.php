<?php

namespace App\Http\Middleware;

use App\Models\Access;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $role_name = $user->role->name;
        $role_id = $user->role->id;

        /* jika role_name yang dipunya user adalah admin maka akan diarahkan ke halaman admin */
        if ($role_name <> '' && $user->status == true) {
            $raw_access = new Access();
            $access = $raw_access->with(['menu'])->where('roles_id', $role_id)->get();
            view()->share('access', $access);
            return $next($request);
        } else {
            // ? logout auth contains user
            auth()->logout();
            
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman tersebut');
        }   
        return $next($request);
    }
}
