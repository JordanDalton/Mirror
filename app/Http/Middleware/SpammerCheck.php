<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

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

        \Log::info('referer', compact('referer'));

        if($referer)
        {
            \Log::info('contains:rirofiwal', [
                'contains' => Str::contains($referer, 'rirofiwal')
            ]);

            if(Str::contains($referer, 'rirofiwal'))
            {
                return response()->json(['DENIED'],403);
            }
        }

        return $next($request);
    }
}
