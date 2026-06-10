<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $metaDescription ?? 'Cổng thông tin điện tử Văn phòng UBND tỉnh' }}">
        <title>{{ ($metaTitle ?? 'Trang chủ').' - Văn phòng UBND tỉnh' }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background: #f3f6fa;
                color: #1f2937;
            }

            .portal-topbar {
                background: #0b5cab;
                color: #fff;
            }

            .portal-header {
                background: linear-gradient(135deg, #fff 0%, #e8f2ff 100%);
                border-bottom: 1px solid #cfe0f5;
            }

            .portal-brand-title {
                color: #0b3f78;
            }

            .portal-nav {
                background: #0b5cab;
            }

            .portal-nav .nav-link {
                color: #fff;
                font-weight: 600;
            }

            .portal-nav .nav-link:hover,
            .portal-nav .nav-link:focus {
                background: rgba(255, 255, 255, .14);
                color: #fff;
            }

            .section-title {
                border-left: 5px solid #0b5cab;
                padding-left: .75rem;
                color: #0b3f78;
            }

            .article-thumb {
                height: 190px;
                object-fit: cover;
            }

            .featured-thumb {
                min-height: 320px;
                object-fit: cover;
            }

            .pre-line {
                white-space: pre-line;
            }

            .portal-footer {
                background: #0b3f78;
                color: #dbeafe;
            }
        </style>
    </head>
    <body>
        <div class="portal-topbar py-2">
            <div class="container small d-flex justify-content-between">
                <span>Cổng thông tin điện tử</span>
                <span>Văn phòng UBND tỉnh</span>
            </div>
        </div>

        <header class="portal-header py-4">
            <div class="container">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-7">
                        <a href="{{ route('home') }}" class="text-decoration-none">
                            <div class="portal-brand-title h2 fw-bold mb-1">Văn phòng UBND tỉnh</div>
                            <div class="text-uppercase text-muted fw-semibold">Cổng thông tin điện tử</div>
                        </a>
                    </div>
                    <div class="col-lg-5">
                        <form class="d-flex gap-2" method="GET" action="{{ route('frontend.search') }}">
                            <input class="form-control" type="search" name="q" value="{{ request('q') }}" placeholder="Tìm kiếm bài viết">
                            <button class="btn btn-primary px-4" type="submit">Tìm</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <nav class="navbar navbar-expand-lg portal-nav">
            <div class="container">
                <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#frontendNavbar" aria-controls="frontendNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="frontendNavbar">
                    <ul class="navbar-nav me-auto">
                        @if ($mainMenu && $mainMenu->items->isNotEmpty())
                            @foreach ($mainMenu->items as $item)
                                @if ($item->children->isNotEmpty())
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle px-3" href="{{ $item->resolved_url }}" role="button" data-bs-toggle="dropdown" aria-expanded="false" target="{{ $item->safe_target }}" @if ($item->safe_target === '_blank') rel="noopener noreferrer" @endif>
                                            {{ $item->title }}
                                        </a>
                                        <ul class="dropdown-menu">
                                            @foreach ($item->children as $child)
                                                <li>
                                                    <a class="dropdown-item" href="{{ $child->resolved_url }}" target="{{ $child->safe_target }}" @if ($child->safe_target === '_blank') rel="noopener noreferrer" @endif>
                                                        {{ $child->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link px-3" href="{{ $item->resolved_url }}" target="{{ $item->safe_target }}" @if ($item->safe_target === '_blank') rel="noopener noreferrer" @endif>
                                            {{ $item->title }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @else
                        <li class="nav-item"><a class="nav-link px-3" href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="nav-item"><a class="nav-link px-3" href="#">Tin tức - Sự kiện</a></li>
                        <li class="nav-item"><a class="nav-link px-3" href="#">Hoạt động lãnh đạo</a></li>
                        <li class="nav-item"><a class="nav-link px-3" href="#">Chỉ đạo điều hành</a></li>
                        <li class="nav-item"><a class="nav-link px-3" href="#">Liên hệ</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="portal-footer py-4 mt-4">
            <div class="container">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="h5 text-white">Văn phòng UBND tỉnh</div>
                        <div>Cổng thông tin điện tử</div>
                    </div>
                    <div class="col-md-6 small">
                        <div>Địa chỉ: Số 01, đường Trung tâm, phường Trung tâm, tỉnh</div>
                        <div>Điện thoại: 0296 000 000</div>
                        <div>Email: vanphongubnd@example.gov.vn</div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
