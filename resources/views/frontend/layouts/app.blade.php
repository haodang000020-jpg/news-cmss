<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $metaDescription ?? 'Tin tức mới nhất' }}">
        <title>{{ $metaTitle ?? config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-white border-bottom">
            <div class="container">
                <a class="navbar-brand fw-semibold" href="{{ route('home') }}">{{ config('app.name', 'News CMS') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#frontendNavbar" aria-controls="frontendNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="frontendNavbar">
                    <form class="ms-auto d-flex" method="GET" action="{{ route('frontend.search') }}">
                        <input class="form-control me-2" type="search" name="q" value="{{ request('q') }}" placeholder="Tìm kiếm">
                        <button class="btn btn-outline-primary" type="submit">Tìm</button>
                    </form>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="border-top py-4">
            <div class="container text-muted small">
                © {{ date('Y') }} {{ config('app.name', 'News CMS') }}
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
