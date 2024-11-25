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
        if (!auth('web')->check()) {
            return abort(403, 'You dont have access for this request');
        }

        $user = auth('web')->user();
        $leader = $user?->leader;
        $team = $leader?->team;
        $payment = $team?->payment;
        $memberCount = $team?->member?->count() ?? 0;

        if ($request->routeIs('team-members*')) {
            if (is_null($leader)) {
                return to_route('frontend.landing');
            } elseif ($memberCount > 0) {
                return to_route('payment-team');
            }
        } elseif ($request->routeIs('payment-team*')) {
            if ($memberCount === 0) {
                return to_route('team-members');
            } elseif (!is_null($payment)) {
                return to_route('team.dashboard');
            }
        } elseif ($request->routeIs('team.work*') || $request->routeIs('team.dashboard')) {
            if (is_null($leader)) {
                return to_route('frontend.landing');
            } elseif ($memberCount === 0) {
                return to_route('team-members');
            } elseif (is_null($payment)) {
                return to_route('payment-team');
            } elseif (!is_null($payment) && $payment?->status && $request->routeIs('team.work')) {
                return to_route('team.dashboard');
            }
        }

        return $next($request);
    }
}
