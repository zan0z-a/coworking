<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller 
{
    public function login(Request $request) 
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ], [
            'password.min' => 'Пароль должен быть не менее 4 символов'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $url = $request->session()->pull('url.intended', '/');
            return redirect($url);
        }

        return back()->withErrors(['email' => 'Неверный email или пароль'])->withInput();
    }
}