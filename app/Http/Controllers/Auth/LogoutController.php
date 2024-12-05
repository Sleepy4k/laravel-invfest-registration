<?php

namespace App\Http\Controllers\Auth;

use App\Foundations\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
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
