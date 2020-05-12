<?php

namespace App\Http\Middleware;

use Closure;

class SpammerCheck
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
        $referer = request()->headers->get('referer');

        if($referer)
        {
            \Log::info('referer', compact('referer'));

            if($referer === 'https://rirofiwal.cf')
            {
                return response()->json(['DENIED'],403);
            }
        }

        return $next($request);
    }
}
