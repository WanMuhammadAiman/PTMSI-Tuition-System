<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $role = $request->user()->role;

    switch ($role) {
        case 'admin':
            return redirect('/admin/dashboard');
        case 'tutor':
            return redirect('/tutor/dashboard');
        case 'student':
            return redirect('/student/dashboard');
        default:
            return redirect('/');
    }
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
{
    switch ($user->role) {
        case 'admin':
            return redirect('/admin/dashboard');
        case 'tutor':
            return redirect('/tutor/dashboard');
        case 'student':
            return redirect('/student/dashboard');
        default:
            return redirect('/'); // fallback
    }
}



}
