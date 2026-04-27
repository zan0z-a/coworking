@extends('layouts.main')
@section('title', 'Админка')
@section('content')
<h2> Сообщения от пользователей</h2>
@foreach($messages as $msg)
<div class="card">
    <p><strong>{{ $msg->email }}</strong> <small style="color:#666;">{{ $msg->created_at->format('d.m.Y H:i') }}</small></p>
    <p>{{ $msg->question }}</p>
</div>
@endforeach
@endsection