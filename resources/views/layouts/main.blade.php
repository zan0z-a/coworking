<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Коворкинг')</title>
    <style>
        body { 
            margin: 0; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: #121212;
            color: #e0e0e0;
        }
        .container { display: flex; max-width: 1200px; margin: 0 auto; min-height: 100vh; }
        
        .sidebar { 
            width: 230px; 
            background: #1e1e1e; 
            border-right: 1px solid #333;
            padding: 0;
            flex-shrink: 0;
        }
        .sidebar-header {
            padding: 20px;
            font-weight: bold;
            font-size: 20px;
            border-bottom: 1px solid #333;
            background: #252525;
            color: #fff;
            letter-spacing: 1px;
        }
        .sidebar a { 
            display: block; 
            padding: 14px 20px; 
            color: #b0b0b0; 
            text-decoration: none; 
            border-bottom: 1px solid #2a2a2a;
            font-size: 14px;
        }
        .sidebar a:hover { 
            background: #2c2c2c; 
            color: #fff;
        }
        .sidebar a.active { 
            background: #333; 
            color: #fff;
            border-left: 4px solid #666;
        }
        
        .content { flex: 1; padding: 30px; background: #121212; }
        
        .card { 
            background: #1e1e1e; 
            border: 1px solid #333;
            border-radius: 6px; 
            padding: 25px; 
            margin-bottom: 20px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.3); 
        }
        .card h2, .card h3 {
            margin-top: 0;
            color: #fff;
        }
        
        .btn { 
            background: #333; 
            color: #fff; 
            padding: 10px 20px; 
            border: 1px solid #444; 
            border-radius: 4px; 
            cursor: pointer; 
            text-decoration: none; 
            display: inline-block; 
            font-size: 14px;
        }
        .btn:hover { 
            background: #444; 
            border-color: #555;
        }
        .btn-danger { 
            background: #2d1b1b; 
            border-color: #5c2b2b;
            color: #ff9999;
        }
        .btn-danger:hover { 
            background: #3d2222; 
        }
        
        .error { 
            color: #ffcccc; 
            background: #3a1c1c; 
            padding: 15px; 
            border-radius: 4px; 
            margin-bottom: 20px; 
            border: 1px solid #5c2b2b; 
        }
        .success { 
            color: #ccffcc; 
            background: #1c3a1c; 
            padding: 15px; 
            border-radius: 4px; 
            margin-bottom: 20px; 
            border: 1px solid #2b5c2b; 
        }
        
        input, textarea, select { 
            width: 100%; 
            padding: 12px; 
            margin: 8px 0 20px; 
            background: #252525; 
            border: 1px solid #444; 
            color: #fff;
            border-radius: 4px; 
            box-sizing: border-box; 
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #666;
            background: #2a2a2a;
        }
        label { 
            font-weight: bold; 
            font-size: 13px; 
            color: #888; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .room-grid { 
            display: grid; 
            grid-template-columns: repeat(2, 1fr); 
            gap: 20px; 
        }
        
        .admin-section { 
            border-top: 1px solid #333; 
            margin-top: 20px; 
            padding-top: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            color: #ccc;
        }
        th {
            background: #252525;
            color: #fff;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #444;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #333;
        }
        tr:hover td {
            background: #252525;
        }

        a { color: #aaa; text-decoration: none; }
        a:hover { color: #fff; }
    </style>
</head>
<body class="{{ auth()->check() && auth()->user()->is_admin ? 'admin' : '' }}">
    <div class="container">
        @include('blocks.header')
        <div class="content">
            @if(session('error')) <div class="error">{{ session('error') }}</div> @endif
            @if(session('success')) <div class="success">{{ session('success') }}</div> @endif
            
            @if($errors->any())
                <div class="error">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>