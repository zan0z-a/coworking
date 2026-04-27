<aside class="sidebar">
    <div class="sidebar-header">Coworking</div>
    
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Главная</a>
    <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop') && !request('type') ? 'active' : '' }}">Все помещения</a>
    
    @php $types = \App\Models\RoomType::all(); @endphp
    @foreach($types as $type)
        <a href="{{ route('shop', ['type' => $type->id]) }}" class="{{ request()->routeIs('shop') && request('type') == $type->id ? 'active' : '' }}">{{ $type->name }}</a>
    @endforeach
    
    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">О нас</a>
    <a href="{{ route('contacts') }}" class="{{ request()->routeIs('contacts') ? 'active' : '' }}">Контакты</a>
    
    @auth
        <div style="margin-top: 20px; border-top: 1px solid #333;"></div>
        
        <a href="{{ route('cart.index') }}" class="{{ request()->routeIs('cart.*') ? 'active' : '' }}">Мои аренды</a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        
        @if(auth()->user()->is_admin)
            <div style="margin-top: 20px; border-top: 1px solid #333;"></div>
            
            <a href="{{ route('admin.index') }}">Сообщения</a>
            <a href="{{ route('admin.rooms') }}">Комнаты</a>
            <a href="{{ route('admin.bookings') }}">Все брони</a>
        @endif
    @else
        <div style="margin-top: 20px; border-top: 1px solid #333;"></div>
        
        <a href="{{ route('login') }}">Вход</a>
        <a href="{{ route('register') }}">Регистрация</a>
    @endauth
</aside>