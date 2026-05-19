<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\UserAuthenticationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserAuthenticationController extends Controller
{
    public function isLoggedIn(): View|RedirectResponse
    {
        if (Auth::guard('user')->check())
        {
            return redirect()->route('application.index');
        }
        return view('auth.index');
    }

    public function login(UserAuthenticationRequest $request): RedirectResponse
    {
        $credentials = $request->only('email','password');
        if (Auth::guard('login')->attempt($credentials, $request->boolean('remember'))){
            $request->session()->regenerate();
            return redirect()->intended(route('application.index'));
        }
        return back()->withErrors(['email' => 'Wrong email, or password.'])->onlyInput('email');
    }

    public function logout( UserAuthenticationRequest $request)
    {
        Auth::guard('login')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('appliction.index');
    }
}
