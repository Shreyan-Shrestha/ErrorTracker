<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebLogin extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) : RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' =>'required|min:8',
        ]);

        if (Auth::guard('login')->attempt($credentials, $request->boolean('remember'))){
            $request->session()->regenerate();
            return redirect()->intended(route('applications.index'));
        }
        return back()->withErrors(['email' => 'Wrong email, or password.'])->onlyInput('email');

    }
}
