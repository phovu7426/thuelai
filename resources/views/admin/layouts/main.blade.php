<!doctype html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>AdminLTE v4 | @yield('title', '')</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="title" content="AdminLTE v4 | Dashboard"/>
    <meta name="author" content="ColorlibHQ"/>
    <meta
        name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
        name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
        crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}"/>
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        crossorigin="anonymous"
    />
    <!-- jsvectormap -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <!-- Thêm CSS cho Select2 -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"/>
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    
    <style>
        /* CSS để sửa hiển thị menu sidebar */
        .sidebar-menu .nav-item > ul.nav-treeview {
            display: none; /* Ẩn tất cả submenu mặc định */
            height: auto !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        .sidebar-menu .nav-item.menu-open > ul.nav-treeview {
            display: block !important; /* Hiển thị submenu khi có class menu-open */
        }
        
        .sidebar-menu .nav-arrow {
            transition: transform 0.3s;
        }
        
        .sidebar-menu .nav-item.menu-open > a .nav-arrow {
            transform: rotate(90deg); /* Xoay mũi tên khi menu được mở */
        }
    </style>
    
    @yield('styles')
</head>
<!--end::Head-->
<!--begin::Body-->
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<!--begin::App Wrapper-->
<div class="app-wrapper">
    @include('admin.layouts.header')
    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="light">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
            <!--begin::Brand Link-->
            <a href="{{ route('admin.index') }}" class="brand-link">
                <!--begin::Brand Image-->
                <img
                    src="{{ asset('images/default/logov2.png') }}"
                    class="brand-image"
                />
            </a>
            <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        @include('admin.layouts.sidebar')
    </aside>
    <!--end::Sidebar-->
    <!--begin::App Main-->
    <main class="app-main">
        @include('admin.layouts.pathway')
        <!--begin::App Content-->
        @yield('content')
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
    @include('admin.layouts.footer')
</div>
<!--end::App Wrapper-->

<!--begin::Script-->
<!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script
    src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"
></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"
></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    crossorigin="anonymous"
></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="{{ asset('adminlte/js/adminlte.js') }}"></script>
<!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
<script>
    if (typeof SELECTOR_SIDEBAR_WRAPPER === 'undefined') {
        var SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    }
    if (typeof SidebarScrollDefault === 'undefined') {
        var SidebarScrollDefault = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
    }
    document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: SidebarScrollDefault.scrollbarTheme,
                    autoHide: SidebarScrollDefault.scrollbarAutoHide,
                    clickScroll: SidebarScrollDefault.scrollbarClickScroll,
                },
            });
        }
    });
</script>
<!--end::OverlayScrollbars Configure-->

<script>
    $(document).ready(function() {
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    });
</script>


<script src="{{ asset('js/admin-custom.js') }}"></script>

@yield('scripts')
<!--end::Script-->
</body>
<!--end::Body-->
</html>
