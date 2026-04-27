<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller 
{
    public function register(Request $request) 
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed'
        ], [
            'email.unique' => 'Пользователь с таким email уже существует',
            'password.min' => 'Пароль должен быть не менее 4 символов',
            'password.confirmed' => 'Пароли не совпадают'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('success', 'Регистрация успешна! Теперь войдите в аккаунт');
    }
}