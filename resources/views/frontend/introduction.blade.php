@extends('frontend.layouts.app')

@section('content')
    <style>
        .introduction-page {
            padding: 26px 0 42px;
        }

        .introduction-breadcrumb {
            margin-bottom: 16px;
            color: #64748b;
            font-size: 14px;
        }

        .introduction-breadcrumb a {
            color: #07579e;
            text-decoration: none;
        }

        .introduction-hero {
            position: relative;
            margin-bottom: 28px;
            padding: 30px 34px;
            border-radius: 10px;
            background:
                radial-gradient(
                    circle at 88% 20%,
                    rgba(255, 255, 255, 0.17),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #064b87 0%,
                    #0b67b2 55%,
                    #1786cf 100%
                );
            color: #ffffff;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(7, 87, 158, 0.18);
        }

        .introduction-hero::after {
            content: "";
            position: absolute;
            right: -70px;
            bottom: -90px;
            width: 260px;
            height: 260px;
            border: 42px solid rgba(255, 255, 255, 0.07);
            border-radius: 50%;
        }

        .introduction-hero h1 {
            position: relative;
            z-index: 1;
            margin: 0 0 10px;
            font-size: 28px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .introduction-hero p {
            position: relative;
            z-index: 1;
            max-width: 850px;
            margin: 0;
            color: rgba(255, 255, 255, 0.92);
            font-size: 16px;
            line-height: 1.7;
        }

        .organization-section {
            padding: 28px;
            border: 1px solid #d7e5f2;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: 0 7px 22px rgba(15, 23, 42, 0.06);
        }

        .organization-section-heading {
            margin-bottom: 32px;
            text-align: center;
        }

        .organization-section-heading h2 {
            margin: 0;
            color: #064b87;
            font-size: 25px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .organization-section-heading h2::after {
            content: "";
            display: block;
            width: 72px;
            height: 3px;
            margin: 12px auto 0;
            border-radius: 999px;
            background: #f0ad18;
        }

        .organization-section-heading p {
            margin: 12px 0 0;
            color: #64748b;
            font-size: 15px;
        }

        /*
         * Thẻ cán bộ chung
         */
       .organization-member-card { position: relative; height: auto; min-height: 0; padding: 24px 20px 20px;
            border: 1px solid #d8e5f1;
            border-radius: 12px;
            background: #ffffff;
            text-align: center;
            box-shadow: 0 5px 16px rgba(15, 23, 42, 0.07);
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;
        }

        .organization-member-card:hover {
            transform: translateY(-4px);
            border-color: #8ec3ed;
            box-shadow: 0 10px 24px rgba(7, 87, 158, 0.15);
        }

        .organization-member-photo-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 14px;
        }

        .organization-member-photo {
            width: 100px;
            height: 100px;
            border: 4px solid #eaf4fc;
            border-radius: 50%;
            background: #eef6fc;
            object-fit: cover;
        }

        .organization-member-photo-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #07579e;
            font-size: 34px;
            font-weight: 800;
        }

        .organization-member-level {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 28px;
            margin-bottom: 10px;
            padding: 4px 13px;
            border-radius: 999px;
            background: #e8f4ff;
            color: #07579e;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .organization-member-name {
            margin: 0;
            color: #0f2942;
            font-size: 19px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .organization-member-position {
            margin-top: 6px;
            color: #07579e;
            font-size: 15px;
            font-weight: 700;
        }

        .organization-member-department {
            margin-top: 5px;
            color: #64748b;
            font-size: 13px;
        }

        .organization-member-responsibility {
            margin-top: 16px;
            padding: 12px;
            border-left: 3px solid #1681cc;
            background: #f4f9fe;
            color: #475569;
            text-align: left;
            font-size: 13px;
            line-height: 1.55;
        }

        .organization-member-responsibility strong {
            color: #07579e;
        }

        .organization-member-responsibility p {
            margin: 4px 0 0;
        }

        .organization-member-contact {
            display: flex;
            flex-direction: column;
            gap: 7px;
            margin-top: 15px;
        }

        .organization-member-contact a {
            color: #334155;
            text-decoration: none;
            font-size: 13px;
        }

        .organization-member-contact a:hover {
            color: #07579e;
        }

        .organization-member-biography {
            margin-top: 14px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.55;
            text-align: left;
        }

        /*
         * Trưởng phòng
         */
        .organization-head-level {
            display: flex;
            justify-content: center;
            gap: 24px;
        }

        .organization-head-level .organization-member-card {
            width: min(100%, 390px);
            border: 2px solid #e3ad2f;
            background:
                linear-gradient(
                    180deg,
                    #fffdf5 0%,
                    #ffffff 38%
                );
        }

        .organization-member-card--head .organization-member-photo {
            width: 132px;
            height: 132px;
            border-color: #f7df9e;
        }

        .organization-member-card--head .organization-member-level {
            background: #fff0be;
            color: #8b5a00;
        }

        .organization-member-card--head .organization-member-name {
            font-size: 22px;
        }

        /*
         * Đường nối từ Trưởng phòng xuống Phó phòng
         */
        .organization-main-connector {
            width: 3px;
            height: 38px;
            margin: 0 auto;
            background: #5aa4dc;
        }

        .organization-branches {
            position: relative;
            display: grid;
            grid-template-columns: repeat(
                auto-fit,
                minmax(280px, 1fr)
            );
            gap: 26px;
            padding-top: 32px;
        }

        .organization-branches::before {
            content: "";
            position: absolute;
            top: 0;
            left: 12%;
            right: 12%;
            height: 3px;
            background: #5aa4dc;
        }

        .organization-branches.is-single::before {
            display: none;
        }

        .organization-branch {
            position: relative;
        }

        .organization-branch::before {
            content: "";
            position: absolute;
            top: -32px;
            left: 50%;
            width: 3px;
            height: 32px;
            transform: translateX(-50%);
            background: #5aa4dc;
        }

        .organization-member-card--deputy {
            border-top: 4px solid #1681cc;
        }

        .organization-member-card--deputy .organization-member-photo {
            width: 108px;
            height: 108px;
        }

        .organization-child-connector {
            width: 3px;
            height: 28px;
            margin: 0 auto;
            background: #9bc6e6;
        }

        .organization-staff-grid {
            display: grid;
            grid-template-columns: repeat(
                auto-fit,
                minmax(220px, 1fr)
            );
            gap: 14px;
        }

        .organization-member-card--staff {
            padding: 19px 15px 16px;
            border-top: 3px solid #7ab6df;
        }

        .organization-member-card--staff .organization-member-photo {
            width: 82px;
            height: 82px;
            border-width: 3px;
        }

        .organization-member-card--staff .organization-member-name {
            font-size: 16px;
        }

        .organization-member-card--staff .organization-member-position {
            font-size: 13px;
        }

        /*
         * Công chức chưa gán trực tiếp cho Phó phòng
         */
        .organization-general-staff {
            margin-top: 36px;
            padding-top: 28px;
            border-top: 1px dashed #bdd4e8;
        }

        .organization-general-staff h3 {
            margin: 0 0 20px;
            color: #07579e;
            font-size: 20px;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
        }

        .organization-empty {
            padding: 35px 20px;
            border: 1px dashed #b9ccdd;
            border-radius: 10px;
            background: #f8fbfe;
            color: #64748b;
            text-align: center;
        }

        @media (max-width: 991.98px) {
            .organization-branches {
                grid-template-columns: 1fr;
                padding-top: 0;
            }

            .organization-branches::before,
            .organization-branch::before,
            .organization-main-connector {
                display: none;
            }

            .organization-branch {
                padding-left: 18px;
                border-left: 3px solid #91c1e4;
            }

            .organization-child-connector {
                height: 20px;
                margin-left: 34px;
            }
        }

        @media (max-width: 576px) {
            .introduction-page {
                padding-top: 15px;
            }

            .introduction-hero {
                padding: 23px 20px;
            }

            .introduction-hero h1 {
                font-size: 22px;
            }

            .organization-section {
                padding: 19px 14px;
            }

            .organization-section-heading h2 {
                font-size: 21px;
            }

            .organization-head-level {
                display: block;
            }

            .organization-head-level .organization-member-card {
                width: 100%;
            }

            .organization-staff-grid {
                grid-template-columns: 1fr;
            }
        }
        /* ===== SỬA LỖI SƠ ĐỒ TỔ CHỨC BỊ CHỒNG LAYOUT ===== */
        .organization-section { width: 100%; height: auto; overflow: visible; } .organization-branches { align-items: start; } .organization-branch { display: flex; flex-direction: column; min-width: 0; height: auto; }
        /* Không cho thẻ Phó phòng kéo dài bằng cả nhánh */
        .organization-member-card--deputy {  height: auto !important; flex: 0 0 auto; }
        /* Đường nối không được co giãn */
        .organization-child-connector { flex: 0 0 auto; }
        /* Khối công chức phải nằm đúng bên dưới Phó phòng */
        .organization-staff-grid { position: relative; z-index: 1; width: 100%; align-items: stretch; }
        /* Chỉ các thẻ công chức trong cùng một hàng mới bằng chiều cao */
        .organization-staff-grid > .organization-member-card { height: 100%; min-height: 0; }
        /* Không để nội dung trong card tràn ngang */
        .organization-member-card { width: 100%; box-sizing: border-box; overflow-wrap: anywhere; } .organization-member-responsibility, .organization-member-biography, .organization-member-contact { width: 100%; min-width: 0; overflow-wrap: anywhere; }
        /* Khối Liên kết trang luôn nằm sau sơ đồ tổ chức */
        .site-links-section { position: relative; clear: both; z-index: 1; margin-top: 32px; }
        /* Mobile */
        @media (max-width: 991.98px) { .organization-branch { width: 100%; } .organization-member-card--deputy, .organization-member-card--staff { height: auto !important; } } @media (max-width: 576px) { .organization-member-card { height: auto !important; } }
        ```css
/* ===== ĐỒNG BỘ ĐỘ RỘNG TRANG GIỚI THIỆU VỚI HEADER ===== */
.introduction-page > .introduction-container {
    width: 100%;
    max-width: var(--portal-width, 1200px) !important;
    margin-left: auto !important;
    margin-right: auto !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    box-sizing: border-box;
}

.introduction-breadcrumb,
.introduction-hero,
.organization-section {
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
}

/* Tablet và mobile vẫn giữ khoảng cách an toàn hai bên */
@media (max-width: 1239.98px) {
    .introduction-page > .introduction-container {
        padding-left: 12px !important;
        padding-right: 12px !important;
    }
}

@media (max-width: 576px) {
    .introduction-page > .introduction-container {
        padding-left: 10px !important;
        padding-right: 10px !important;
    }
}

/* ===== ĐỒNG BỘ KHUNG TRƯỞNG PHÒNG VÀ PHÓ PHÒNG ===== */

/* Khung Trưởng phòng */
.organization-head-level .organization-member-card--head {
    width: min(100%, 390px);
    min-height: 270px;
    height: auto;
    margin-left: auto;
    margin-right: auto;
}

/* Mỗi nhánh tổ chức căn giữa thẻ Phó phòng */
.organization-branch {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-width: 0;
}

/* Khung Phó phòng bằng khung Trưởng phòng */
.organization-member-card--deputy {
    width: min(100%, 390px) !important;
    min-height: 270px;
    height: auto !important;
    flex: 0 0 auto;
    margin-left: auto;
    margin-right: auto;
    padding: 24px 20px 20px;
}

/* Ảnh Phó phòng đồng kích thước với ảnh Trưởng phòng */
.organization-member-card--deputy .organization-member-photo {
    width: 132px;
    height: 132px;
    border-width: 4px;
}

/* Công chức bên dưới vẫn sử dụng hết chiều rộng */
.organization-branch > .organization-staff-grid {
    width: 100%;
    align-self: stretch;
}

/* Đường nối nằm chính giữa */
.organization-child-connector {
    margin-left: auto;
    margin-right: auto;
}

/* Trường hợp chỉ có một Phó phòng */
.organization-branches.is-single {
    grid-template-columns: minmax(0, 1fr);
}

.organization-branches.is-single .organization-branch {
    width: 100%;
}

/* Điện thoại */
@media (max-width: 576px) {
    .organization-head-level .organization-member-card--head,
    .organization-member-card--deputy {
        width: 100% !important;
        min-height: 0;
    }

    .organization-member-card--deputy .organization-member-photo {
        width: 108px;
        height: 108px;
    }
}


    </style>

    <section class="introduction-page">
        <div class="container introduction-container" style="max-width: 1215px">
            <div class="introduction-breadcrumb">
                <a href="{{ url('/') }}">Trang chủ</a>
                <span> / </span>
                <span>Giới thiệu</span>
            </div>

            <div class="introduction-hero">
                <h1>Phòng Văn hóa - Xã hội xã Vĩnh Bình</h1>

                <p>
                    Thông tin về cơ cấu tổ chức, lãnh đạo và công chức
                    chuyên môn của Phòng Văn hóa - Xã hội xã Vĩnh Bình.
                    Các cán bộ được sắp xếp theo cấp chức vụ và lĩnh vực
                    phụ trách.
                </p>
            </div>

            <div class="organization-section">
                <div class="organization-section-heading">
                    <h2>Cơ cấu tổ chức</h2>

                    <p>
                        Sơ đồ lãnh đạo và công chức từ cấp Trưởng phòng
                        đến các bộ phận chuyên môn
                    </p>
                </div>

                @if (
                    $heads->isEmpty()
                    && $deputies->isEmpty()
                    && $staff->isEmpty()
                )
                    <div class="organization-empty">
                        Thông tin cơ cấu tổ chức đang được cập nhật.
                    </div>
                @else
                    @if ($heads->isNotEmpty())
                        <div class="organization-head-level">
                            @foreach ($heads as $head)
                                @include(
                                    'frontend.partials.organization-member-card',
                                    [
                                        'member' => $head,
                                        'variant' => 'head',
                                    ]
                                )
                            @endforeach
                        </div>
                    @endif

                    @if ($deputies->isNotEmpty())
                        @if ($heads->isNotEmpty())
                            <div class="organization-main-connector"></div>
                        @endif

                        <div class="organization-branches {{ $deputies->count() === 1 ? 'is-single' : '' }}">
                            @foreach ($deputies as $deputy)
                                @php
                                    $branchStaff = $staffByParent->get(
                                        $deputy->id,
                                        collect()
                                    );
                                @endphp

                                <div class="organization-branch">
                                    @include(
                                        'frontend.partials.organization-member-card',
                                        [
                                            'member' => $deputy,
                                            'variant' => 'deputy',
                                        ]
                                    )

                                    @if ($branchStaff->isNotEmpty())
                                        <div class="organization-child-connector"></div>

                                        <div class="organization-staff-grid">
                                            @foreach ($branchStaff as $staffMember)
                                                @include(
                                                    'frontend.partials.organization-member-card',
                                                    [
                                                        'member' => $staffMember,
                                                        'variant' => 'staff',
                                                    ]
                                                )
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if ($unassignedStaff->isNotEmpty())
                        <div class="organization-general-staff">
                            <h3>Công chức chuyên môn</h3>

                            <div class="organization-staff-grid">
                                @foreach ($unassignedStaff as $staffMember)
                                    @include(
                                        'frontend.partials.organization-member-card',
                                        [
                                            'member' => $staffMember,
                                            'variant' => 'staff',
                                        ]
                                    )
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>
@endsection
