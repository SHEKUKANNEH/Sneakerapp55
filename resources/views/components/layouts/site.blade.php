<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'SneakerApp' }}</title>
        <style>
            body { font-family: Arial, Helvetica, sans-serif; background: #f6f7fb; margin: 0; color: #1f2937; }
            header { background: #111827; color: #fff; }
            .container { max-width: 960px; margin: 0 auto; padding: 20px; }
            nav { display: flex; gap: 14px; align-items: center; flex-wrap: wrap; }
            nav a { color: #fff; text-decoration: none; font-weight: 600; }
            nav a:hover { text-decoration: underline; }
            .nav-right { margin-left: auto; display: flex; gap: 14px; align-items: center; }
            .card { background: #fff; border-radius: 10px; padding: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
            .grid { display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); }
            .btn { display: inline-block; padding: 8px 12px; border-radius: 6px; border: 1px solid #111827; background: #111827; color: #fff; text-decoration: none; font-weight: 600; }
            .btn.secondary { background: #fff; color: #111827; }
            .btn.danger { background: #b91c1c; border-color: #b91c1c; }
            form.inline { display: inline; }
            input, textarea, select { width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #d1d5db; }
            label { font-weight: 600; display: block; margin-bottom: 6px; }
            .stack { display: grid; gap: 12px; }
            .flash { padding: 10px 14px; background: #dcfce7; border: 1px solid #86efac; border-radius: 6px; margin-bottom: 12px; }
            .error { color: #b91c1c; font-size: 0.9rem; }
            img.sneaker { width: 100%; border-radius: 8px; aspect-ratio: 4 / 3; object-fit: cover; }
            .muted { color: #6b7280; }
            .toast { position: fixed; top: 20px; right: 20px; background: #10b981; color: #fff; padding: 12px 16px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); z-index: 1000; display: flex; align-items: center; gap: 12px; min-width: 250px; animation: slideIn 0.3s ease-out; }
            .toast.hiding { animation: slideOut 0.3s ease-in forwards; }
            @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
            @keyframes slideOut { from { transform: translateX(0); opacity: 1; } to { transform: translateX(100%); opacity: 0; } }
            .toast-close { background: none; border: none; color: #fff; font-size: 18px; cursor: pointer; padding: 0; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; }
            .toast-close:hover { opacity: 0.8; }
            #delete-modal { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <a href="{{ route('home') }}">SneakerApp</a>

                    <div class="nav-right">
                        @auth
                            <a href="{{ route('orders.index') }}">My Orders</a>
                            <span class="muted">Hi, {{ auth()->user()->name }}</span>
                            <form class="inline" method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn secondary" type="submit">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @endauth
                    </div>
                </nav>
            </div>
        </header>
        <main class="container">
            {{ $slot }}
        </main>
        
        @if (session('status'))
            <div class="toast" id="status-toast">
                <span>{{ session('status') }}</span>
                <button class="toast-close" onclick="closeToast()" aria-label="Close">×</button>
            </div>
            <script>
                function closeToast() {
                    const toast = document.getElementById('status-toast');
                    if (toast) {
                        toast.classList.add('hiding');
                        setTimeout(() => toast.remove(), 300);
                    }
                }
                
                // Auto-hide after 4 seconds
                setTimeout(() => {
                    closeToast();
                }, 4000);
            </script>
        @endif
    </body>
</html>

