<?php

namespace App\Http\Middleware;

use Closure;

class FirewallMiddleware
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
        if ($request->header('App-Origin') === null) {
            return res(__('auth.not_allowed'), null, 401);
        }
        if ($request->header('Current-ISO') === null) {
            return res(__('auth.invalid_location'), null, 401);
        }

        $origin = $request->header('App-Origin');
        if (!in_array($origin, config('firewall.origin'))) {
            return res(__('auth.not_allowed'), null, 401);
        }

        session(['iso' => $request->header('Current-ISO')]);
        session(['origin' => $request->header('App-Origin')]);
        session(['uuid' => $request->header('Device-UUID')]);
        session(['manufacturer' => $request->header('Device-Manufacturer')]);
        session(['version' => $request->header('Device-Version')]);
        session(['model' => $request->header('Device-Model')]);
        session(['serial' => $request->header('Device-Serial')]);
        session(['platform' => $request->header('Device-Platform')]);

        saveClient();

        return $next($request);
    }
}
