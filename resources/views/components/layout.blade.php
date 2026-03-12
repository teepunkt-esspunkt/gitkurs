<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title ?? 'TaskApp' }}</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
</head>
<body style="font-family:system-ui; margin:0;">
    <header style="padding:12px 16px; border-bottom:1px solid #ddd;">
        <nav style="display:flex; gap:12px; align-items:center;">
            <a href="/tasks">Tasks</a>
            <a href="/tasks/create">Neu</a>
            @guest
               <a href="/register" class="btn btn-primary">Registrieren</a>
               <a href="/login" class="btn btn-primary">Login</a>
            @endguest
            @auth
               <a href="/logout" class="btn btn-primary">Logout</a>    
               {{ auth()->user()->name }}
            @endauth
            <span style="margin-left:auto; opacity:.7;">TaskApp</span>
        </nav>
    </header>
    @auth

    <div style="width:50%;margin:10px auto; padding:10px; background-color:#b8e0c0;">

        <h2 style="font-size:12px;">Benachrichtigungen</h2>

        @if(auth()->user()->unreadNotifications->count() > 0)

            <ul>

                @foreach(auth()->user()->unreadNotifications as $notification)

                    <li>

                        <a href="{{ $notification->data['url'] }}">{{ $notification->data['message'] }} ({{ $notification->data['title'] }})</a>

                    </li>

                @endforeach

            </ul>

            <a href="/notifications/mark-as-read" class="btn btn-sm btn-outline-secondary">Alle als gelesen markieren</a>

        @else

            <p><em>Keine neuen Benachrichtigungen.</em></p>

        @endif

    </div>

    @endauth

    <main style="max-width:900px; margin:0 auto; padding:16px;">
        @if(session('success'))
            <div style="padding:10px; border:1px solid #b8e0c0; background:#e9f7ee; margin-bottom:16px;">
                {{ session('success') }}
            </div>
        @endif

        {{ $slot }}
    </main>
</body>
</html>
