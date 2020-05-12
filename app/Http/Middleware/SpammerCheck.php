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

        $bad_actors = [
            'rirofiwal',
            'hellaciousj'
        ];

        if($referer)
        {
            $contains_bad_actors = Str::contains($referer, $bad_actors);

            \Log::info('contains:'.$referer, compact('contains_bad_actors'));

            if($contains_bad_actors)
            {
                //return response()->json(['DENIED' => $referer],403);
            }
        }

        return $next($request);
    }
}
