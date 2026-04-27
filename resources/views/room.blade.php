@extends('layouts.main')
@section('title', $room->title)
@section('content')
<div class="card">
    <h2>{{ $room->title }}</h2>
@if($room->image) 
    <img src="{{ asset('storage/' . $room->image) }}" style="max-width:100%; border-radius:4px; margin: 10px 0;"> 
@endif

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
        <div>
            <p><strong>Тип:</strong> {{ $room->type->name }}</p>
            <p><strong>Адрес:</strong> {{ $room->address }}</p>
            <p><strong>Вместимость:</strong> {{ $room->capacity }} чел.</p>
            <p><strong>Часы работы:</strong> {{ $room->work_start }} - {{ $room->work_end }}</p>
        </div>
        <div>
            <p><strong>Цена за час:</strong> {{ $room->price_hour }} руб.</p>
            @if($room->price_day)
                <p><strong>Цена за день:</strong> {{ $room->price_day }} руб.</p>
            @endif
        </div>
    </div>
    
    <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
    <p><strong>Описание:</strong> {{ $room->description }}</p>

    <div style="margin-top: 30px; display: flex; gap: 15px;">
        @auth
            <a href="{{ route('room.booking.form', ['room' => $room, 'type' => 'hour']) }}" class="btn" style="flex: 1; text-align: center;">
                Арендовать на час
            </a>
            @if($room->price_day)
                <a href="{{ route('room.booking.form', ['room' => $room, 'type' => 'day']) }}" class="btn" style="flex: 1; text-align: center; background: #5181b8;">
                    Арендовать на день
                </a>
            @endif
        @else
            <div style="width: 100%; text-align: center; padding: 20px; background: #f0f2f5; border-radius: 4px;">
                <p><a href="{{ route('login') }}">Войдите</a>, чтобы арендовать помещение</p>
            </div>
        @endauth
    </div>
</div>
@endsection