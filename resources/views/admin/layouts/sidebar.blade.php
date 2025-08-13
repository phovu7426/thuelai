<!--begin::Sidebar Wrapper-->
<div class="sidebar-wrapper">
    <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" role="menu">
            <style>
                /* CSS cho menu */
                .sidebar-menu .nav-item {
                    margin-bottom: 5px;
                }
                
                .sidebar-menu .nav-link {
                    border-radius: 8px;
                    transition: all 0.3s ease;
                    padding: 0.8rem 1rem;
                }
                
                .sidebar-menu .nav-link:hover {
                    background-color: rgba(255, 255, 255, 0.1);
                }
                
                .sidebar-menu .nav-link.active {
                    background-color: rgba(255, 255, 255, 0.2);
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                
                .sidebar-menu .nav-icon {
                    margin-right: 10px;
                }
                
                .nav-badge {
                    float: right;
                    margin-top: 3px;
                }
            </style>

            {{-- Tổng quan --}}
            @can('access_dashboard')
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ isActive('admin.dashboard') }}">
                    <i class="nav-icon bi bi-speedometer2"></i>
                    <p>Tổng quan</p>
                </a>
            </li>
            @endcan

            {{-- Quản lý tài khoản --}}
            @can('access_users')
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ isActive('admin.users.*') }}">
                    <i class="nav-icon bi bi-people-fill"></i>
                    <p>Quản lý tài khoản</p>
                </a>
            </li>
            @endcan

            {{-- Quản lý vai trò --}}
            @can('access_roles')
            <li class="nav-item">
                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ isActive('admin.roles.*') }}">
                    <i class="nav-icon bi bi-person-badge-fill"></i>
                    <p>Quản lý vai trò</p>
                </a>
            </li>
            @endcan

            {{-- Quản lý quyền --}}
            @can('access_permissions')
            <li class="nav-item">
                <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ isActive('admin.permissions.*') }}">
                    <i class="nav-icon bi bi-shield-lock-fill"></i>
                    <p>Quản lý quyền</p>
                </a>
            </li>
            @endcan

            {{-- Quản lý slide --}}
            @can('access_slides')
            <li class="nav-item">
                <a href="{{ route('admin.slides.index') }}" class="nav-link {{ isActive('admin.slides.*') }}">
                    <i class="nav-icon bi bi-sliders"></i>
                    <p>Quản lý slide</p>
                </a>
            </li>
            @endcan

            {{-- Stone menu items removed - stone functionality no longer exists --}}

            {{-- ===== DRIVER SERVICES SECTION ===== --}}
            @can('access_driver_services')
            <li class="nav-item">
                <a href="{{ route('admin.driver.dashboard') }}" class="nav-link {{ request()->routeIs('admin.driver.dashboard') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-car-front"></i>
                    <p>Dịch vụ lái xe</p>
                </a>
            </li>
            @endcan

            {{-- Quản lý dịch vụ lái xe --}}
            @can('access_driver_services')
            <li class="nav-item">
                <a href="{{ route('admin.driver.services.index') }}" class="nav-link {{ request()->routeIs('admin.driver.services.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-gear"></i>
                    <p>Quản lý dịch vụ</p>
                </a>
            </li>
            @endcan

            {{-- Quản lý đơn hàng lái xe --}}
            @can('access_driver_orders')
            <li class="nav-item">
                <a href="{{ route('admin.driver.orders.index') }}" class="nav-link {{ request()->routeIs('admin.driver.orders.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-cart-check"></i>
                    <p>Đơn hàng lái xe</p>
                </a>
            </li>
            @endcan

            {{-- Quản lý testimonials --}}
            @can('access_driver_testimonials')
            <li class="nav-item">
                <a href="{{ route('admin.driver.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.driver.testimonials.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-chat-quote"></i>
                    <p>Đánh giá khách hàng</p>
                </a>
            </li>
            @endcan

            {{-- Quản lý liên hệ lái xe --}}
            @can('access_driver_contacts')
            <li class="nav-item">
                <a href="{{ route('admin.driver.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.driver.contacts.*') ? 'active' : '' }}">
                    <i class="nav-icon bi bi-envelope"></i>
                    <p>Liên hệ lái xe</p>
                </a>
            </li>
            @endcan

            {{-- ===== END DRIVER SERVICES SECTION ===== --}}

            {{-- Cấu hình --}}
            @can('access_contact-info')
            <li class="nav-item">
                <a href="{{ route('admin.contact-info.edit') }}" class="nav-link {{ isActive('admin.contact-info.*') }}">
                    <i class="nav-icon bi bi-gear"></i>
                    <p>Cấu hình hệ thống</p>
                </a>
            </li>
            @endcan
        </ul>
        <!--end::Sidebar Menu-->
    </nav>
</div>
<!--end::Sidebar Wrapper-->

<script>
    // Script khẩn cấp để sửa menu
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý menu đã mở
        var openMenuItems = document.querySelectorAll('.sidebar-menu .nav-item.menu-open');
        openMenuItems.forEach(function(item) {
            var treeview = item.querySelector('.nav-treeview');
            if (treeview) {
                treeview.style.display = 'block';
            }
        });

        // Xử lý sự kiện click trên menu
        document.querySelectorAll('.sidebar-menu .nav-item > a').forEach(function(menuLink) {
            if (menuLink.nextElementSibling && menuLink.nextElementSibling.classList.contains(
                    'nav-treeview')) {
                menuLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var navItem = this.parentNode;
                    var treeview = this.nextElementSibling;

                    if (navItem.classList.contains('menu-open')) {
                        navItem.classList.remove('menu-open');
                        treeview.style.display = 'none';
                    } else {
                        navItem.classList.add('menu-open');
                        treeview.style.display = 'block';
                    }

                    return false;
                });
            }
        });
    });
</script>
