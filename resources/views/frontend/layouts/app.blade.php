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
            height: 58px;
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
            font-size: 14px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
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
            margin-top: 10px;
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
            gap: 12px 34px;
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
            margin-top: 32px;
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
            font-size: 15px;
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

    background: linear-gradient(
        135deg,
        #f8fbfe 0%,
        #edf6fd 100%
    );

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
                <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse"
                    data-bs-target="#frontendNavbar" aria-controls="frontendNavbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="frontendNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link px-3" href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="nav-item"><a class="nav-link px-3" href="{{ route('frontend.introduction') }}">Giới
                                thiệu</a></li>
                        @if ($introPage)
                            <li class="nav-item">
                                <a class="nav-link px-3"
                                    href="{{ route('frontend.pages.show', $introPage->slug) }}">{{ $introPage->title }}</a>
                            </li>
                        @endif

                        @foreach ($frontendMenuCategories as $category)
                            <li class="nav-item">
                                <a class="nav-link px-3"
                                    href="{{ route('frontend.categories.show', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-2">
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
