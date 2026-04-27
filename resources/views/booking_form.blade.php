@extends('layouts.main')
@section('title', 'Бронирование: ' . $room->title)
@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2>Оформление аренды</h2>
    <p><strong>Помещение:</strong> {{ $room->title }}</p>
    <p><strong>Тариф:</strong> 
        @if($rentType == 'hour')
            Почасовой ({{ $room->price_hour }} руб/час)
        @else
            Посуточный ({{ $room->price_day }} руб/день)
        @endif
    </p>
    <p><strong>Рабочие часы:</strong> {{ $room->work_start }} - {{ $room->work_end }}</p>

    {{-- Вывод ошибок валидации --}}
    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('room.book', $room) }}">
        @csrf
        <input type="hidden" name="rent_type" value="{{ $rentType }}">

        @if($rentType == 'hour')
            <label>Дата и время начала:</label>
            <input type="datetime-local" name="start_time" required min="{{ date('Y-m-d\TH:i') }}">
            
            <label>Дата и время окончания:</label>
            <input type="datetime-local" name="end_time" required min="{{ date('Y-m-d\TH:i') }}">
            
            <small style="color: #666; display: block; margin-bottom: 15px;">
                Выберите точное время начала и конца аренды.
            </small>

        @else
            <label>Дата аренды:</label>
            <input type="date" name="rent_date" required min="{{ date('Y-m-d') }}">
            <small style="color: #666; display: block; margin-bottom: 15px;">
                При посуточной аренде комната бронируется на весь день (с начала часов работы до окончания)
            </small>
        @endif

        <button type="submit" class="btn" style="width: 100%; margin-top: 20px;">
            Подтвердить бронь
        </button>
        
        <a href="{{ route('room.show', $room) }}" style="display: block; text-align: center; margin-top: 10px; color: #666; text-decoration: none;">Назад</a>
    </form>
</div>
@endsection