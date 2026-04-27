@extends('layouts.main')
@section('title', 'Все брони')
@section('content')
<h2>Список всех бронирований</h2>

<div class="card">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #f5f7fa; text-align: left;">
                <th style="padding: 10px; border-bottom: 2px solid #dce1e6;">ID</th>
                <th style="padding: 10px; border-bottom: 2px solid #dce1e6;">Пользователь</th>
                <th style="padding: 10px; border-bottom: 2px solid #dce1e6;">Комната</th>
                <th style="padding: 10px; border-bottom: 2px solid #dce1e6;">Начало</th>
                <th style="padding: 10px; border-bottom: 2px solid #dce1e6;">Конец</th>
                <th style="padding: 10px; border-bottom: 2px solid #dce1e6;">Цена</th>
                <th style="padding: 10px; border-bottom: 2px solid #dce1e6;">Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $booking->id }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">
                    {{ $booking->user->name }}<br>
                    <small style="color:#999">{{ $booking->user->email }}</small>
                </td>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $booking->room->title }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ date('d.m.Y H:i', strtotime($booking->start_time)) }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ date('d.m.Y H:i', strtotime($booking->end_time)) }}</td>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $booking->total_price }} руб.</td>
                <td style="padding: 10px; border-bottom: 1px solid #eee;">
                    <form method="POST" action="{{ route('admin.bookings.delete', $booking->id) }}" onsubmit="return confirm('Удалить эту бронь?');">
                        @csrf
                        <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @if($bookings->isEmpty())
        <p style="padding: 20px; text-align: center; color: #666;">Броней пока нет</p>
    @endif
</div>
@endsection