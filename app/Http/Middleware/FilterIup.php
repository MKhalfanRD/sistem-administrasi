<?php

namespace App\Http\Middleware;

use App\Models\IUP;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FilterIup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        $iup = IUP::where('user_id', $user->id)->get();

        $request->merge(['iup' => $iup]);

        return $next($request);
    }
}
