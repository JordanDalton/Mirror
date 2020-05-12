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
            \Log::info('contains:hellaciousj', [
                'contains' => Str::contains($referer, 'hellaciousj')
            ]);

            if(Str::contains($referer, 'hellaciousj'))
            {
                return response()->json(['DENIED'],403);
            }
        }

        return $next($request);
    }
}
