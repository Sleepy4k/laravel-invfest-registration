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
            return abort(403, 'You dont have access to this request');
        }

        $user = auth('web')->user();
        $leader = $user ? $user->leader : null;
        $team = $leader ? $leader->team : null;
        $payment = $team ? $team->payment : null;
        $memberCount = 0;

        if ($team && $team->member) {
            $memberCount = $team->member->count();
        }

        if ($request->routeIs('team-members*')) {
            if (is_null($leader)) {
                return to_route('frontend.landing');
            }

            if ($memberCount > 0) {
                return to_route('payment-team');
            }
        }

        if ($request->routeIs('payment-team*')) {
            if ($memberCount === 0) {
                return to_route('team-members');
            }

            if (!is_null($payment)) {
                return to_route('team.dashboard');
            }
        }

        if ($request->routeIs('team.work*') || $request->routeIs('team.dashboard')) {
            if (is_null($leader)) {
                return to_route('frontend.landing');
            }

            if ($memberCount === 0) {
                return to_route('team-members');
            }

            if (is_null($payment)) {
                return to_route('payment-team');
            }

            if (!is_null($payment) && $payment?->status == 'pending' && $request->routeIs('team.work*')) {
                return to_route('team.dashboard');
            }
        }

        return $next($request);
    }
}
