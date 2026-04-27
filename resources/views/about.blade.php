@extends('layouts.main')
@section('title', 'О нас')
@section('content')
<div class="card">
    <h2>О нашем коворкинге</h2>
    <p>Мы предоставляем современные пространства для работы, встреч и мероприятий. Наши помещения оборудованы всем необходимым: быстрый интернет, проекторы, кофе-поинт, зона отдыха.</p>
    <p>Работаем ежедневно с 8:00 до 22:00</p>
    <p>Телефон: +7 (999) 123-45-67</p>
    <p>Email: info@coworking.ru</p>
</div>

<div class="card">
    <h3>Наше расположение</h3>
    <iframe 
        src="https://yandex.ru/map-widget/v1/?ll=53.208330%2C56.852220&z=13&l=map" 
        width="100%" 
        height="400" 
        frameborder="0" 
        style="border:0; border-radius: 8px;">
    </iframe>
    <p style="margin-top: 10px; font-size: 13px; color: #666;">г. Ижевск, ул. Кирова, 1 (офис 101)</p>
</div>
@endsection