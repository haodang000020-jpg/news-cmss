<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $metaDescription ?? 'Cổng thông tin điện tử Phòng Văn Hóa - Xã Hội' }}">
        <title>{{ ($metaTitle ?? 'Trang chủ').' - Phòng Văn Hóa - Xã Hội' }}</title>
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
                line-height: 1.3;
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

.home-main-grid > [class*="col-"] {
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
    padding: 12px;
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

.home-main-grid > [class*="col-"] {
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

.featured-news-card .carousel-item > a,
.featured-news-card .carousel-item > div {
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
.portal-nav > .container {
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

    .home-main-grid > [class*="col-"] {
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

    .featured-news-card .carousel-item > a,
    .featured-news-card .carousel-item > div {
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
    width: 56px;
    height: 44px;
    background: #eef6ff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
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

    .home-main-grid > [class*="col-"] {
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
        padding: 18px !important;
    }

    .hotline-item {
        padding: 10px 0;
        border-bottom: 1px solid #edf2f7;
        line-height: 1.5;
    }

    .hotline-note {
        margin-top: 16px;
        padding: 14px;
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
                        <div id="siteHeaderBannerCarousel" class="carousel slide site-header-banner-carousel" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover" data-bs-touch="true">
                            <div class="carousel-inner">
                                @foreach ($siteHeaderBanners as $banner)
                                    <div class="carousel-item @if ($loop->first) active @endif">
                                        @if ($banner->link)
                                            <a class="site-header-banner-link" href="{{ $banner->link }}">
                                                <img src="{{ asset('storage/'.$banner->image) }}" class="site-header-banner-image" alt="{{ $banner->title }}">
                                            </a>
                                        @else
                                            <img src="{{ asset('storage/'.$banner->image) }}" class="site-header-banner-image" alt="{{ $banner->title }}">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        @php($banner = $siteHeaderBanners->first())
                        @if ($banner->link)
                            <a class="site-header-banner-link" href="{{ $banner->link }}">
                                <img src="{{ asset('storage/'.$banner->image) }}" class="site-header-banner-image" alt="{{ $banner->title }}">
                            </a>
                        @else
                            <img src="{{ asset('storage/'.$banner->image) }}" class="site-header-banner-image" alt="{{ $banner->title }}">
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
                            <input class="form-control" type="search" name="q" value="{{ request('q') }}" placeholder="Tìm kiếm bài viết">
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
            <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#frontendNavbar" aria-controls="frontendNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="frontendNavbar">
                <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link px-3" href="{{ route('home') }}">Trang chủ</a></li>
                        @if ($introPage)
                            <li class="nav-item">
                                <a class="nav-link px-3" href="{{ route('frontend.pages.show', $introPage->slug) }}">{{ $introPage->title }}</a>
                            </li>
                        @endif

                        @foreach ($frontendMenuCategories as $category)
                            <li class="nav-item">
                                <a class="nav-link px-3" href="{{ route('frontend.categories.show', $category->slug) }}">{{ $category->name }}</a>
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

        <footer class="site-footer">
            <div class="container site-footer-inner">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="site-footer-title">UBND XÃ VĨNH BÌNH</div>
                        <p>Người phát ngôn: UBND Xã Vĩnh Bình</p>
                        <p>Chịu trách nhiệm nội dung: UBND Xã Vĩnh Bình</p>

                        <div class="site-footer-badges" aria-label="Chứng nhận và kênh thông tin">
                            <span class="site-footer-badge">NCA</span>
                            <span class="site-footer-badge">Website đạt chứng nhận Tín nhiệm mạng</span>
                            <span class="site-footer-badge">Facebook</span>
                            <span class="site-footer-badge">YouTube</span>
                            <span class="site-footer-badge">IPv6</span>
                        </div>
                    </div>

                    <div class="col-md-6 site-footer-contact">
                        <div class="site-footer-title">LIÊN HỆ</div>
                        <div><a href="{{ route('home') }}">Góp ý</a> | <a href="{{ route('frontend.sitemap') }}">Sơ đồ website</a> | RSS</div>
                        <div><span aria-hidden="true">⌂</span> ..., Xã Vĩnh Bình, tỉnh An Giang.</div>
                        <div><span aria-hidden="true">☎</span> Đang cập nhật... - Fax: Đang cập nhật...</div>
                        <div><span aria-hidden="true">@</span> @angiang.gov.vn</div>
                    </div>
                </div>

                <div class="site-footer-copyright">
                    © Copyright Trang thông tin điện tử xã Vĩnh Bình. All Rights Reserved.
                </div>
            </div>
        </footer>

        <button class="back-to-top" type="button" aria-label="Cuộn lên đầu trang" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">↑</button>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
