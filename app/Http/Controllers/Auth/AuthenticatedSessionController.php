<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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

        $user = auth()->user();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->event('login')
            ->useLog('auth')
            ->withProperties([
                'meta' => [
                    'ip' => $request->ip(),
                    'agent' => $request->userAgent(),
                ]
            ])
            ->log('login');

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = auth()->user();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->event('logout')
            ->useLog('auth')
            ->withProperties([
                'meta' => [
                    'ip' => $request->ip(),
                    'agent' => $request->userAgent(),
                ]
            ])
            ->log('logout');

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
