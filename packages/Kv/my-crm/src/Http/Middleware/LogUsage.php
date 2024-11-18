<?php

namespace Kv\MyCrm\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Kv\MyCrm\Models\UsageRequest;

class LogUsage
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
        $response = $next($request);
        $routeName = $request->route() ? $request->route()->getName() : 'unknown';
        $requestTime = Carbon::createFromTimestamp($_SERVER['REQUEST_TIME']);

        UsageRequest::create([
            'host' => (method_exists($request, 'host')) ? $request->host() : $request->getHost(),
            'path' => $request->path(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'route' => $routeName,
            'user_agent' => $request->userAgent(),
            'visitor' => crypt($request->ip(), config('hashing.encryption_key')),
            'response_time' => Carbon::now()->getTimestampMs() - $requestTime->getTimestampMs(),
            'day' => date('l', $requestTime->timestamp),
            'hour' => $requestTime->hour,
        ]);

        return $response;
    }
}
