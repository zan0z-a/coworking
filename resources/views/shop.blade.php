@extends('layouts.main')
@section('title', 'Все помещения')
@section('content')
<h2>Доступные помещения</h2>
<div class="room-grid">
    @foreach($rooms as $room)
    <div class="card">
@if($room->image)
    <img src="{{ asset('storage/' . $room->image) }}" style="width:100%; height: 160px; object-fit: cover; border-radius:4px; margin-bottom: 10px;">
@endif
        <h3>{{ $room->title }}</h3>
        <p><strong>Тип:</strong> {{ $room->type->name }}</p>
        <p><strong>Адрес:</strong> {{ $room->address }}</p>
        <p><strong>Часы работы:</strong> {{ $room->work_start }} - {{ $room->work_end }}</p>
        <p><strong>Цена:</strong> {{ $room->price_hour }} ₽/час @if($room->price_day)| {{ $room->price_day }} ₽/день @endif</p>
        <a href="{{ route('room.show', $room) }}" class="btn">Подробнее</a>
    </div>
    @endforeach
</div>
@endsection