<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Traits\SweetAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    use SweetAlert;

    public function create()
    {
        return view('auth.loginn');
    }

    public function store(LoginRequest $request)
    {
        $response = $request->authenticate();

        if ($response) {
            $this->flashError('Whoops! Something went wrong', $response->validator->errors()->first('email'));
            throw $response;
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
