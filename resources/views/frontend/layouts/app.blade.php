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

            .featured-carousel {
                border-radius: .35rem;
            }

            .featured-carousel-image {
                height: 430px;
                object-fit: cover;
                width: 100%;
            }

            .featured-carousel-caption {
                background: #fff;
            }

            .featured-carousel-title {
                line-height: 1.3;
            }

            .featured-carousel .carousel-control-prev,
            .featured-carousel .carousel-control-next {
                bottom: auto;
                top: 190px;
                width: 3rem;
            }

            .featured-carousel .carousel-control-prev-icon,
            .featured-carousel .carousel-control-next-icon {
                background-color: rgba(11, 92, 171, .8);
                background-size: 60%;
                border-radius: 999px;
                height: 2rem;
                width: 2rem;
            }

            .pre-line {
                white-space: pre-line;
            }

            .news-ticker {
                align-items: center;
                background: #fff;
                border: 1px solid #d8e6f5;
                display: flex;
                flex: 1 1 auto;
                min-width: 0;
                overflow: hidden;
            }

            .news-ticker-label {
                background: #0b5cab;
                color: #fff;
                flex: 0 0 auto;
                font-size: .875rem;
                font-weight: 700;
                padding: .45rem .7rem;
            }

            .news-ticker-track {
                flex: 1 1 auto;
                min-width: 0;
                overflow: hidden;
                white-space: nowrap;
            }

            .news-ticker-content {
                animation: newsTicker 18s linear infinite;
                display: inline-block;
                padding-left: 100%;
                white-space: nowrap;
            }

            .news-ticker:hover .news-ticker-content {
                animation-play-state: paused;
            }

            .news-ticker-link {
                color: #b42318;
                font-size: .95rem;
                font-weight: 600;
                text-decoration: none;
            }

            .news-ticker-link:hover,
            .news-ticker-link:focus {
                color: #0b5cab;
                text-decoration: underline;
            }

            @keyframes newsTicker {
                from {
                    transform: translateX(0);
                }

                to {
                    transform: translateX(-100%);
                }
            }

            .portal-section {
                background: #fff;
                border: 1px solid #d8e6f5;
                box-shadow: 0 .25rem .75rem rgba(15, 64, 112, .06);
            }

            .portal-section-title {
                background: #0b5cab;
                color: #fff;
                font-size: 1rem;
                font-weight: 700;
                margin: 0;
                padding: .75rem 1rem;
                text-transform: uppercase;
            }

            .document-list .document-item {
                border-bottom: 1px solid #e5edf7;
                padding: .85rem 1rem;
            }

            .document-list .document-item:last-child {
                border-bottom: 0;
            }

            .document-list .document-icon {
                color: #0b5cab;
                flex: 0 0 auto;
                font-size: .85rem;
                margin-top: .2rem;
            }

            .utility-grid {
                display: grid;
                gap: .75rem;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                padding: 1rem;
            }

            .lookup-card {
                align-items: center;
                border: 1px solid #d7e5f4;
                color: #0b3f78;
                display: flex;
                font-weight: 600;
                min-height: 72px;
                padding: .8rem;
                text-decoration: none;
                transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
            }

            .lookup-card:hover,
            .lookup-card:focus {
                border-color: #8bb8e8;
                box-shadow: 0 .35rem .8rem rgba(11, 92, 171, .12);
                color: #06396e;
                transform: translateY(-2px);
            }

            .lookup-card.lookup-blue {
                background: #eef7ff;
            }

            .lookup-card.lookup-red {
                background: #fff1f1;
                color: #9b1c1c;
            }

            .lookup-card.lookup-orange {
                background: #fff7e6;
                color: #915b00;
            }

            .portal-news-box,
            .portal-sidebar-box {
                background: #fff;
                border: 1px solid #d8e6f5;
                height: 100%;
            }

            .portal-news-box .box-body,
            .portal-sidebar-box .box-body {
                padding: 1rem;
            }

            .portal-news-box .featured-image,
            .portal-sidebar-box .featured-image {
                aspect-ratio: 16 / 9;
                object-fit: cover;
                width: 100%;
            }

            .portal-news-box .news-list-item,
            .portal-sidebar-box .news-list-item {
                border-bottom: 1px solid #e5edf7;
                padding: .65rem 0;
            }

            .portal-news-box .news-list-item:last-child,
            .portal-sidebar-box .news-list-item:last-child {
                border-bottom: 0;
                padding-bottom: 0;
            }

            .work-schedule-box,
            .school-links-box {
                background: #fff;
                border: 1px solid #d8e6f5;
                box-shadow: 0 .25rem .75rem rgba(15, 64, 112, .06);
            }

            .homepage-middle-banner {
                border: 1px solid #d8e6f5;
                border-radius: .35rem;
                box-shadow: 0 .25rem .75rem rgba(15, 64, 112, .08);
                overflow: hidden;
            }

            .work-schedule-banner {
                border: 1px solid #d8e6f5;
                border-radius: .35rem;
                box-shadow: 0 .25rem .75rem rgba(15, 64, 112, .08);
                overflow: hidden;
            }

            .work-schedule-banner .carousel-item {
                transition: transform 1s ease-in-out;
            }

            .work-schedule-banner a {
                display: block;
            }

            .homepage-middle-banner-image {
                height: 150px;
                object-fit: cover;
                width: 100%;
            }

            .work-schedule-banner-image {
                border-radius: .35rem;
                height: 150px;
                object-fit: cover;
                width: 100%;
            }

            .homepage-middle-banner-caption {
                background: rgba(11, 63, 120, .86);
                bottom: 0;
                color: #fff;
                font-size: .9rem;
                font-weight: 600;
                left: 0;
                padding: .45rem .75rem;
                position: absolute;
                right: 0;
            }

            .work-schedule-table {
                border-color: #e5edf7;
                font-size: .95rem;
            }

            .work-schedule-table th {
                color: #0b3f78;
            }

            .work-schedule-table tbody th {
                white-space: nowrap;
                width: 28%;
            }

            .school-link-card {
                align-items: center;
                background: #f8fbff;
                border: 1px solid #d8e6f5;
                color: #0b3f78;
                display: flex;
                gap: .75rem;
                margin-bottom: .75rem;
                padding: .65rem;
                text-decoration: none;
                transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
            }

            .school-link-card:last-child {
                margin-bottom: 0;
            }

            .school-link-card:hover,
            .school-link-card:focus {
                border-color: #8bb8e8;
                box-shadow: 0 .35rem .8rem rgba(11, 92, 171, .12);
                color: #06396e;
                transform: translateY(-2px);
            }

            .school-link-image {
                background: #e8f2ff;
                border-radius: .35rem;
                flex: 0 0 74px;
                height: 54px;
                object-fit: cover;
                width: 74px;
            }

            @media (max-width: 575.98px) {
                .featured-carousel-image {
                    height: 260px;
                }

                .featured-carousel .carousel-control-prev,
                .featured-carousel .carousel-control-next {
                    top: 115px;
                }

                .homepage-middle-banner-image {
                    height: 110px;
                }

                .work-schedule-banner-image {
                    height: 110px;
                }

                .homepage-middle-banner-caption {
                    font-size: .8rem;
                    padding: .35rem .55rem;
                }

                .utility-grid {
                    grid-template-columns: 1fr;
                }

                .work-schedule-table th {
                    white-space: normal;
                }

                .school-link-card {
                    align-items: flex-start;
                }
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
