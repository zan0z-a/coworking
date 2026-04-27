@extends('layouts.main')
@section('title', 'Главная')
@section('content')
<div class="card">
    <h2>Добро пожаловать в наш коворкинг</h2>
    <p>Арендуйте переговорные, рабочие места и конференц-залы по выгодным ценам.</p>
    <a href="{{ route('shop') }}" class="btn">Посмотреть все помещения</a>
</div>

<h3 style="margin: 25px 0 15px;">Рекомендуемые помещения</h3>
<div class="room-grid">
    @foreach($featuredRooms as $room)
    <div class="card">
        @if($room->image)
            <img src="{{ asset('storage/' . $room->image) }}" style="width:100%; height: 160px; object-fit: cover; border-radius:4px; margin-bottom: 10px;">
        @endif
        <h3>{{ $room->title }}</h3>
        <p><strong>Тип:</strong> {{ $room->type->name }}</p>
        <p><strong>Адрес:</strong> {{ $room->address }}</p>
        <p><strong>Часы работы:</strong> {{ $room->work_start }} - {{ $room->work_end }}</p>
        <p><strong>Цена:</strong> {{ $room->price_hour }} руб/час @if($room->price_day)| {{ $room->price_day }} руб/день @endif</p>
        <a href="{{ route('room.show', $room) }}" class="btn">Подробнее</a>
    </div>
    @endforeach
</div>
@endsection