<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaDescription ?? 'Cổng thông tin điện tử Phòng Văn Hóa - Xã Hội' }}">
    <title>{{ ($metaTitle ?? 'Trang chủ') . ' - Phòng Văn Hóa - Xã Hội' }}</title>
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

        .site-header-banner {
            background: #eef5ff;
            border-bottom: 1px solid #cfe0f5;
        }

        .site-header-banner-carousel .carousel-item {
            transition: transform 1s ease-in-out;
        }

        .site-header-banner-link {
            display: block;
        }

        .site-header-banner-image {
            display: block;
            height: 150px;
            object-fit: cover;
            width: 100%;
        }

        .portal-nav {
            background: transparent;
            padding-top: 0;
            padding-bottom: 0;
        }

        .portal-nav .container {
            padding-left: var(--bs-gutter-x, .75rem);
            padding-right: var(--bs-gutter-x, .75rem);
        }

        .portal-nav-bar {
            background: #0b5cab;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 52px;
            width: 100%;
        }

        .portal-nav .navbar-collapse {
            justify-content: center;
        }

        .portal-nav .navbar-nav {
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
        }

        .portal-nav .nav-link {
            color: #fff;
            font-weight: 600;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .portal-nav .nav-link:hover,
        .portal-nav .nav-link:focus {
            background: rgba(255, 255, 255, .14);
            color: #fff;
        }

        @media (max-width: 991.98px) {
            .portal-nav-bar {
                justify-content: flex-start;
                padding: .5rem .75rem;
            }

            .portal-nav .navbar-nav {
                margin-left: 0;
                margin-right: 0;
            }
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

        .featured-news-carousel {
            border-radius: .35rem;
        }

        .featured-news-carousel .carousel-inner {
            border-radius: .35rem;
        }

        .featured-news-carousel .carousel-item {
            backface-visibility: hidden;
            transition: transform 1.1s ease-in-out;
            will-change: transform;
        }

        .featured-news-image {
            display: block;
            height: 430px;
            object-fit: cover;
            width: 100%;
        }

        .featured-carousel-caption {
            background: #fff;
        }

        .featured-carousel-title {
            font-size: 25px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-weight: 700;
        }

        .featured-news-carousel .carousel-control-prev,
        .featured-news-carousel .carousel-control-next {
            bottom: auto;
            top: 190px;
            width: 3rem;
        }

        .featured-news-carousel .carousel-control-prev-icon,
        .featured-news-carousel .carousel-control-next-icon {
            background-color: rgba(11, 92, 171, .8);
            background-size: 60%;
            border-radius: 999px;
            height: 2rem;
            width: 2rem;
        }

        .home-main-grid .featured-news-image {
            height: 380px;
        }

        .home-main-grid .featured-news-carousel .carousel-control-prev,
        .home-main-grid .featured-news-carousel .carousel-control-next {
            top: 165px;
        }

        /* .featured-news-column,
            .latest-news-column,
            .hotline-column {
                min-width: 0;
            } */

        .latest-news-column .list-group-item {
            font-size: .94rem;
        }

        .hotline-box {
            background: #fff;
            border: 1px solid #d8e6f5;
            box-shadow: 0 .25rem .75rem rgba(15, 64, 112, .06);
            height: 100%;
        }

        .hotline-title {
            background: #0b5cab;
            color: #fff;
            font-size: .95rem;
            font-weight: 700;
            line-height: 1.35;
            margin: 0;
            padding: .75rem 1rem;
            text-transform: uppercase;
        }

        .hotline-item {
            border-bottom: 1px solid #e5edf7;
            color: #1f2937;
            font-size: .94rem;
            line-height: 1.5;
            padding: .75rem 1rem;
        }

        .hotline-item:last-of-type {
            border-bottom: 0;
        }

        .hotline-note {
            background: #f5f9ff;
            border-left: 4px solid #0b5cab;
            color: #475569;
            font-size: .9rem;
            line-height: 1.55;
            margin: 0 1rem 1rem;
            padding: .75rem;
        }

        .hotline-actions {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            padding: 0 1rem 1rem;
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
            padding: .5rem 0;

            min-width: 0;
            color: #172b3d !important;
            opacity: 1 !important;
            visibility: visible !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            line-height: 1.4 !important;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
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

        @media (max-width: 991.98px) {
            .featured-news-image {
                height: 320px;
            }

            .home-main-grid .featured-news-image {
                height: 320px;
            }

            .featured-news-carousel .carousel-control-prev,
            .featured-news-carousel .carousel-control-next {
                top: 135px;
            }

            .home-main-grid .featured-news-carousel .carousel-control-prev,
            .home-main-grid .featured-news-carousel .carousel-control-next {
                top: 135px;
            }
        }

        @media (max-width: 575.98px) {
            .featured-news-image {
                height: 220px;
            }

            .home-main-grid .featured-news-image {
                height: 220px;
            }

            .featured-news-carousel .carousel-control-prev,
            .featured-news-carousel .carousel-control-next {
                top: 85px;
            }

            .home-main-grid .featured-news-carousel .carousel-control-prev,
            .home-main-grid .featured-news-carousel .carousel-control-next {
                top: 85px;
            }

            .homepage-middle-banner-image {
                height: 110px;
            }

            .work-schedule-banner-image {
                height: 110px;
            }

            .site-header-banner-image {
                height: 100px;
            }

            .site-footer-inner {
                min-height: auto;
                padding: 1.5rem 0 1rem;
            }

            .site-footer::after {
                height: 150px;
                right: -2rem;
                top: 1rem;
                width: 150px;
            }

            .site-footer-title {
                font-size: 1rem;
            }

            .back-to-top {
                bottom: .75rem;
                height: 2.25rem;
                right: .75rem;
                width: 2.25rem;
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

        .site-footer {
            background:
                radial-gradient(circle at 18% 35%, rgba(255, 255, 255, .12) 0 2px, transparent 3px 12px),
                radial-gradient(circle at 78% 20%, rgba(255, 255, 255, .08) 0 1px, transparent 2px 10px),
                linear-gradient(135deg, #123f68 0%, #173f66 55%, #0e3152 100%);
            color: #fff;
            margin-top: 1.5rem;
            overflow: hidden;
            position: relative;
        }

        .site-footer::before {
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 50%;
            content: "";
            height: 260px;
            left: 50%;
            opacity: .25;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 260px;
        }

        .site-footer::after {
            background:
                repeating-radial-gradient(circle, rgba(255, 255, 255, .14) 0 1px, transparent 1px 18px),
                repeating-conic-gradient(from 0deg, rgba(255, 255, 255, .08) 0deg 8deg, transparent 8deg 16deg);
            border-radius: 50%;
            content: "";
            height: 210px;
            opacity: .18;
            position: absolute;
            right: 10%;
            top: 1.5rem;
            width: 210px;
        }

        .site-footer-inner {
            min-height: 230px;
            padding: 2rem 0 1rem;
            position: relative;
            z-index: 1;
        }

        .site-footer-title {
            color: #fff;
            font-size: 1.05rem;
            font-weight: 800;
            letter-spacing: 0;
            margin-bottom: .85rem;
            text-transform: uppercase;
        }

        .site-footer p,
        .site-footer-contact div {
            color: rgba(255, 255, 255, .9);
            font-size: .95rem;
            line-height: 1.65;
            margin-bottom: .3rem;
        }

        .site-footer-badges {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            margin-top: 1rem;
        }

        .site-footer-badge {
            background: rgba(255, 255, 255, .94);
            border: 1px solid rgba(255, 255, 255, .22);
            border-radius: .25rem;
            color: #123f68;
            display: inline-flex;
            font-size: .78rem;
            font-weight: 700;
            line-height: 1;
            padding: .45rem .65rem;
        }

        .site-footer-contact a {
            color: #fff;
            font-weight: 600;
            text-decoration: none;
        }

        .site-footer-contact a:hover,
        .site-footer-contact a:focus {
            text-decoration: underline;
        }

        .site-footer-copyright {
            border-top: 1px solid rgba(255, 255, 255, .18);
            color: rgba(255, 255, 255, .9);
            font-size: .9rem;
            margin-top: 1.25rem;
            padding-top: .85rem;
            text-align: center;
        }

        .back-to-top {
            align-items: center;
            background: #f8c542;
            border: 0;
            border-radius: .25rem;
            bottom: 1rem;
            box-shadow: 0 .35rem .8rem rgba(0, 0, 0, .22);
            color: #123f68;
            display: inline-flex;
            font-size: 1.15rem;
            font-weight: 800;
            height: 2.5rem;
            justify-content: center;
            position: fixed;
            right: 1rem;
            text-decoration: none;
            width: 2.5rem;
            z-index: 1030;
        }

        .back-to-top:hover,
        .back-to-top:focus {
            background: #ffd968;
            color: #0e3152;
        }

        @media (max-width: 575.98px) {
            .site-footer-inner {
                min-height: auto;
                padding: 1.5rem 0 1rem;
            }

            .site-footer::after {
                height: 150px;
                right: -2rem;
                top: 1rem;
                width: 150px;
            }

            .site-footer-title {
                font-size: 1rem;
            }

            .back-to-top {
                bottom: .75rem;
                height: 2.25rem;
                right: .75rem;
                width: 2.25rem;
            }
        }

        .home-main-grid {
            align-items: stretch;
        }

        .home-main-grid>[class*="col-"] {
            display: flex;
            flex-direction: column;
        }

        /* .featured-news-column,
.latest-news-column,
.hotline-column {
    display: flex;
    flex-direction: column;
} */

        .featured-news-card,
        .latest-news-card,
        .hotline-box {
            flex: 1 1 auto;
            height: 100%;
        }

        .hotline-section-title {
            position: relative;
            margin-bottom: 16px;
            padding-left: 14px;
            color: #004080;
            font-size: 24px;
            font-weight: 700;
            line-height: 1.25;
            text-transform: uppercase;
        }

        .hotline-section-title::before {
            content: "";
            position: absolute;
            left: 0;
            top: 4px;
            width: 4px;
            height: 32px;
            background: #0b66b3;
        }

        .hotline-section-title span {
            display: block;
        }

        .hotline-box {
            background: #ffffff;
            border: 1px solid #d8e4f0;
            border-radius: 6px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding: 16px;
        }

        .hotline-item {
            padding: 10px 0;
            border-bottom: 1px solid #edf2f7;
            font-size: 15px;
            line-height: 1.5;
        }

        .hotline-item:last-child {
            border-bottom: 0;
        }

        .hotline-note {
            margin-top: 12px;
            padding: 5px;
            background: #f1f6fb;
            border-left: 4px solid #0b66b3;
            color: #3d4b5c;
            font-size: 14px;
            line-height: 1.6;
        }

        .hotline-field-list {
            margin-top: 12px;
            padding-left: 18px;
            font-size: 14px;
            line-height: 1.7;
        }

        .hotline-actions {
            margin-top: auto;
            padding-top: 16px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        @media (max-width: 991.98px) {
            .hotline-section-title {
                font-size: 22px;
            }
        }

        .home-main-grid {
            align-items: stretch;
        }

        .home-main-grid>[class*="col-"] {
            display: flex;
            flex-direction: column;
        }

        /* Cố định chiều cao vùng 3 cột trên desktop */
        .featured-news-card,
        .latest-news-card,
        .hotline-box {
            height: 560px;
            min-height: 560px;
            display: flex;
            flex-direction: column;
        }

        /* Tin nổi bật */
        .featured-news-card {
            overflow: hidden;
        }

        .featured-news-card .carousel,
        .featured-news-card .carousel-inner,
        .featured-news-card .carousel-item {
            height: 100%;
        }

        .featured-news-card .carousel-item>a,
        .featured-news-card .carousel-item>div {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .featured-news-image,
        .featured-news-card img {
            width: 100%;
            height: 330px;
            object-fit: cover;
            display: block;
        }

        .featured-news-card .card-body,
        .featured-news-card .featured-news-body {
            flex: 1;
            overflow: hidden;
        }

        /* Tin mới nhất */
        .latest-news-card {
            overflow: hidden;
        }

        .latest-news-card .list-group,
        .latest-news-card .latest-news-list {
            flex: 1;
            overflow: hidden;
        }

        .latest-news-card .list-group-item {
            padding-top: 14px;
            padding-bottom: 14px;
        }

        /* Hotline */
        .hotline-box {
            overflow: hidden;
        }

        .hotline-box .hotline-actions {
            margin-top: auto;
        }

        /* Tiêu đề 3 cột căn đều hơn */
        .home-main-grid .section-title,
        .hotline-section-title {
            min-height: 42px;
        }

        /* Mobile thì bỏ chiều cao cố định */
        @media (max-width: 991.98px) {

            .featured-news-card,
            .latest-news-card,
            .hotline-box {
                height: auto;
                min-height: auto;
            }

            .featured-news-image,
            .featured-news-card img {
                height: 220px;
            }
        }

        .site-header-banner .container,
        .portal-nav>.container {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .portal-nav {
            background: transparent !important;
            padding-top: 0;
            padding-bottom: 0;
        }

        .portal-nav-bar {
            width: 100%;
            min-height: 52px;
            background: #0b5cab;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .portal-nav .navbar-collapse {
            width: 100%;
            justify-content: center;
        }

        .portal-nav .navbar-nav {
            width: 100%;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
        }

        .portal-nav .nav-link {
            color: #fff;
            font-weight: 600;
            padding: 1rem 1.05rem;
        }

        .portal-nav .nav-link:hover,
        .portal-nav .nav-link:focus {
            background: rgba(255, 255, 255, .14);
            color: #fff;
        }

        .site-header-banner img,
        .site-header-banner-image {
            display: block;
            width: 100%;
        }

        @media (max-width: 991.98px) {
            .portal-nav-bar {
                justify-content: flex-start;
                padding: .5rem .75rem;
            }

            .portal-nav .navbar-nav {
                width: auto;
                margin-left: 0;
                margin-right: 0;
            }
        }

        /* ===== FIX: 3 cột trang chủ bằng chiều cao ===== */
        @media (min-width: 992px) {
            .home-main-grid {
                display: grid !important;
                grid-template-columns: minmax(0, 2fr) minmax(0, 1fr) minmax(0, 1fr);
                gap: 6px;
                align-items: stretch;
                margin-left: 0 !important;
                margin-right: 0 !important;
            }

            .home-main-grid>[class*="col-"] {
                width: auto !important;
                max-width: none !important;
                flex: none !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                display: flex !important;
                flex-direction: column !important;
                min-width: 0;
            }

            .home-main-grid .section-title,
            .home-main-grid .hotline-section-title {
                height: 48px;
                min-height: 48px;
                margin-bottom: 12px;
                display: flex;
                align-items: center;
            }

            .featured-news-card,
            .latest-news-card,
            .hotline-box {
                height: 530px !important;
                min-height: 530px !important;
                max-height: 530px !important;
                display: flex !important;
                flex-direction: column !important;
                overflow: hidden;
            }

            .featured-news-card .carousel,
            .featured-news-card .carousel-inner,
            .featured-news-card .carousel-item {
                height: 100%;
            }

            .featured-news-card .carousel-item>a,
            .featured-news-card .carousel-item>div {
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            .featured-news-card img,
            .featured-news-image {
                width: 100%;
                height: 330px !important;
                object-fit: cover;
                display: block;
                flex-shrink: 0;
            }

            .featured-news-card .card-body,
            .featured-news-body {
                flex: 1;
                overflow: hidden;
            }

            .latest-news-card {
                overflow: hidden;
            }

            .latest-news-card .list-group,
            .latest-news-list {
                flex: 1;
                overflow: hidden;
            }

            .latest-news-card .list-group-item {
                padding-top: 13px;
                padding-bottom: 13px;
            }

            .hotline-box {
                padding: 18px;
            }

            .hotline-actions {
                margin-top: auto;
            }
        }

        @media (max-width: 991.98px) {
            .home-main-grid {
                display: block !important;
            }

            /* .featured-news-column,
    .latest-news-column,
    .hotline-column {
        margin-bottom: 24px;
    } */

            /* .featured-news-card,
    .latest-news-card,
    .hotline-box {
        height: auto !important;
        min-height: auto !important;
        max-height: none !important;
    } */

            .featured-news-card img,
            .featured-news-image {
                height: 220px !important;
            }
        }

        /* ===== Nền tổng thể website ===== */
        html,
        body {
            background: linear-gradient(180deg, #eaf3ff 0%, #f4f8fc 45%, #eef5fb 100%) !important;
        }

        /* Tạo lớp nền xanh nhạt hai bên cho hài hòa với banner */
        body {
            min-height: 100vh;
            color: #102a43;
        }

        /* Giữ vùng nội dung chính sáng, không bị chìm */
        main {
            background: transparent;
        }

        /* Các container chính giữ cảm giác nổi trên nền */
        .site-header-banner,
        .portal-nav,
        .home-section,
        .portal-content,
        .home-main-grid,
        .site-footer {
            position: relative;
        }

        /* Tạo hiệu ứng nền rất nhẹ hai bên, không ảnh hưởng nội dung */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: -1;
            pointer-events: none;
            background:
                radial-gradient(circle at 8% 18%, rgba(11, 92, 171, 0.08), transparent 28%),
                radial-gradient(circle at 92% 22%, rgba(11, 92, 171, 0.08), transparent 30%),
                linear-gradient(180deg, #eaf3ff 0%, #f7fbff 55%, #edf5fc 100%);
        }

        /* Nếu có vùng nền trắng/xám cũ quá gắt thì làm dịu lại */
        .bg-light,
        .page-bg,
        .portal-page {
            background-color: transparent !important;
        }

        .school-link-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            margin-bottom: 10px;
            background: #f8fbff;
            border: 1px solid #d8e6f5;
            text-decoration: none;
            color: #004080;
        }

        .school-link-item:hover {
            background: #eef6ff;
            color: #003366;
        }

        .school-link-logo {
            width: 60px;
            height: 60px;
            background: #eef6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
        }

        .school-link-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .school-link-name {
            font-weight: 600;
            line-height: 1.4;
        }

        /* ===== FIX 3 CỘT TRANG CHỦ BẰNG CHIỀU CAO ===== */
        @media (min-width: 992px) {
            .home-main-grid {
                align-items: stretch !important;
            }

            .home-main-grid>[class*="col-"] {
                display: flex !important;
                flex-direction: column !important;
            }

            .home-column-heading {
                min-height: 44px;
                flex-shrink: 0;
            }

            .featured-news-card,
            .latest-news-card,
            .hotline-box {
                height: 540px !important;
                min-height: 540px !important;
                max-height: 540px !important;
                display: flex !important;
                flex-direction: column !important;
                overflow: hidden !important;
                background: #ffffff;
            }

            .featured-news-card .carousel,
            .featured-news-card .carousel-inner,
            .featured-news-card .carousel-item {
                height: 100% !important;
            }

            .featured-news-card .card {
                height: 100% !important;
                display: flex !important;
                flex-direction: column !important;
            }

            .featured-news-image {
                width: 100% !important;
                height: 320px !important;
                object-fit: cover !important;
                display: block !important;
                flex-shrink: 0 !important;
            }

            .featured-carousel-caption {
                flex: 1 !important;
                overflow: hidden !important;
            }

            .latest-news-card {
                border-radius: 6px;
            }

            .latest-news-card .list-group-item {
                flex: 0 0 auto;
                padding-top: 14px !important;
                padding-bottom: 14px !important;
            }

            .hotline-box {
                border: 1px solid #d8e4f0;
                border-radius: 6px;
                padding: 10px !important;
            }

            .hotline-item {
                padding: 10px 0;
                border-bottom: 1px solid #edf2f7;
                line-height: 1.5;
            }

            .hotline-note {
                margin-top: 16px;
                padding: 5px;
                background: #f1f6fb;
                border-left: 4px solid #0b66b3;
                color: #3d4b5c;
                line-height: 1.6;
            }
        }

        @media (max-width: 991.98px) {

            .featured-news-card,
            .latest-news-card,
            .hotline-box {
                height: auto !important;
                min-height: auto !important;
                max-height: none !important;
            }

            .featured-news-image {
                height: 220px !important;
            }
        }

        /* ===== Tin mới nhất có ảnh đại diện ===== */
        .latest-news-item-with-thumb {
            display: flex !important;
            align-items: flex-start;
            gap: 10px;
            padding: 12px !important;
        }

        .latest-news-thumb {
            width: 76px;
            min-width: 76px;
            height: 73px;
            border-radius: 4px;
            overflow: hidden;
            background: #eef4fb;
            border: 1px solid #dbe7f3;
        }

        .latest-news-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .latest-news-thumb-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0b5cab;
            font-weight: 700;
            font-size: 13px;
        }

        .latest-news-info {
            flex: 1;
            min-width: 0;
        }

        .latest-news-title {
            font-size: 13px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ===== TRA CỨU HIỂN THỊ DẠNG BANNER NGANG ===== */
        .lookup-banner-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 12px;
        }

        .lookup-banner-item {
            display: block;
            width: 100%;
            height: 100px;
            border: 1px solid #d8e6f5;
            background: #f8fbff;
            overflow: hidden;
            text-decoration: none;
            border-radius: 10px;
        }

        .lookup-banner-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Trường hợp admin chưa upload ảnh thì hiện text thay thế */
        .lookup-banner-fallback {
            width: 100%;
            height: 100%;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            background: #eef6ff;
            color: #004080;
            font-weight: 700;
            line-height: 1.35;
        }

        .lookup-banner-item:hover {
            filter: brightness(0.98);
        }

        /* Mobile */
        @media (max-width: 576px) {
            .lookup-banner-item {
                height: 64px;
            }
        }

        /* ===== FOOTER FRONTEND ===== */
        .site-footer {
            background: transparent;
            margin-top: 5px;
        }

        .site-footer>.container {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .site-footer-panel {
            background:
                radial-gradient(circle at 80% 40%, rgba(255, 255, 255, 0.08), transparent 28%),
                linear-gradient(135deg, #103d64 0%, #0b3558 55%, #082d4d 100%);
            color: #ffffff;
            overflow: hidden;
        }

        .site-footer-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            padding: 36px 48px 28px;
        }

        .site-footer-title {
            margin: 0 0 16px;
            font-size: 20px;
            font-weight: 800;
            text-transform: uppercase;
            color: #ffffff;
        }

        .site-footer-text {
            margin: 0 0 10px;
            color: rgba(255, 255, 255, 0.95);
            line-height: 1.6;
            font-size: 15px;
        }

        .site-footer-contact {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .site-footer-contact li {
            margin-bottom: 11px;
            color: rgba(255, 255, 255, 0.95);
            line-height: 1.6;
            font-size: 15px;
        }

        .site-footer-socials {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 18px;
            flex-wrap: wrap;
        }

        .footer-social {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #ffffff;
            font-weight: 800;
            font-size: 20px;
        }

        .footer-facebook {
            background: #2563eb;
        }

        .footer-youtube {
            background: #dc2626;
            font-size: 16px;
        }

        .footer-social:hover {
            color: #ffffff;
            filter: brightness(1.08);
        }

        .footer-badge {
            height: 42px;
            padding: 0 14px;
            border-radius: 8px;
            background: #ffffff;
            color: #0b3558;
            display: inline-flex;
            align-items: center;
            font-weight: 800;
        }

        .site-footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.18);
            text-align: center;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.95);
            font-size: 14px;
        }

        /* ===== LIÊN KẾT TRANG ===== */
        /* ===== CĂN LẠI LIÊN KẾT TRANG THEO CONTENT ===== */
        .site-links-section {
            margin-top: 0px;
            margin-bottom: 5px;
            background: transparent;
        }

        .site-links-section>.container {
            max-width: 1295px;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .site-links-panel {
            width: 100%;
            background: #ffffff;
            border: 1px solid #d8e6f5;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        /* Phần header của liên kết trang */
        .site-links-heading {
            padding: 20px 24px 14px;
            border-bottom: 3px solid #0b5cab;
            background: #ffffff;
        }

        .site-links-heading h2 {
            margin: 0;
            color: #003f7d;
            font-size: 22px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .site-links-heading p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 14px;
        }

        /* Tab */
        .site-links-tabs {
            display: flex;
            gap: 12px;
            padding: 16px 24px;
            background: #f8fafc;
            border-bottom: 1px solid #e5edf7;
            flex-wrap: wrap;
        }

        .site-links-tab {
            border: 0;
            background: #eef2f7;
            color: #64748b;
            padding: 12px 22px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            cursor: pointer;
            border-radius: 4px;
        }

        .site-links-tab.active {
            background: #0b5cab;
            color: #ffffff;
        }

        /* Nội dung link */
        .site-links-content {
            display: none;
            padding: 20px 24px 26px;
        }

        .site-links-content.active {
            display: block;
        }

        .site-links-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));

        }

        .site-link-item {
            position: relative;
            display: block;
            padding: 8px 8px 8px 22px;
            color: #0f172a;
            text-decoration: none;
            font-size: 16px;
            line-height: 1.45;
            border-radius: 4px;
        }

        .site-link-item::before {
            content: "›";
            position: absolute;
            left: 6px;
            top: 7px;
            color: #0b5cab;
            font-size: 22px;
            line-height: 1;
        }

        .site-link-item:hover {
            background: #eef6ff;
            color: #0b5cab;
        }

        /* Footer tách riêng khỏi Liên kết trang */
        .site-footer {
            margin-top: 0;
        }

        /* Nếu footer cũng đang full quá rộng thì giữ cùng khung với header */
        .site-footer>.container {
            max-width: 1200px;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .site-links-section>.container {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            .site-links-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 576px) {
            .site-links-tabs {
                padding: 14px 16px;
                gap: 8px;
            }

            .site-links-tab {
                width: 100%;
                text-align: left;
            }

            .site-links-content {
                padding: 16px;
            }

            .site-links-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ===== ĐỒNG BỘ CHIỀU RỘNG HEADER - CONTENT - FOOTER ===== */
        :root {
            --portal-width: 1200px;
        }

        /* Các khối chính dùng chung một độ rộng */
        .site-header-banner>.container,
        .portal-nav>.container,
        main>.container,
        .site-links-section>.container,
        .site-footer>.container {
            max-width: var(--portal-width) !important;
            width: 100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* Footer không được tự co hẹp */
        .site-footer {
            background: transparent !important;
            margin-top: 5px;
        }

        .site-footer-panel {
            width: 100% !important;
            max-width: 100% !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        /* Nếu bên trong footer đang có padding làm cảm giác bị hẹp, chỉ giữ padding phần nội dung */
        .site-footer-content {
            padding-left: 48px;
            padding-right: 48px;
        }

        .site-footer-bottom {
            width: 100%;
        }

        /* Mobile vẫn giữ khoảng cách 2 bên */
        @media (max-width: 991.98px) {

            .site-header-banner>.container,
            .portal-nav>.container,
            main>.container,
            .site-links-section>.container,
            .site-footer>.container {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            .site-footer-content {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        /* ===== Lượt truy cập tại khối Tra cứu ===== */
        .lookup-header-with-counter {
            min-height: 44px;
            background: #0b5cab;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 0 14px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .site-visit-counter {
            font-size: 13px;
            font-weight: 700;
            text-transform: none;
            white-space: nowrap;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.22);
            padding: 5px 10px;
            border-radius: 999px;
        }

        @media (max-width: 576px) {
            .lookup-header-with-counter {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px 14px;
            }

            .site-visit-counter {
                font-size: 12px;
            }
        }

        /* ===== Ngày tháng trong lịch làm việc ===== */
        .work-schedule-day strong {
            display: block;
            color: #004080;
            font-weight: 700;
        }

        .work-schedule-date {
            margin-top: 4px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.4;
            font-weight: 500;
        }

        /* ===== THẺ LỌC LOẠI VĂN BẢN ===== */
        .document-category-filter {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
            padding: 13px 14px;
            background:
                linear-gradient(135deg, #f7fbff 0%, #eef6ff 100%);
            border-bottom: 1px solid #d8e6f4;
        }

        .document-category-chip {
            min-height: 36px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 14px;
            border: 1px solid #bdd5ec;
            border-radius: 999px;
            background: #ffffff;
            color: #07579e;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.2;
            box-shadow: 0 2px 6px rgba(8, 83, 151, 0.06);
            transition:
                transform 0.18s ease,
                background 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }

        .document-category-chip:hover {
            color: #ffffff;
            background: #1680cf;
            border-color: #1680cf;
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(8, 83, 151, 0.2);
        }

        .document-category-chip.active {
            color: #ffffff;
            background: linear-gradient(135deg, #07579e 0%, #1680cf 100%);
            border-color: #07579e;
            box-shadow: 0 5px 14px rgba(8, 83, 151, 0.25);
        }

        .document-category-chip-icon {
            font-size: 10px;
            opacity: 0.9;
        }

        .document-filter-result {
            padding: 9px 14px;
            background: #fff9e9;
            border-bottom: 1px solid #f2dfaa;
            color: #6b5100;
            font-size: 13px;
        }

        .document-filter-result strong {
            color: #a76500;
        }

        .document-filter-result a {
            margin-left: 8px;
            color: #07579e;
            font-weight: 700;
            text-decoration: none;
        }

        .document-filter-result a:hover {
            text-decoration: underline;
        }

        .document-empty-state {
            padding: 28px 16px;
            text-align: center;
            color: #64748b;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
        }

        @media (max-width: 576px) {
            .document-category-filter {
                gap: 7px;
                padding: 10px;
            }

            .document-category-chip {
                padding: 7px 11px;
                font-size: 12px;
            }
        }

        .summary-tnb {
            font-size: 14px;
            line-height: 1.45;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ===== THỜI TIẾT TẠI TIÊU ĐỀ TIN MỚI NHẤT ===== */
        .latest-news-heading-row {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 10px;
        }

        .latest-news-heading-row>h2 {
            flex: 1 1 auto;
            min-width: 0;
            margin-top: 0;
            margin-bottom: 0;
        }

        .weather-mini-widget {
            flex: 0 0 auto;
            min-width: 105px;
            min-height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 5px 10px;
            border: 1px solid #b6d7f2;
            border-radius: 8px;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.9), transparent 50%), linear-gradient(135deg, #eaf6ff 0%, #d9edff 100%);
            color: #07579e;
            box-shadow: 0 3px 9px rgba(7, 87, 158, 0.1);
            cursor: default;
        }

        .weather-mini-icon {
            font-size: 25px;
            line-height: 1;
        }

        .weather-mini-information {
            display: flex;
            flex-direction: column;
            line-height: 1.05;
        }

        .weather-mini-temperature {
            color: #064b87;
            font-size: 17px;
            font-weight: 800;
            white-space: nowrap;
        }

        .weather-mini-location {
            max-width: 70px;
            margin-top: 3px;
            overflow: hidden;
            color: #557087;
            font-size: 10px;
            font-weight: 600;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Tablet */
        @media (max-width: 991.98px) {
            .weather-mini-widget {
                min-width: 88px;
                padding: 5px 8px;
            }

            .weather-mini-icon {
                font-size: 21px;
            }

            .weather-mini-temperature {
                font-size: 15px;
            }
        }

        /* Điện thoại */
        @media (max-width: 576px) {
            .latest-news-heading-row {
                align-items: stretch;
            }

            .weather-mini-widget {
                min-width: 72px;
                min-height: 38px;
                gap: 4px;
                border-radius: 6px;
            }

            .weather-mini-icon {
                font-size: 19px;
            }

            .weather-mini-temperature {
                font-size: 14px;
            }

            .weather-mini-location {
                display: none;
            }
        }

        .weather-data-credit {
            margin-top: 8px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 11px;
        }

        .weather-data-credit a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
        }

        .weather-data-credit a:hover {
            text-decoration: underline;
        }


        .weather-mini {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #555;
        }

        .weather-icon {
            width: 24px;
            height: 24px;
        }

        .weather-temp {
            font-weight: 600;
        }

        .weather-location {
            color: #777;
        }

        .section-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        #weather-box {
            font-size: 14px;
            color: #666;
            font-weight: 500;
            white-space: nowrap;
        }

        #weather-box .temp {
            color: #ff9800;
            font-weight: 700;
        }

        #weather-box .location {
            color: #666;
        }

        .hotline-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .current-date-badge {
            background: #eef6ff;
            color: #005baa;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            border: 1px solid #cfe4ff;
        }


        /* Giữ chiều cao đồng đều với hai cột bên trái */
        .hotline-column {
            display: flex;
            flex-direction: column;
        }

        .hotline-column .hotline-box {
            flex: 1 1 auto;
        }

        /* Tablet */
        @media (max-width: 991.98px) {
            .hotline-box {
                min-height: auto;
            }

            .hotline-box-top {
                padding: 13px;
            }

            .hotline-item-content,
            .hotline-item-content strong {
                font-size: 12px;
            }
        }

        /* Điện thoại */
        @media (max-width: 576px) {
            .hotline-box-top {
                flex-direction: column;
            }

            .hotline-status {
                align-self: flex-start;
            }

            .hotline-information {
                padding-left: 10px;
                padding-right: 10px;
            }

            .hotline-note {
                margin-left: 10px;
                margin-right: 10px;
            }
        }


        /* Thời gian trong danh sách Tin mới nhất */
        .latest-news-time {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 4px;
            color: #64748b;
            font-size: 10px;
            line-height: 1.3;
        }

        .latest-news-date {
            color: #64748b;
            font-size: 10px;
            font-weight: 500;
            white-space: nowrap;
        }

        .latest-news-time-dot {
            color: #b4bec8;
            font-size: 9px;
        }

        .latest-news-age {
            color: #e36b16;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* Bỏ icon đồng hồ nếu CSS chung đang tự thêm */
        .latest-news-age::before {
            display: none;
        }

        /* ===== THỜI GIAN ĐĂNG TRONG TIN MỚI NHẤT ===== */
        .latest-news-time {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
            gap: 5px;
            margin-top: 5px;
            min-width: 0;
            line-height: 1.2;
        }

        .latest-news-date {
            color: #64748b;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Dấu chấm ngăn cách */
        .latest-news-time-dot {
            width: 3px;
            height: 3px;
            flex: 0 0 3px;
            display: inline-block;
            overflow: hidden;
            border-radius: 50%;
            background: #cbd5e1;
            color: transparent;
            font-size: 0;
        }

        /* Nhãn thời gian: 5 phút trước, 1 giờ trước... */
        .latest-news-age {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            padding: 2px 6px;
            border: 1px solid #fed7aa;
            border-radius: 999px;
            background: #fff7ed;
            color: #c2410c;
            font-size: 9.5px;
            font-weight: 700;
            white-space: nowrap;
            box-shadow: 0 1px 2px rgba(194, 65, 12, 0.06);
        }

        .latest-news-age::before {
            content: "◷";
            color: #ea580c;
            font-size: 10px;
            line-height: 1;
        }

        /* Không cho phần thời gian làm tràn danh sách */
        .latest-news-info {
            min-width: 0;
        }

        .latest-news-info .latest-news-time {
            max-width: 100%;
        }

        /* Màn hình nhỏ */
        @media (max-width: 1199.98px) {
            .latest-news-time {
                gap: 3px;
            }

            .latest-news-date {
                font-size: 9px;
            }

            .latest-news-age {
                padding: 2px 5px;
                font-size: 8.5px;
            }
        }

        /* ===== NGÀY ĐĂNG - TIN NỔI BẬT ===== */
        .featured-carousel-caption .article-publish-meta {
            width: fit-content;
            max-width: 100%;
            display: inline-flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 7px;

            margin: 0 0 12px;
            padding: 6px 11px;

            border: 1px solid #d5e4f1;
            border-radius: 999px;

            background: linear-gradient(135deg,
                    #f8fbfe 0%,
                    #edf6fd 100%);

            box-shadow: 0 2px 7px rgba(7, 87, 158, 0.08);

            font-family: "Segoe UI", Arial, sans-serif;
            line-height: 1.2;
        }

        /* Ngày đăng */
        .featured-carousel-caption .article-publish-date {
            display: inline-flex;
            align-items: center;
            gap: 5px;

            color: #31566f;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .featured-carousel-caption .article-publish-date::before {
            content: "📅";
            font-size: 12px;
        }

        /* Dấu phân cách */
        .featured-carousel-caption .article-meta-dot {
            width: 4px;
            height: 4px;
            display: inline-block;

            border-radius: 50%;
            background: #a9bbc9;

            color: transparent;
            font-size: 0;
        }

        /* Thời gian đã đăng */
        .featured-carousel-caption .article-age {
            display: inline-flex;
            align-items: center;
            gap: 4px;

            color: #df6b18 !important;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .featured-carousel-caption .article-age::before {
            content: "◷";
            color: #df6b18;
            font-size: 13px;
        }

        /* Hover nhẹ */
        .featured-carousel-caption .article-publish-meta:hover {
            border-color: #abcce5;
            background: #eef8ff;
            box-shadow: 0 3px 10px rgba(7, 87, 158, 0.12);
        }

        /* Điện thoại */
        @media (max-width: 576px) {
            .featured-carousel-caption .article-publish-meta {
                gap: 5px;
                margin-bottom: 9px;
                padding: 5px 9px;
            }

            .featured-carousel-caption .article-publish-date,
            .featured-carousel-caption .article-age {
                font-size: 11px;
            }

            .featured-carousel-caption .article-publish-date::before,
            .featured-carousel-caption .article-age::before {
                font-size: 11px;
            }
        }


        /* ==================================================
   KHỐI VĂN BẢN MỚI BAN HÀNH
   ================================================== */

        .latest-documents-panel {
            --documents-panel-height: 700px;

            width: 100%;
            height: var(--documents-panel-height);
            display: flex;
            flex-direction: column;
            overflow: hidden;

            border: 1px solid #cddfec;
            border-radius: 0 0 8px 8px;
            background: #ffffff;
            box-shadow: 0 4px 14px rgba(10, 78, 134, 0.07);
        }

        /* Tiêu đề cố định */
        .latest-documents-header {
            flex: 0 0 46px;
            min-height: 46px;
            display: flex;
            align-items: center;
            padding: 0 16px;

            background: linear-gradient(135deg,
                    #075da8 0%,
                    #116fba 100%);
        }

        .latest-documents-header h2 {
            margin: 0;
            color: #ffffff;
            font-family: "Segoe UI", Arial, sans-serif;
            font-size: 15px;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: 0.2px;
            text-transform: uppercase;
        }

        /* Danh sách loại văn bản */
        .document-category-tabs {
            flex: 0 0 auto;
            max-height: 112px;
            display: flex;
            align-content: flex-start;
            flex-wrap: wrap;
            gap: 9px;
            padding: 12px 13px;

            overflow-y: auto;
            border-bottom: 1px solid #dbe7f0;
            background: linear-gradient(180deg,
                    #f8fbfe 0%,
                    #f2f7fb 100%);
        }

        .document-category-tab {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-height: 34px;
            padding: 7px 14px;

            border: 1px solid #bdd6ea;
            border-radius: 999px;
            background: #ffffff;

            color: #07579e;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.2;
            text-decoration: none;
            white-space: nowrap;

            box-shadow: 0 2px 5px rgba(7, 87, 158, 0.06);
            transition:
                color 0.2s ease,
                background 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }

        .document-category-tab:hover {
            color: #ffffff;
            border-color: #1478bf;
            background: #1478bf;
            transform: translateY(-1px);
        }

        .document-category-tab.active {
            color: #ffffff;
            border-color: #075da8;
            background: linear-gradient(135deg,
                    #075da8 0%,
                    #1681cc 100%);
            box-shadow: 0 4px 10px rgba(7, 87, 158, 0.18);
        }

        .document-category-icon {
            font-size: 7px;
            line-height: 1;
        }

        /* Vùng danh sách được phép cuộn */
        .latest-documents-scroll {
            flex: 1 1 auto;
            min-height: 0;
            overflow-x: hidden;
            overflow-y: auto;
            overscroll-behavior: contain;
            scrollbar-gutter: stable;

            background: #ffffff;
        }

        /* Mỗi văn bản */
        .latest-document-item {
            width: 100%;
            min-height: 68px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;

            border-bottom: 1px solid #dce7f0;
            background: #ffffff;

            color: #172433;
            text-decoration: none;
            transition:
                background 0.2s ease,
                padding-left 0.2s ease;
        }

        .latest-document-item:last-child {
            border-bottom: 0;
        }

        .latest-document-item:hover {
            padding-left: 20px;
            background: #f3f9fe;
        }

        .latest-document-bullet {
            flex: 0 0 auto;
            margin-top: 3px;
            color: #0871bc;
            font-size: 8px;
        }

        .latest-document-content {
            min-width: 0;
            flex: 1 1 auto;
        }

        .latest-document-title {
            margin: 0;
            color: #182635;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.45;

            display: -webkit-box;
            overflow: hidden;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .latest-document-item:hover .latest-document-title {
            color: #075da8;
        }

        .latest-document-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px 16px;
            margin-top: 6px;

            color: #66788a;
            font-size: 11px;
            line-height: 1.35;
        }

        .latest-document-meta strong {
            color: #526779;
            font-weight: 500;
        }

        /* Trạng thái không có văn bản */
        .latest-documents-empty {
            width: 100%;
            height: 100%;
            min-height: 300px;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 30px;

            color: #73879a;
            text-align: center;
        }

        .latest-documents-empty-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;
            background: #edf6fd;
            font-size: 30px;
        }

        .latest-documents-empty strong {
            color: #31566f;
            font-size: 15px;
        }

        .latest-documents-empty span {
            max-width: 320px;
            font-size: 12px;
            line-height: 1.5;
        }

        /* Thanh cuộn */
        .latest-documents-scroll::-webkit-scrollbar,
        .document-category-tabs::-webkit-scrollbar {
            width: 7px;
        }

        .latest-documents-scroll::-webkit-scrollbar-track,
        .document-category-tabs::-webkit-scrollbar-track {
            background: #edf3f8;
        }

        .latest-documents-scroll::-webkit-scrollbar-thumb,
        .document-category-tabs::-webkit-scrollbar-thumb {
            border: 2px solid #edf3f8;
            border-radius: 999px;
            background: #8fb8d7;
        }

        .latest-documents-scroll::-webkit-scrollbar-thumb:hover,
        .document-category-tabs::-webkit-scrollbar-thumb:hover {
            background: #558db8;
        }

        /* Tablet */
        @media (max-width: 991.98px) {
            .latest-documents-panel {
                --documents-panel-height: 620px;
            }
        }

        /* Điện thoại */
        @media (max-width: 576px) {
            .latest-documents-panel {
                --documents-panel-height: 560px;
            }

            .latest-documents-header {
                padding: 0 12px;
            }

            .document-category-tabs {
                max-height: 105px;
                gap: 7px;
                padding: 10px;
            }

            .document-category-tab {
                min-height: 31px;
                padding: 6px 10px;
                font-size: 11px;
            }

            .latest-document-item {
                padding: 12px;
            }

            .latest-document-item:hover {
                padding-left: 14px;
            }

            .latest-document-title {
                font-size: 13px;
            }
        }


        /* =========================================
   BẢNG LỊCH LÀM VIỆC
   ========================================= */

        .work-schedule-table {
            width: 100%;
            margin-bottom: 0;
            table-layout: fixed;
            border-collapse: collapse;
        }

        /* Độ rộng từng cột */
        .work-schedule-table .work-schedule-col-day {
            width: 120px;
        }

        .work-schedule-table .work-schedule-col-content {
            width: 120px;
        }

        .work-schedule-table .work-schedule-col-session {
            width: 76px;
        }

        .work-schedule-table .work-schedule-col-note {
            width: 120px;
        }

        /* Tiêu đề bảng */
        .work-schedule-table thead th {
            padding: 12px 8px;
            vertical-align: middle;
            border-bottom: 1px solid #cbddea;
            background: #f8fbfe;
            color: #073f73;
            font-size: 14px;
            font-weight: 800;
            line-height: 1.25;
        }

        /* Buổi sáng và Buổi chiều luôn nằm một hàng */
        .work-schedule-session-heading {
            white-space: nowrap;
            text-align: center;
        }

        /* Các ô nội dung */
        .work-schedule-table tbody th,
        .work-schedule-table tbody td {
            padding: 11px 8px;
            vertical-align: top;
            border-bottom: 1px solid #dce8f1;
            color: #1f2f3e;
            font-size: 14px;
            line-height: 1.45;
        }

        /* Cột thứ và ngày */
        .work-schedule-day-cell {
            width: 120px;
            min-width: 120px;
            vertical-align: top !important;
        }

        .work-schedule-day-name {
            display: block;
            color: #064b87;
            font-size: 14px;
            font-weight: 800;
            line-height: 1.25;
            white-space: nowrap;
        }

        /* Ngày tháng nằm dưới thứ */
        .work-schedule-date {
            width: fit-content;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 1px;

            margin-top: 6px;
            padding: 5px 8px;

            border-left: 3px solid #1681cc;
            border-radius: 0 6px 6px 0;

            background: linear-gradient(135deg,
                    #edf7ff 0%,
                    #f7fbff 100%);

            box-shadow: 0 2px 6px rgba(7, 87, 158, 0.08);
            white-space: nowrap;
        }

        .work-schedule-date-label {
            color: #7890a4;
            font-size: 10px;
            font-weight: 600;
            line-height: 1.1;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .work-schedule-date-value {
            color: #07579e;
            font-size: 12px;
            font-weight: 800;
            line-height: 1.25;
        }

        /* Hai cột giờ */
        .work-schedule-time-cell {
            text-align: center;
            color: #28475f !important;
            font-size: 13px !important;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Hover nhẹ từng hàng */
        .work-schedule-table tbody tr {
            transition: background-color 0.2s ease;
        }

        .work-schedule-table tbody tr:hover {
            background: #f6fbff;
        }

        /* Tablet */
        @media (max-width: 991.98px) {
            .work-schedule-table .work-schedule-col-day {
                width: 110px;
            }

            .work-schedule-table .work-schedule-col-session {
                width: 72px;
            }

            .work-schedule-table .work-schedule-col-note {
                width: 110px;
            }

            .work-schedule-day-cell {
                width: 110px;
                min-width: 110px;
            }

            .work-schedule-table tbody th,
            .work-schedule-table tbody td {
                padding: 9px 6px;
                font-size: 13px;
            }
        }

        /* Điện thoại: cho phép cuộn ngang toàn bảng */
        @media (max-width: 767.98px) {
            .work-schedule-table {
                min-width: 720px;
            }

            .work-schedule-day-name {
                font-size: 14px;
            }

            .work-schedule-date {
                padding: 4px 7px;
            }

            .work-schedule-date-value {
                font-size: 11px;
            }
        }


        /* ==================================================
   THANH CUỘN CHO DANH SÁCH TIN MỚI NHẤT
   ================================================== */

        .latest-news-card {
            height: 505px;
            max-height: 505px;

            overflow-y: auto;
            overflow-x: hidden;

            overscroll-behavior: contain;
            scrollbar-gutter: stable;

            border: 1px solid #d5e2ed;
            border-radius: 8px;
            background: #ffffff;
        }

        /* Mỗi tin giữ chiều cao tự nhiên, không bị co lại */
        .latest-news-card .latest-news-item-with-thumb {
            flex: 0 0 auto;
            min-height: 88px;
        }

        /* Thanh cuộn trên Chrome, Edge */
        .latest-news-card::-webkit-scrollbar {
            width: 7px;
        }

        .latest-news-card::-webkit-scrollbar-track {
            background: #edf3f8;
            border-radius: 999px;
        }

        .latest-news-card::-webkit-scrollbar-thumb {
            border: 2px solid #edf3f8;
            border-radius: 999px;
            background: #7faed1;
        }

        .latest-news-card::-webkit-scrollbar-thumb:hover {
            background: #397fae;
        }

        /* Thanh cuộn trên Firefox */
        .latest-news-card {
            scrollbar-width: thin;
            scrollbar-color: #7faed1 #edf3f8;
        }

        /* Tablet */
        @media (max-width: 991.98px) {
            .latest-news-card {
                height: 460px;
                max-height: 460px;
            }
        }

        /* Điện thoại */
        @media (max-width: 576px) {
            .latest-news-card {
                height: 420px;
                max-height: 420px;
            }

            .latest-news-card .latest-news-item-with-thumb {
                min-height: 82px;
            }
        }


        /* ==================================================
   KHUNG CUỘN TIN MỚI NHẤT
   ================================================== */

        .latest-news-column {
            min-width: 0;
            min-height: 0;
        }

        /* Khung bên ngoài cố định chiều cao */
        .latest-news-card {
            width: 100%;
            height: 505px !important;
            min-height: 542px !important;
            max-height: 505px !important;

            display: block !important;
            overflow: hidden !important;

            border: 1px solid #d4e1ec;
            border-radius: 8px;
            background: #ffffff;

            box-shadow: 0 4px 14px rgba(7, 87, 158, 0.08);
        }

        /* Chỉ phần này được cuộn */
        .latest-news-scroll {
            width: 100%;
            height: 100%;
            max-height: 100%;

            display: block !important;

            overflow-x: hidden !important;
            overflow-y: scroll !important;

            overscroll-behavior: contain;
            scrollbar-gutter: stable;
        }

        /* Không để từng tin bị co chiều cao */
        .latest-news-scroll .latest-news-item-with-thumb {
            width: 100%;
            min-height: 92px;

            display: flex !important;
            align-items: flex-start;
            flex: none !important;

            padding: 12px 10px;
            border-left: 0;
            border-right: 0;
        }

        /* Ảnh cố định */
        .latest-news-scroll .latest-news-thumb {
            flex: 0 0 70px;
            width: 70px;
            height: 72px;
            overflow: hidden;
            border-radius: 5px;
            background: #edf3f8;
        }

        .latest-news-scroll .latest-news-thumb img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
        }

        /* Nội dung không làm tràn khung */
        .latest-news-scroll .latest-news-info {
            min-width: 0;
            flex: 1 1 auto;
            padding-left: 10px;
        }

        /* Thanh cuộn Chrome và Edge */
        .latest-news-scroll::-webkit-scrollbar {
            width: 9px;
        }

        .latest-news-scroll::-webkit-scrollbar-track {
            background: #edf3f8;
        }

        .latest-news-scroll::-webkit-scrollbar-thumb {
            border: 2px solid #edf3f8;
            border-radius: 999px;
            background: #6fa4cc;
        }

        .latest-news-scroll::-webkit-scrollbar-thumb:hover {
            background: #2875aa;
        }

        /* Firefox */
        .latest-news-scroll {
            scrollbar-width: thin;
            scrollbar-color: #6fa4cc #edf3f8;
        }

        @media (max-width: 991.98px) {
            .latest-news-card {
                height: 470px !important;
                min-height: 470px !important;
                max-height: 470px !important;
            }
        }

        @media (max-width: 576px) {
            .latest-news-card {
                height: 420px !important;
                min-height: 420px !important;
                max-height: 420px !important;
            }
        }

        /* ==================================================
   THÔNG BÁO VÀ BANNER TUYÊN TRUYỀN
   ================================================== */

        .homepage-secondary-row {
            --secondary-box-height: 650px;
        }

        .homepage-secondary-row>div {
            min-width: 0;
        }

        /* Hai khung bằng nhau */
        .homepage-notice-card,
        .homepage-propaganda-card {
            width: 100%;
            height: var(--secondary-box-height);
            min-height: var(--secondary-box-height);

            overflow: hidden;
            border: 1px solid #cbddea;
            border-radius: 7px;
            background: #ffffff;

            box-shadow: 0 3px 10px rgba(7, 87, 158, 0.08);
        }

        /* ================= THÔNG BÁO ================= */

        .homepage-notice-card {
            display: flex;
            flex-direction: column;
        }

        .homepage-notice-header {
            flex: 0 0 38px;
            min-height: 38px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;

            padding: 0 12px;

            background: linear-gradient(135deg,
                    #075da8 0%,
                    #1681cc 100%);
        }

        .homepage-notice-heading {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            color: #ffffff;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.2px;
        }

        .homepage-notice-icon {
            font-size: 13px;
        }

        .homepage-notice-view-all {
            color: rgba(255, 255, 255, 0.9);
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .homepage-notice-view-all:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .homepage-notice-scroll {
            flex: 1 1 auto;
            min-height: 0;

            overflow-x: hidden;
            overflow-y: auto;

            overscroll-behavior: contain;
            background: #ffffff;
        }

        .homepage-notice-item {
            min-height: 32px;

            display: flex;
            align-items: center;
            gap: 7px;

            padding: 7px 10px;

            border-bottom: 1px solid #e1ebf3;
            color: #243747;

            font-size: 11px;
            line-height: 1.35;
            text-decoration: none;

            transition:
                background 0.2s ease,
                color 0.2s ease;
        }

        .homepage-notice-item:last-child {
            border-bottom: 0;
        }

        .homepage-notice-item:hover {
            color: #075da8;
            background: #f0f8fe;
        }

        .homepage-notice-bullet {
            flex: 0 0 6px;

            width: 6px;
            height: 6px;

            border-radius: 50%;
            background: #1681cc;
        }

        .homepage-notice-title {
            min-width: 0;
            flex: 1 1 auto;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;

            font-weight: 600;
        }

        .homepage-notice-date {
            flex: 0 0 auto;

            padding: 2px 5px;

            border-radius: 999px;
            background: #edf6fd;

            color: #607b91;
            font-size: 9px;
            font-weight: 600;
            white-space: nowrap;
        }

        .homepage-notice-empty {
            width: 100%;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            color: #75899a;
            font-size: 12px;
        }

        .homepage-notice-empty-icon {
            font-size: 20px;
        }

        /* Thanh cuộn Thông báo */
        .homepage-notice-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .homepage-notice-scroll::-webkit-scrollbar-track {
            background: #edf3f8;
        }

        .homepage-notice-scroll::-webkit-scrollbar-thumb {
            border-radius: 999px;
            background: #7faed1;
        }

        .homepage-notice-scroll::-webkit-scrollbar-thumb:hover {
            background: #3e82b2;
        }

        .homepage-notice-scroll {
            scrollbar-width: thin;
            scrollbar-color: #7faed1 #edf3f8;
        }

        /* ================= BANNER TUYÊN TRUYỀN ================= */

        .homepage-propaganda-card {
            position: relative;
            background: #e9f3fa;
        }

        .homepage-propaganda-carousel,
        .homepage-propaganda-carousel .carousel-inner,
        .homepage-propaganda-carousel .carousel-item,
        .homepage-propaganda-link {
            width: 100%;
            height: 100%;
        }

        .homepage-propaganda-link {
            display: block;
        }

        .homepage-propaganda-image {
            width: 100%;
            height: 100%;
            display: block;

            object-fit: cover;
            object-position: center;

            transition: transform 5s;
        }

        .homepage-propaganda-carousel .carousel-item.active .homepage-propaganda-image {
            transform: scale(1.035);
        }

        .homepage-propaganda-badge {
            position: absolute;
            top: 8px;
            left: 9px;

            padding: 4px 8px;

            border: 1px solid rgba(255, 255, 255, 0.45);
            border-radius: 999px;

            background: rgba(0, 77, 137, 0.82);
            color: #ffffff;

            font-size: 9px;
            font-weight: 800;
            letter-spacing: 0.4px;
        }

        .homepage-propaganda-caption {
            position: absolute;
            right: 8px;
            bottom: 7px;
            left: 8px;

            overflow: hidden;
            padding: 6px 9px;

            border-radius: 5px;

            background: linear-gradient(90deg,
                    rgba(0, 54, 101, 0.9),
                    rgba(0, 77, 137, 0.68));

            color: #ffffff;
            font-size: 10px;
            font-weight: 700;
            line-height: 1.3;

            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .homepage-propaganda-control {
            width: 34px;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .homepage-propaganda-card:hover .homepage-propaganda-control {
            opacity: 0.88;
        }

        .homepage-propaganda-control .carousel-control-prev-icon,
        .homepage-propaganda-control .carousel-control-next-icon {
            width: 24px;
            height: 24px;

            border-radius: 50%;

            background-color: rgba(0, 54, 101, 0.75);
            background-size: 11px;
        }

        .homepage-propaganda-indicators {
            right: 8px;
            bottom: 4px;
            left: auto;

            width: auto;
            margin: 0;
        }

        .homepage-propaganda-indicators [data-bs-target] {
            width: 6px;
            height: 6px;

            margin: 0 2px;

            border: 0;
            border-radius: 50%;

            background-color: rgba(255, 255, 255, 0.65);
        }

        .homepage-propaganda-indicators .active {
            background-color: #ffffff;
        }

        .homepage-propaganda-empty {
            width: 100%;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 11px;

            background: linear-gradient(135deg,
                    #edf7ff 0%,
                    #dceefc 100%);

            color: #07579e;
        }

        .homepage-propaganda-empty-icon {
            font-size: 30px;
        }

        .homepage-propaganda-empty div {
            display: flex;
            flex-direction: column;
        }

        .homepage-propaganda-empty strong {
            font-size: 12px;
        }

        .homepage-propaganda-empty small {
            margin-top: 3px;
            color: #6d8396;
            font-size: 9px;
        }

        /* Responsive */
        @media (max-width: 767.98px) {
            .homepage-secondary-row {
                --secondary-box-height: 140px;
            }

            .homepage-secondary-row>div+div {
                margin-top: 8px;
            }
        }


        /* ===== DANH SÁCH THÔNG BÁO TRANG CHỦ ===== */

        .homepage-notice-scroll {
            width: 100%;
            flex: 1 1 auto;
            min-height: 0;

            overflow-x: hidden;
            overflow-y: auto;

            background: #ffffff;
        }

        .notice-box-item {
            width: 100%;
            min-height: 42px;

            display: flex !important;
            align-items: center;
            gap: 8px;

            padding: 9px 10px;

            border-bottom: 1px solid #dce8f1;
            background: #ffffff;

            color: #172b3d !important;
            text-decoration: none !important;
        }

        .notice-box-item:hover {
            background: #f1f8fe;
        }

        .notice-box-bullet {
            width: 6px;
            height: 6px;
            flex: 0 0 6px;

            display: block;
            border-radius: 50%;
            background: #0873bd;
        }

        .notice-box-title {
            min-width: 0;
            flex: 1 1 auto;

            display: -webkit-box !important;
            overflow: hidden;

            color: #172b3d !important;
            opacity: 1 !important;
            visibility: visible !important;

            font-size: 14px !important;
            font-weight: 600 !important;
            line-height: 1.4 !important;

            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .notice-box-item:hover .notice-box-title {
            color: #075da8 !important;
        }

        .notice-box-date {
            flex: 0 0 auto;

            padding: 3px 6px;
            border-radius: 999px;
            background: #edf6fd;

            color: #61798c !important;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* ==================================================
   SLIDER BANNER TUYÊN TRUYỀN
   Trượt từ phải sang trái, tự đổi mỗi 3 giây
   ================================================== */

        .homepage-propaganda-carousel {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        /* Thời gian chuyển động của mỗi lần trượt */
        .homepage-propaganda-carousel .carousel-item {
            height: 100%;
            transition: transform 3s cubic-bezier(0.25, 0.8, 0.25, 1);
            backface-visibility: hidden;
            will-change: transform;
        }

        /*
Bootstrap Carousel:
- Slide kế tiếp bắt đầu bên phải
- Khi chạy sẽ di chuyển sang trái
*/
        .homepage-propaganda-carousel .carousel-item-next:not(.carousel-item-start) {
            transform: translateX(100%);
        }

        .homepage-propaganda-carousel .active.carousel-item-start {
            transform: translateX(-100%);
        }

        .homepage-propaganda-carousel .carousel-item-prev:not(.carousel-item-end) {
            transform: translateX(-100%);
        }

        .homepage-propaganda-carousel .active.carousel-item-end {
            transform: translateX(100%);
        }

        .homepage-propaganda-carousel .carousel-inner,
        .homepage-propaganda-carousel .carousel-item,
        .homepage-propaganda-link {
            width: 100%;
            height: 100%;
        }

        .homepage-propaganda-link {
            display: block;
            overflow: hidden;
        }



        /* Phóng nhẹ ảnh trong lúc đang hiển thị */
        .homepage-propaganda-carousel .carousel-item.active .homepage-propaganda-image {
            transform: scale(1.025);
        }


        /* ==================================================
   TIÊU ĐỀ BÀI NỔI BẬT TRONG KHỐI CHUYÊN MỤC
   Đồng bộ với tiêu đề trong box Thông báo
   ================================================== */

        .category-featured-article {
            display: block;
            color: inherit;
            text-decoration: none;
        }

        .category-featured-image-wrap {
            position: relative;
            width: 100%;
            height: 145px;
            overflow: hidden;
            background: #edf4f9;
        }

        .category-featured-image {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            object-position: center;
        }

        .category-featured-image-placeholder {
            position: absolute;
            inset: 0;

            display: none;
            align-items: center;
            justify-content: center;

            background: linear-gradient(135deg,
                    #edf6fd 0%,
                    #dcecf8 100%);

            color: #2879af;
            font-size: 30px;
        }

        /* Hàng tiêu đề giống box Thông báo */
        .category-featured-title-row {
            width: 100%;
            min-height: 48px;

            display: flex;
            align-items: center;
            gap: 8px;

            padding: 9px 10px;

            border-bottom: 1px solid #dce8f1;
            background: #ffffff;

            transition:
                background-color 0.2s ease,
                color 0.2s ease;
        }

        .category-featured-article:hover .category-featured-title-row {
            background: #f1f8fe;
        }

        .category-featured-bullet {
            width: 6px;
            height: 6px;
            flex: 0 0 6px;

            border-radius: 50%;
            background: #0873bd;
        }

        .category-featured-title {
            min-width: 0;
            flex: 1 1 auto;

            display: -webkit-box;
            overflow: hidden;

            color: #172b3d;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.4;

            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .category-featured-article:hover .category-featured-title {
            color: #075da8;
        }

        .category-featured-date {
            flex: 0 0 auto;

            padding: 3px 6px;
            border-radius: 999px;
            background: #edf6fd;

            color: #61798c;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
        }

        @media (max-width: 576px) {
            .category-featured-image-wrap {
                height: 130px;
            }

            .category-featured-title {
                font-size: 12px;
            }
        }


        /* ==================================================
   MENU CHÍNH HIỆN ĐẠI
   ================================================== */

        .portal-nav {
            width: 100%;
            padding: 0;
            background: transparent;
        }

        .portal-nav .container {
            max-width: var(--portal-width, 1200px);
        }

        .portal-nav-bar {
            width: 100%;
            min-height: 54px;

            display: flex;
            align-items: stretch;

            background: linear-gradient(135deg,
                    #075aa5 0%,
                    #0872be 55%,
                    #0665ad 100%);

            border-bottom: 3px solid #f2b323;
            box-shadow: 0 4px 12px rgba(4, 65, 115, 0.14);
        }

        /* Khối collapse chiếm hết chiều rộng */
        .portal-nav .navbar-collapse {
            width: 100%;
        }

        /* Danh sách menu */
        .portal-menu-list {
            width: 100%;

            display: flex;
            align-items: stretch;
            justify-content: center;

            margin: 0;
            padding: 0;

            overflow-x: auto;
            overflow-y: hidden;

            scrollbar-width: none;
        }

        .portal-menu-list::-webkit-scrollbar {
            display: none;
        }

        /* Mỗi mục menu */
        .portal-menu-list .nav-item {
            position: relative;
            display: flex;
            align-items: stretch;
        }

        /* Chữ menu */
        .portal-menu-list .portal-menu-link {
            position: relative;

            min-height: 54px;
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 0 17px !important;

            color: rgba(255, 255, 255, 0.95) !important;

            font-family:
                "Segoe UI",
                "Inter",
                "Roboto",
                Arial,
                sans-serif;

            font-size: 15px;
            font-weight: 650;
            line-height: 1.25;
            letter-spacing: 0.05px;

            text-align: center;
            text-decoration: none;
            white-space: nowrap;

            transition:
                color 0.22s ease,
                background-color 0.22s ease,
                box-shadow 0.22s ease;
        }

        /* Vạch phân cách giữa các mục */
        .portal-menu-list .nav-item+.nav-item::before {
            content: "";

            position: absolute;
            top: 15px;
            bottom: 15px;
            left: 0;

            width: 1px;
            background: rgba(255, 255, 255, 0.14);
        }

        /* Gạch vàng bên dưới */
        .portal-menu-list .portal-menu-link::after {
            content: "";

            position: absolute;
            right: 18px;
            bottom: 6px;
            left: 18px;

            height: 3px;

            border-radius: 999px;
            background: linear-gradient(90deg,
                    #ffd66b,
                    #f3ae19);

            opacity: 0;
            transform: scaleX(0);
            transform-origin: center;

            transition:
                opacity 0.22s ease,
                transform 0.22s ease;
        }

        /* Chữ dịch nhẹ khi rê chuột */
        .portal-menu-link span {
            display: inline-block;

            transition:
                transform 0.22s ease,
                text-shadow 0.22s ease;
        }

        .portal-menu-link:hover span {
            transform: translateY(-1px);
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.16);
        }

        /* Hover */
        .portal-menu-list .portal-menu-link:hover,
        .portal-menu-list .portal-menu-link:focus {
            color: #ffffff !important;

            background: rgba(255, 255, 255, 0.1);
            box-shadow: inset 0 -2px 0 rgba(255, 255, 255, 0.05);
        }

        .portal-menu-list .portal-menu-link:hover::after,
        .portal-menu-list .portal-menu-link:focus::after {
            opacity: 1;
            transform: scaleX(1);
        }

        /* Mục đang mở */
        .portal-menu-list .portal-menu-link.active {
            color: #ffffff !important;
            font-weight: 750;

            background: linear-gradient(180deg,
                    rgba(0, 55, 103, 0.28),
                    rgba(0, 50, 94, 0.4));
        }

        .portal-menu-list .portal-menu-link.active::after {
            opacity: 1;
            transform: scaleX(1);
        }

        /* Nút mở menu trên điện thoại */
        .portal-navbar-toggler {
            margin: 7px 10px;
            padding: 6px 9px;

            border: 1px solid rgba(255, 255, 255, 0.65);
            border-radius: 6px;

            background: #ffffff;
            box-shadow: none;
        }

        .portal-navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(255, 214, 107, 0.3);
        }

        /* Màn hình vừa */
        @media (max-width: 1199.98px) {
            .portal-menu-list {
                justify-content: flex-start;
            }

            .portal-menu-list .portal-menu-link {
                padding: 0 13px !important;
                font-size: 13px;
            }
        }

        /* Mobile */
        @media (max-width: 991.98px) {
            .portal-nav-bar {
                min-height: 50px;
                display: block;
            }

            .portal-nav .navbar-collapse {
                border-top: 1px solid rgba(255, 255, 255, 0.16);
            }

            .portal-menu-list {
                display: block;
                width: 100%;
                padding: 5px 0 8px;
            }

            .portal-menu-list .nav-item {
                width: 100%;
                display: block;
            }

            .portal-menu-list .nav-item+.nav-item::before {
                top: 0;
                right: 14px;
                bottom: auto;
                left: 14px;

                width: auto;
                height: 1px;
            }

            .portal-menu-list .portal-menu-link {
                width: 100%;
                min-height: 44px;

                justify-content: flex-start;

                padding: 0 18px !important;

                font-size: 13px;
                text-align: left;
            }

            .portal-menu-list .portal-menu-link::after {
                top: 10px;
                right: auto;
                bottom: 10px;
                left: 6px;

                width: 3px;
                height: auto;

                transform: scaleY(0);
            }

            .portal-menu-list .portal-menu-link:hover::after,
            .portal-menu-list .portal-menu-link:focus::after,
            .portal-menu-list .portal-menu-link.active::after {
                transform: scaleY(1);
            }

            .portal-menu-link:hover span {
                transform: translateX(3px);
            }
        }

        /* =====================================================
   TIỆN ÍCH SỐ VĨNH BÌNH
   Prefix riêng: vb-digital-
===================================================== */

        .vb-digital-panel {
            --vb-primary: #0868bd;
            --vb-primary-dark: #075397;
            --vb-primary-light: #eaf5ff;
            --vb-border: #d7e8f7;
            --vb-text: #18334d;
            --vb-muted: #647b91;

            width: 100%;
            margin-top: 8px;
            overflow: hidden;

            border: 1px solid rgba(8, 104, 189, 0.18);
            border-radius: 12px;

            background:
                linear-gradient(180deg,
                    #f7fbff 0%,
                    #eef7ff 100%);

            box-shadow:
                0 9px 25px rgba(13, 86, 145, 0.1),
                0 2px 6px rgba(13, 86, 145, 0.06);
        }

        /* Header */
        .vb-digital-header {
            position: relative;

            min-height: 62px;
            display: flex;
            align-items: center;
            gap: 10px;

            padding: 10px 13px;

            overflow: hidden;

            color: #ffffff;

            background:
                radial-gradient(circle at 95% 20%,
                    rgba(255, 255, 255, 0.21),
                    transparent 35%),
                linear-gradient(135deg,
                    #07579e 0%,
                    #0875d1 65%,
                    #0a85dd 100%);
        }

        .vb-digital-header::after {
            content: "";

            position: absolute;
            top: -38px;
            right: -25px;

            width: 115px;
            height: 115px;

            border: 22px solid rgba(255, 255, 255, 0.07);
            border-radius: 50%;
        }

        .vb-digital-header-icon {
            position: relative;
            z-index: 1;

            width: 38px;
            height: 38px;
            flex: 0 0 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid rgba(255, 255, 255, 0.32);
            border-radius: 11px;

            background: rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(5px);
        }

        .vb-digital-header-icon svg {
            width: 22px;
            height: 22px;

            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .vb-digital-header h2 {
            position: relative;
            z-index: 1;

            margin: 0;

            color: #ffffff;
            font-size: 15px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: 0.2px;
        }

        .vb-digital-header p {
            position: relative;
            z-index: 1;

            margin: 4px 0 0;

            color: rgba(255, 255, 255, 0.84);
            font-size: 11px;
            font-weight: 500;
        }

        .vb-digital-status {
            position: relative;
            z-index: 1;

            margin-left: auto;
            padding: 4px 8px;

            border: 1px solid rgba(255, 255, 255, 0.26);
            border-radius: 999px;

            background: rgba(255, 255, 255, 0.13);

            color: #ffffff;
            font-size: 9px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* Nội dung */
        .vb-digital-body {
            padding: 10px;
        }

        /* Trợ lý AI */
        .vb-digital-assistant {
            position: relative;

            padding: 8px;

            overflow: hidden;

            border: 1px solid var(--vb-border);
            border-radius: 10px;

            background: rgba(255, 255, 255, 0.96);

            box-shadow:
                0 6px 15px rgba(13, 86, 145, 0.07);
        }

        .vb-digital-assistant::before {
            content: "";

            position: absolute;
            top: 0;
            right: 0;
            left: 0;

            height: 3px;

            background: linear-gradient(90deg,
                    #0868bd,
                    #25a2e9);
        }

        .vb-digital-assistant-heading {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .vb-digital-robot {
            width: 43px;
            height: 43px;
            flex: 0 0 43px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 13px;

            color: #0871cc;

            background:
                linear-gradient(145deg,
                    #edf7ff,
                    #dceeff);

            box-shadow:
                inset 0 0 0 1px rgba(8, 104, 189, 0.1);
        }

        .vb-digital-robot svg {
            width: 27px;
            height: 27px;

            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .vb-digital-assistant-text {
            min-width: 0;
            flex: 1 1 auto;
        }

        .vb-digital-assistant-text h3 {
            margin: 0;

            color: #07599f;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.25;
        }

        .vb-digital-assistant-text p {
            margin: 3px 0 0;

            overflow: hidden;

            color: var(--vb-muted);
            font-size: 10px;
            line-height: 1.35;

            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .vb-digital-ai-badge {
            align-self: flex-start;

            padding: 3px 6px;

            border-radius: 999px;

            background: linear-gradient(135deg,
                    #e6f4ff,
                    #d5ecff);

            color: #0871cc;
            font-size: 9px;
            font-weight: 800;
        }

        /* Ô tìm kiếm */
        .vb-digital-search {
            margin-top: 10px;

            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 7px;
        }

        .vb-digital-search-field {
            min-width: 0;
            height: 38px;

            display: flex;
            align-items: center;
            gap: 7px;

            padding: 0 10px;

            border: 1px solid #cfe2f3;
            border-radius: 8px;

            background: #fbfdff;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background-color 0.2s ease;
        }

        .vb-digital-search-field:focus-within {
            border-color: #2887d2;
            background: #ffffff;

            box-shadow:
                0 0 0 3px rgba(8, 104, 189, 0.1);
        }

        .vb-digital-search-field svg {
            width: 16px;
            height: 16px;
            flex: 0 0 16px;

            fill: none;
            stroke: #6b8ca7;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .vb-digital-search-field input {
            min-width: 0;
            width: 100%;
            height: 100%;

            padding: 0;

            border: 0;
            outline: none;

            background: transparent;

            color: var(--vb-text);
            font-family: inherit;
            font-size: 11px;
        }

        .vb-digital-search-field input::placeholder {
            color: #8ba0b2;
        }

        .vb-digital-assistant-button {
            height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;

            padding: 0 11px;

            border: 0;
            border-radius: 8px;

            background:
                linear-gradient(135deg,
                    #075da8,
                    #1686dd);

            color: #ffffff;
            font-size: 10px;
            font-weight: 750;
            white-space: nowrap;

            box-shadow:
                0 5px 12px rgba(8, 104, 189, 0.22);

            cursor: pointer;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                filter 0.2s ease;
        }

        .vb-digital-assistant-button svg {
            width: 15px;
            height: 15px;

            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .vb-digital-assistant-button:hover {
            color: #ffffff;

            filter: brightness(1.05);
            transform: translateY(-1px);

            box-shadow:
                0 7px 16px rgba(8, 104, 189, 0.28);
        }

        .vb-digital-assistant-button:active {
            transform: translateY(0);
        }

        /* Câu hỏi gợi ý */
        .vb-digital-suggestions {
            margin-top: 8px;

            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        .vb-digital-suggestions>span {
            color: #8194a5;
            font-size: 9px;
            font-weight: 600;
        }

        .vb-digital-suggestions a {
            padding: 3px 7px;

            border: 1px solid #d8e9f7;
            border-radius: 999px;

            background: #f2f8fd;

            color: #41708f;
            font-size: 9px;
            font-weight: 600;
            line-height: 1.2;
            text-decoration: none;

            transition:
                color 0.2s ease,
                border-color 0.2s ease,
                background-color 0.2s ease;
        }

        .vb-digital-suggestions a:hover {
            border-color: #a9d2f2;
            background: #e6f3fd;
            color: #075da8;
        }

        /* Grid tiện ích */
        .vb-digital-grid {
            margin-top: 9px;

            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 7px;
        }

        .vb-digital-item {
            position: relative;

            min-width: 0;
            min-height: 69px;

            display: flex;
            align-items: center;
            gap: 8px;

            padding: 9px;

            overflow: hidden;

            border: 1px solid var(--vb-border);
            border-radius: 9px;

            background:
                linear-gradient(145deg,
                    #ffffff 0%,
                    #f8fbfe 100%);

            color: var(--vb-text);
            text-decoration: none;

            box-shadow:
                0 3px 9px rgba(13, 86, 145, 0.045);

            transition:
                border-color 0.22s ease,
                box-shadow 0.22s ease,
                transform 0.22s ease,
                background-color 0.22s ease;
        }

        .vb-digital-item::after {
            content: "";

            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;

            width: 3px;

            background: linear-gradient(180deg,
                    #0876cf,
                    #38abea);

            opacity: 0;
            transform: scaleY(0.4);

            transition:
                opacity 0.22s ease,
                transform 0.22s ease;
        }

        .vb-digital-item:hover {
            border-color: #abd5f5;

            background:
                linear-gradient(145deg,
                    #ffffff,
                    #eef8ff);

            color: var(--vb-primary-dark);

            transform: translateY(-2px);

            box-shadow:
                0 8px 17px rgba(13, 86, 145, 0.11);
        }

        .vb-digital-item:hover::after {
            opacity: 1;
            transform: scaleY(1);
        }

        .vb-digital-item-icon {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            color: #0871cc;

            background:
                linear-gradient(145deg,
                    #eef8ff,
                    #deeffd);

            transition:
                color 0.22s ease,
                transform 0.22s ease,
                background-color 0.22s ease;
        }

        .vb-digital-item:hover .vb-digital-item-icon {
            color: #ffffff;

            background:
                linear-gradient(145deg,
                    #0871cc,
                    #1a91df);

            transform: scale(1.04);
        }

        .vb-digital-item-icon svg {
            width: 21px;
            height: 21px;

            fill: none;
            stroke: currentColor;
            stroke-width: 1.65;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .vb-digital-item-content {
            min-width: 0;
            flex: 1 1 auto;

            display: flex;
            flex-direction: column;
        }

        .vb-digital-item-content strong {
            overflow: hidden;

            color: #21415e;
            font-size: 10.5px;
            font-weight: 750;
            line-height: 1.25;

            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .vb-digital-item-content small {
            margin-top: 3px;

            display: -webkit-box;
            overflow: hidden;

            color: #708599;
            font-size: 8.5px;
            font-weight: 500;
            line-height: 1.3;

            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .vb-digital-arrow,
        .vb-digital-external {
            flex: 0 0 auto;

            color: #91a8ba;
            font-size: 16px;
            font-weight: 500;

            transition:
                color 0.22s ease,
                transform 0.22s ease;
        }

        .vb-digital-item:hover .vb-digital-arrow {
            color: #0871cc;
            transform: translateX(2px);
        }

        .vb-digital-item:hover .vb-digital-external {
            color: #0871cc;
            transform: translate(1px, -1px);
        }

        /* Tablet */
        @media (max-width: 1199.98px) {
            .vb-digital-search {
                grid-template-columns: 1fr;
            }

            .vb-digital-assistant-button {
                width: 100%;
            }

            .vb-digital-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Khi cột rộng trở lại ở màn hình nhỏ */
        @media (min-width: 576px) and (max-width: 991.98px) {
            .vb-digital-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .vb-digital-search {
                grid-template-columns: minmax(0, 1fr) auto;
            }
        }

        /* Điện thoại */
        @media (max-width: 575.98px) {
            .vb-digital-panel {
                border-radius: 9px;
            }

            .vb-digital-header {
                min-height: 58px;
            }

            .vb-digital-status {
                display: none;
            }

            .vb-digital-body {
                padding: 8px;
            }

            .vb-digital-grid {
                grid-template-columns: 1fr;
            }

            .vb-digital-item {
                min-height: 62px;
            }

            .vb-digital-suggestions {
                display: none;
            }
        }

        /* Hỗ trợ người dùng giảm chuyển động */
        @media (prefers-reduced-motion: reduce) {

            .vb-digital-item,
            .vb-digital-item::after,
            .vb-digital-item-icon,
            .vb-digital-arrow,
            .vb-digital-external,
            .vb-digital-assistant-button {
                transition: none !important;
            }
        }

        /* =====================================================
   NÂNG CẤP GIAO DIỆN TIỆN ÍCH SỐ
===================================================== */

        .vb-digital-panel {
            border: 2px solid rgba(12, 112, 194, 0.32);
            border-radius: 14px;

            background:
                linear-gradient(180deg,
                    #f9fcff 0%,
                    #edf7ff 100%);

            box-shadow:
                0 14px 32px rgba(5, 82, 145, 0.15),
                0 3px 8px rgba(5, 82, 145, 0.08);
        }

        /* Header lớn và nổi bật hơn */
        .vb-digital-header {
            min-height: 72px;
            padding: 12px 15px;
        }

        .vb-digital-header-icon {
            width: 43px;
            height: 43px;
            flex-basis: 43px;
        }

        .vb-digital-header-icon svg {
            width: 25px;
            height: 25px;
        }

        .vb-digital-header h2 {
            font-size: 17px;
            font-weight: 850;
            letter-spacing: 0.3px;
        }

        .vb-digital-header p {
            margin-top: 5px;
            font-size: 12px;
        }

        /* Trạng thái đang nâng cấp */
        .vb-digital-status.is-upgrading {
            display: inline-flex;
            align-items: center;
            gap: 5px;

            padding: 6px 9px;

            border: 1px solid rgba(255, 218, 125, 0.65);
            background: rgba(255, 187, 28, 0.2);

            color: #fff5cf;
            font-size: 10px;
            font-weight: 800;
        }

        .vb-digital-status-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;
            background: #ffd268;

            box-shadow: 0 0 0 4px rgba(255, 210, 104, 0.16);
        }

        /* Thông báo nâng cấp */
        .vb-digital-upgrade-notice {
            display: flex;
            align-items: center;
            gap: 10px;

            margin: 10px 10px 0;
            padding: 10px 11px;

            border: 1px solid #f2d28a;
            border-radius: 10px;

            background:
                linear-gradient(135deg,
                    #fffaf0 0%,
                    #fff3d4 100%);

            color: #6d510d;

            box-shadow:
                0 4px 10px rgba(165, 113, 0, 0.07);
        }

        .vb-digital-upgrade-icon {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 9px;
            background: #ffe7ae;
            color: #b87800;
        }

        .vb-digital-upgrade-icon svg {
            width: 20px;
            height: 20px;

            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .vb-digital-upgrade-content {
            min-width: 0;

            display: flex;
            flex-direction: column;
        }

        .vb-digital-upgrade-content strong {
            font-size: 11.5px;
            font-weight: 800;
            line-height: 1.3;
        }

        .vb-digital-upgrade-content small {
            margin-top: 3px;

            color: #8b702e;
            font-size: 10px;
            line-height: 1.4;
        }

        /* Nội dung có thêm khoảng thở */
        .vb-digital-body {
            padding: 10px 11px 12px;
        }

        /* Khối trợ lý số */
        .vb-digital-assistant {
            padding: 13px;
            border-radius: 11px;
        }

        .vb-digital-robot {
            width: 47px;
            height: 47px;
            flex-basis: 47px;
        }

        .vb-digital-robot svg {
            width: 29px;
            height: 29px;
        }

        .vb-digital-assistant-text h3 {
            font-size: 14.5px;
            font-weight: 800;
        }

        .vb-digital-assistant-text p {
            margin-top: 4px;
            font-size: 11px;
        }

        .vb-digital-ai-badge {
            padding: 4px 7px;
            font-size: 10px;
        }

        .vb-digital-search-field {
            height: 42px;
        }

        .vb-digital-search-field input {
            font-size: 12px;
        }

        .vb-digital-assistant-button {
            height: 42px;
            padding: 0 14px;

            font-size: 11.5px;
            font-weight: 800;
        }

        .vb-digital-assistant-button:disabled {
            cursor: not-allowed;

            background:
                linear-gradient(135deg,
                    #7ba8ca,
                    #8ab6d4);

            box-shadow: none;
            opacity: 0.82;
        }

        /* Các ô tiện ích lớn hơn */
        .vb-digital-grid {
            margin-top: 10px;
            gap: 8px;
        }

        .vb-digital-item {
            min-height: 73px;
            padding: 11px 9px;

            border-radius: 11px;
        }

        .vb-digital-item-icon {
            width: 42px;
            height: 42px;
            flex-basis: 42px;

            border-radius: 11px;
        }

        .vb-digital-item-icon svg {
            width: 24px;
            height: 24px;
        }

        .vb-digital-item-content strong {
            padding-right: 2px;

            color: #163d5e;
            font-size: 12px;
            font-weight: 800;
            line-height: 1.3;

            text-overflow: unset;
            white-space: normal;
        }

        .vb-digital-item-content small {
            margin-top: 4px;

            color: #617b91;
            font-size: 10px;
            line-height: 1.35;
        }

        /* Tiện ích đang nâng cấp */
        .vb-digital-item.is-upgrading {
            cursor: not-allowed;
            opacity: 0.82;

            background:
                linear-gradient(145deg,
                    #ffffff 0%,
                    #f2f7fb 100%);

            filter: saturate(0.8);
        }

        .vb-digital-item.is-upgrading::before {
            content: "SẮP MỞ";

            position: absolute;
            top: 5px;
            right: 6px;

            padding: 2px 5px;

            border: 1px solid #f0cf82;
            border-radius: 999px;

            background: #fff6df;

            color: #9a6a00;
            font-size: 7.5px;
            font-weight: 850;
            letter-spacing: 0.1px;
        }

        .vb-digital-item.is-upgrading:hover {
            border-color: var(--vb-border);
            color: var(--vb-text);

            transform: none;

            box-shadow:
                0 3px 9px rgba(13, 86, 145, 0.045);
        }

        .vb-digital-item.is-upgrading:hover::after {
            opacity: 0;
            transform: scaleY(0.4);
        }

        .vb-digital-item.is-upgrading .vb-digital-arrow,
        .vb-digital-item.is-upgrading .vb-digital-external {
            display: none;
        }

        .vb-digital-item.is-upgrading:hover .vb-digital-item-icon {
            color: #0871cc;

            background:
                linear-gradient(145deg,
                    #eef8ff,
                    #deeffd);

            transform: none;
        }

        /* Tablet */
        @media (max-width: 1199.98px) {
            .vb-digital-item-content strong {
                font-size: 11.5px;
            }

            .vb-digital-item-content small {
                font-size: 9.5px;
            }
        }

        /* Điện thoại */
        @media (max-width: 575.98px) {
            .vb-digital-header h2 {
                font-size: 16px;
            }

            .vb-digital-upgrade-notice {
                margin: 8px 8px 0;
            }

            .vb-digital-item {
                min-height: 72px;
            }

            .vb-digital-item-content strong {
                font-size: 12px;
            }

            .vb-digital-item-content small {
                font-size: 10px;
            }
        }

        
    </style>
</head>

<body>
    <!-- <div class="portal-topbar py-2">
            <div class="container small d-flex justify-content-between">
                <span>Cổng thông tin điện tử</span>
                <span>Phòng Văn Hóa - Xã Hội VĨNH BÌNH</span>
            </div>
        </div> -->

    @if ($siteHeaderBanners->isNotEmpty())
        <header class="site-header-banner py-1">
            <div class="container">
                @if ($siteHeaderBanners->count() > 1)
                    <div id="siteHeaderBannerCarousel" class="carousel slide site-header-banner-carousel"
                        data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover" data-bs-touch="true">
                        <div class="carousel-inner">
                            @foreach ($siteHeaderBanners as $banner)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    @if ($banner->link)
                                        <a class="site-header-banner-link" href="{{ $banner->link }}">
                                            <img src="{{ asset('storage/' . $banner->image) }}"
                                                class="site-header-banner-image" alt="{{ $banner->title }}">
                                        </a>
                                    @else
                                        <img src="{{ asset('storage/' . $banner->image) }}"
                                            class="site-header-banner-image" alt="{{ $banner->title }}">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    @php($banner = $siteHeaderBanners->first())
                    @if ($banner->link)
                        <a class="site-header-banner-link" href="{{ $banner->link }}">
                            <img src="{{ asset('storage/' . $banner->image) }}" class="site-header-banner-image"
                                alt="{{ $banner->title }}">
                        </a>
                    @else
                        <img src="{{ asset('storage/' . $banner->image) }}" class="site-header-banner-image"
                            alt="{{ $banner->title }}">
                    @endif
                @endif
            </div>
        </header>
    @else
        <header class="portal-header py-4">
            <div class="container">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-7">
                        <a href="{{ route('home') }}" class="text-decoration-none">
                            <div class="portal-brand-title h2 fw-bold mb-1">Phòng Văn Hóa - Xã Hội VĨNH BÌNH</div>
                            <div class="text-uppercase text-muted fw-semibold">Cổng thông tin điện tử</div>
                        </a>
                    </div>
                    <div class="col-lg-5">
                        <form class="d-flex gap-2" method="GET" action="{{ route('frontend.search') }}">
                            <input class="form-control" type="search" name="q" value="{{ request('q') }}"
                                placeholder="Tìm kiếm bài viết">
                            <button class="btn btn-primary px-4" type="submit">Tìm</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
    @endif

    <nav class="navbar navbar-expand-lg portal-nav">
        <div class="container px-0">
            <div class="portal-nav-bar">
                <button class="navbar-toggler portal-navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#frontendNavbar" aria-controls="frontendNavbar" aria-expanded="false"
                    aria-label="Mở menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="frontendNavbar">
                    <ul class="navbar-nav portal-menu-list">
                        {{-- Trang chủ --}}
                        <li class="nav-item">
                            <a class="nav-link portal-menu-link
                                {{ request()->routeIs('home') ? 'active' : '' }}"
                                href="{{ route('home') }}"
                                @if (request()->routeIs('home')) aria-current="page" @endif>
                                <span>Trang chủ</span>
                            </a>
                        </li>

                        {{-- Giới thiệu --}}
                        <li class="nav-item">
                            <a class="nav-link portal-menu-link
                                {{ request()->routeIs('frontend.introduction') ? 'active' : '' }}"
                                href="{{ route('frontend.introduction') }}"
                                @if (request()->routeIs('frontend.introduction')) aria-current="page" @endif>
                                <span>Giới thiệu</span>
                            </a>
                        </li>

                        {{-- Trang giới thiệu tĩnh nếu có --}}
                        @if ($introPage)
                            <li class="nav-item">
                                <a class="nav-link portal-menu-link
                                    {{ request()->url() === route('frontend.pages.show', $introPage->slug) ? 'active' : '' }}"
                                    href="{{ route('frontend.pages.show', $introPage->slug) }}">
                                    <span>{{ $introPage->title }}</span>
                                </a>
                            </li>
                        @endif

                        {{-- Các chuyên mục đang hoạt động --}}
                        @foreach ($frontendMenuCategories as $category)
                            <li class="nav-item">
                                <a class="nav-link portal-menu-link
                                    {{ request()->url() === route('frontend.categories.show', $category->slug) ? 'active' : '' }}"
                                    href="{{ route('frontend.categories.show', $category->slug) }}">
                                    <span>{{ $category->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <main class="py-1">
        @yield('content')
    </main>

    <section class="site-links-section">
        <div class="container px-0">
            <div class="site-links-panel">
                <div class="site-links-heading">
                    <div>
                        <h2>LIÊN KẾT TRANG</h2>
                        <p>Kết nối nhanh đến các cơ quan, đơn vị và địa phương liên quan</p>
                    </div>
                </div>

                <div class="site-links-tabs" role="tablist">
                    <button type="button" class="site-links-tab active" data-tab="departments">
                        Sở, ban, ngành
                    </button>

                    <button type="button" class="site-links-tab" data-tab="others">
                        Đơn vị khác
                    </button>

                </div>

                <div class="site-links-content active" id="departments">
                    <div class="site-links-grid">
                        <a href="https://vpddbqh-hdnd.angiang.gov.vn/Trang/TrangChu.aspx" class="site-link-item">VP
                            Đoàn ĐBQH và HĐND tỉnh</a>
                        <a href="https://vpubnd.angiang.gov.vn/Trang/TrangChu.aspx" class="site-link-item">Văn phòng
                            UBND tỉnh</a>
                        <a href="https://angiang.edu.vn/" class="site-link-item">Sở Giáo dục và Đào tạo</a>
                        <a href="https://bandantoc.angiang.gov.vn/" class="site-link-item">Sở Dân tộc và Tôn giáo</a>
                        <a href="https://skhcn.angiang.gov.vn/" class="site-link-item">Sở Khoa học và Công nghệ</a>
                        <a href="https://sxd.angiang.gov.vn/" class="site-link-item">Sở Xây dựng</a>

                        <a href="https://snv.angiang.gov.vn/" class="site-link-item">Sở Nội vụ</a>
                        <a href="https://snnmt.angiang.gov.vn/Trang/TrangChu.aspx" class="site-link-item">Sở Nông
                            nghiệp và Môi trường</a>
                        <a href="https://stc.angiang.gov.vn/Trang/TrangChu.aspx" class="site-link-item">Sở Tài
                            chính</a>
                        <a href="https://stp.angiang.gov.vn/" class="site-link-item">Sở Tư pháp</a>
                        <a href="https://svhtt.angiang.gov.vn/" class="site-link-item">Sở Văn hóa và Thể thao</a>
                        <a href="https://sdl.angiang.gov.vn/Trang/TrangChu.aspx" class="site-link-item">Sở Du lịch</a>

                        <a href="https://syt.angiang.gov.vn/Trang/TrangChu.aspx" class="site-link-item">Sở Y tế</a>
                        <a href="https://congan.angiang.gov.vn/" class="site-link-item">Công an tỉnh</a>
                        <a href="https://thanhtra.angiang.gov.vn/Trang/TrangChu.aspx" class="site-link-item">Thanh tra
                            Tỉnh</a>
                        <a href="https://bqlkkt.angiang.gov.vn/" class="site-link-item">Ban Quản lý Khu kinh tế</a>
                        <a href="https://bqlkktpq.angiang.gov.vn/" class="site-link-item">Ban Quản lý Khu kinh tế Phú
                            Quốc</a>
                    </div>
                </div>

                <div class="site-links-content" id="others">
                    <div class="site-links-grid">
                        <a href="https://noibo.angiang.dcs.vn/" class="site-link-item">Ban Tuyên giáo Tỉnh ủy</a>
                        <a href="#" class="site-link-item">Ban Tiếp công dân tỉnh</a>
                        <a href="https://angiang.baohiemxahoi.gov.vn/Pages/default.aspx" class="site-link-item">Bảo
                            hiểm xã hội tỉnh</a>
                        <a href="https://www.customs.gov.vn/" class="site-link-item">Cục hải quan</a>
                        <a href="https://angiang.gdt.gov.vn/wps/portal" class="site-link-item">Cục thuế tỉnh</a>
                        <a href="https://hoinongdanag.org.vn/wps/portal" class="site-link-item">Hội Nông dân tỉnh</a>

                        <a href="#" class="site-link-item">Kho bạc nhà nước tỉnh An Giang</a>
                        <a href="https://ldld.angiang.gov.vn/" class="site-link-item">Liên đoàn Lao động tỉnh</a>
                        <a href="#" class="site-link-item">Trường chính trị Tôn Đức Thắng</a>
                        <a href="https://vks.angiang.gov.vn/Trang/TrangChu.aspx" class="site-link-item">Viện kiểm
                            sát</a>
                        <a href="#" class="site-link-item">Ủy ban MTTQ Việt Nam tỉnh</a>
                        <a href="https://tinhdoanangiang.vn/" class="site-link-item">Tỉnh đoàn An Giang</a>

                        <a href="https://hlhpn.angiang.gov.vn/Trang/TrangChu.aspx" class="site-link-item">Hội liên
                            hiệp phụ nữ tỉnh An Giang</a>
                        <a href="https://vinafis.org.vn/" class="site-link-item">Hiệp hội Thủy sản tỉnh An Giang</a>
                        <a href="https://aba.angiang.vn/" class="site-link-item">Hiệp hội doanh nghiệp</a>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container px-0">
            <div class="site-footer-panel">
                <div class="site-footer-content">
                    <div class="site-footer-col">
                        <h3 class="site-footer-title">PHÒNG VH-XH XÃ VĨNH BÌNH</h3>

                        <p class="site-footer-text">
                            Trang thông tin điện tử Phòng Văn hóa - Xã hội xã Vĩnh Bình
                        </p>

                        <p class="site-footer-text">
                            Chịu trách nhiệm nội dung: Phòng VH-XH xã Vĩnh Bình
                        </p>

                        <div class="site-footer-socials">
                            <a href="#" class="footer-social footer-facebook" aria-label="Facebook">
                                f
                            </a>

                            <a href="#" class="footer-social footer-youtube" aria-label="YouTube">
                                ▶
                            </a>

                            <div class="weather-data-credit"> Dữ liệu thời tiết: <a href="https://open-meteo.com/"
                                    target="_blank" rel="noopener noreferrer"> Open-Meteo </a> </div>
                        </div>
                    </div>

                    <div class="site-footer-col">
                        <h3 class="site-footer-title">LIÊN HỆ</h3>

                        <ul class="site-footer-contact">
                            <li>☎ Điện thoại: Đang cập nhật</li>
                            <li>✉ Email: Đang cập nhật</li>
                            <li>⌂ Địa chỉ: Xã Vĩnh Bình, tỉnh An Giang</li>
                            <li>⏰ Thời gian tiếp nhận: Thứ Hai - Thứ Sáu, giờ hành chính</li>
                        </ul>
                    </div>
                </div>

                <div class="site-footer-bottom">
                    © Copyright Trang thông tin điện tử xã Vĩnh Bình. All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>

    <button class="back-to-top" type="button" aria-label="Cuộn lên đầu trang"
        onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">↑</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.site-links-tab');
            const contents = document.querySelectorAll('.site-links-content');

            tabs.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    const targetId = tab.getAttribute('data-tab');

                    tabs.forEach(function(item) {
                        item.classList.remove('active');
                    });

                    contents.forEach(function(content) {
                        content.classList.remove('active');
                    });

                    tab.classList.add('active');

                    const targetContent = document.getElementById(targetId);
                    if (targetContent) {
                        targetContent.classList.add('active');
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', async () => {

            try {

                const response = await fetch(
                    'https://api.open-meteo.com/v1/forecast?latitude=10.401&longitude=106.424&current=temperature_2m'
                );

                const data = await response.json();

                const temp = data.current.temperature_2m;

                document.getElementById('weather-box').innerHTML =
                    `🌤️ <span class="temp">${temp}°C</span> <span class="location">Vĩnh Bình</span>`;

            } catch (e) {

                document.getElementById('weather-box').innerHTML =
                    '🌤️ Vĩnh Bình';

            }

        });
    </script>
</body>

</html>
