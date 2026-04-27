@extends('layouts.main')
@section('title', 'Регистрация')
@section('content')
<div class="card" style="max-width: 400px; margin: 0 auto;">
    <h2>Регистрация</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Имя:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Пароль (мин. 4 символа):</label>
        <input type="password" name="password" required minlength="4">
        <label>Повторите пароль:</label>
        <input type="password" name="password_confirmation" required minlength="4">
        <button type="submit" class="btn">Зарегистрироваться</button>
    </form>
</div>
@endsection