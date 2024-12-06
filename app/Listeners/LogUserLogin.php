<?php

namespace App\Listeners;

use App\Enums\ActivityEventType;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class LogUserLogin
{
    /**
     * Create the event listener.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return void
     */
    public function __construct(
        public Request $request
    ) {}

    /**
     * Handle the event.
     *
     * @param  Login  $event
     *
     * @return void
     */
    public function handle(Login $event): void
    {
        $user = $event?->user;
        $ip = $this->request->ip();
        $userAgent = $this->request->userAgent();

        $causedBy = $user?->id ?? 1;
        $message = 'User '.($user?->email ?? 'unknown').' successfully logged in';
        $properties = [
            'email' => $user?->email,
            'email_verified_at' => $user?->email_verified_at ? date('d F Y', strtotime($user->email_verified_at)) : null,
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'login_at' => now()->toDateTimeString()
        ];

        activity('auth')
            ->event(ActivityEventType::LOGIN->value)
            ->causedBy($causedBy)
            ->withProperties($properties)
            ->log($message);
    }
}
