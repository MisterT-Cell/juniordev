<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        if (auth()->user()->is_blocked) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Je account is geblokkeerd.');
        }
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Geen toegang.');
        }
        return $next($request);
    }
}
