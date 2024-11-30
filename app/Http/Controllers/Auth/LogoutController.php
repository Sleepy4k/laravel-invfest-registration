<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            $user = auth('web')->user() ?? null;

            if (is_null($user)) return;

            activity('auth')
                ->event('logout')
                ->causedBy($user ?? null)
                ->withProperties([
                    'email' => $user->email,
                    'logged_out_at' => now()->toDateTimeString(),
                ])
                ->log('User ' . $user->email . ' successfully logged out');

            auth('web')->logout();

            $session = $request->session();
            $session->invalidate();
            $session->regenerateToken();

            toast('Berhasil logout', 'success');

            return redirect('/');
        } catch (\Throwable $th) {
            return $this->redirectError($th);
        }
    }
}
