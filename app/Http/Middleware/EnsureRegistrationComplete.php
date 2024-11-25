<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRegistrationComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth('web')->check()) return abort(403, 'You dont have access for this request');

        $user = auth('web')->user();

        if ($request->routeIs('team-members*')) {
            $leader = $user?->leader;

            if (is_null($leader)) return to_route('frontend.landing');
        } else if ($request->routeIs('payment-team*')) {
            $member = $user?->member;

            if (is_null($member) || count($member ?? []) == 0) return to_route('team-members');
        } else if ($request->routeIs('team.work')) {
            $leader = $user?->leader;

            if (is_null($leader)) return to_route('frontend.landing');

            $member = $user?->member;

            if (is_null($member) || count($member ?? []) == 0) return to_route('team-members');

            $payment = $leader?->team?->payment;

            if (is_null($payment)) return to_route('payment-team');
        }

        return $next($request);
    }
}
