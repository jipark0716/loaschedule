<?php

namespace App\Http\Middleware;

use Closure;

class Ssl
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
        if (parse_url($request->url())['scheme'] == 'http') {
            // return redirect(str_replace('http', 'https', $request->url()));
        }
        return $next($request);
    }
}
