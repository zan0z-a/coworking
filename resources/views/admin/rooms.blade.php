@extends('layouts.main')
@section('title', 'Управление комнатами')
@section('content')
<h2>Добавить комнату</h2>
<div class="card">
    <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
        @csrf
        <label>Тип помещения:</label>
        <select name="room_type_id" required>
            @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
        <label>Название:</label>
        <input type="text" name="title" required>
        <label>Адрес:</label>
        <input type="text" name="address" required>
        <label>Цена за час (₽):</label>
        <input type="number" name="price_hour" required>
        <label>Цена за день (₽, необязательно):</label>
        <input type="number" name="price_day">
        
        <label>Изображение:</label>
        <input type="file" name="image" accept="image/*">
        
        <label>Описание:</label>
        <textarea name="description"></textarea>
        <label>Вместимость:</label>
        <input type="number" name="capacity" value="1" min="1">
        <label>Начало рабочего дня:</label>
        <input type="time" name="work_start" value="08:00" required>
        <label>Конец рабочего дня:</label>
        <input type="time" name="work_end" value="22:00" required>
        <button type="submit" class="btn">Добавить</button>
    </form>
</div>

<h2>Список комнат</h2>
@foreach($rooms as $room)
<div class="card">
    @if($room->image)
        <img src="{{ asset('storage/' . $room->image) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; float: left; margin-right: 15px;">
    @endif
    <strong>{{ $room->title }}</strong> ({{ $room->type->name }})<br>
    {{ $room->address }} | {{ $room->price_hour }} ₽/час<br>
    Часы работы: {{ $room->work_start }} - {{ $room->work_end }}
    <form method="POST" action="{{ route('admin.rooms.delete', $room) }}" style="display:inline; margin-top: 10px;" onsubmit="return confirm('Удалить?')">
        @csrf @method('DELETE')
        <button type="submit" style="background:#e64646; color:#fff; border:none; padding:5px 10px; border-radius:4px; cursor:pointer;">Удалить</button>
    </form>
    <div style="clear:both;"></div>
</div>
@endforeach
@endsection