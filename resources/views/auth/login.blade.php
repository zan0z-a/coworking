@extends('layouts.main')
@section('title', 'Вход')
@section('content')
<div class="card" style="max-width: 400px; margin: 0 auto;">
    <h2>Вход</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Пароль (мин. 4 символа):</label>
        <input type="password" name="password" required minlength="4">
        <button type="submit" class="btn">Войти</button>
    </form>
</div>
@endsection