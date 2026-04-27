@extends('layouts.main')
@section('title', 'Контакты')
@section('content')
<div class="card">
    <h2>Связаться с нами</h2>
    <form method="POST" action="{{ route('contacts') }}">
        @csrf
        <label>Ваш Email:</label>
        <input type="email" name="email" required value="{{ old('email') }}">
        <label>Ваш вопрос:</label>
        <textarea name="question" rows="5" required>{{ old('question') }}</textarea>
        <button type="submit" class="btn">Отправить</button>
    </form>
</div>
@endsection