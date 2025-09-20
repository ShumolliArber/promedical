<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login()
  {
    if (Auth::check())
      return redirect('/dashboard');

    return view('page.login');
  }

  public function doLogin(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email', 'max:255'],
      'password' => ['required', 'string', 'max:255'],
      'remember' => ['nullable', 'boolean']
    ]);
    unset($credentials['remember']);

    if (Auth::attempt($credentials, $request->remember)) {
      $request->session()->regenerate();

      if (!empty(auth()->user()->company_id))
        session(['company_id' => auth()->user()->company_id]);
      else {
        $firstCompanies = auth()->user()->companies()->first();
        if (!empty($firstCompanies))
          session(['company_id' => $firstCompanies->id]);
      }

      return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.'
    ])->onlyInput('email');
  }

  public function logout(Request $request)
  {
    $locale = session('locale');

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    session(['locale' => $locale]);

    return redirect('/');
  }
}
