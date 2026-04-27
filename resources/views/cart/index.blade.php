@extends('layouts.main')
@section('title', 'Мои аренды')
@section('content')
<h2>Мои аренды</h2>

@if($bookings->isEmpty())
    <div class="card">
        <p>У вас пока нет активных бронирований.</p>
        <a href="{{ route('shop') }}" class="btn">Перейти к поиску помещений</a>
    </div>
@else
    @foreach($bookings as $booking)
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <div>
                <h3 style="margin: 0 0 10px 0;">{{ $booking->room->title }}</h3>
                <p><strong>Тип аренды:</strong> {{ $booking->rent_type == 'hour' ? 'Почасовая' : 'Посуточная' }}</p>
                <p><strong>Адрес:</strong> {{ $booking->room->address }}</p>
                <p><strong>Часы работы помещения:</strong> {{ $booking->room->work_start }} - {{ $booking->room->work_end }}</p>
                <p><strong>Период:</strong> {{ date('d.m.Y H:i', strtotime($booking->start_time)) }} - {{ date('d.m.Y H:i', strtotime($booking->end_time)) }}</p>
                <p><strong>Стоимость:</strong> {{ $booking->total_price }} руб.</p>
            </div>
            <div style="text-align: right;">
                <form method="POST" action="{{ route('cart.cancel', $booking->id) }}" onsubmit="return confirm('Отменить бронь?');">
                    @csrf
                    <button type="submit" class="btn btn-danger">Отменить</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endif
@endsection