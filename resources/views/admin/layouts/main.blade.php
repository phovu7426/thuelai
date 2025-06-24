<!--begin::App Wrapper-->
<div class="app-wrapper">
    @include('admin.layouts.header')
    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="light">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
            <!--begin::Brand Link-->
            <a href="./index.html" class="brand-link">
                <!--begin::Brand Image-->
                <img
                    src="{{ asset('adminlte/assets/img/AdminLTELogo.png') }}"
                    alt="AdminLTE Logo"
                    class="brand-image opacity-75 shadow"
                />
                <!--end::Brand Image-->
                <!--begin::Brand Text-->
                <span class="brand-text fw-light">AdminLTE 4</span>
                <!--end::Brand Text-->
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
