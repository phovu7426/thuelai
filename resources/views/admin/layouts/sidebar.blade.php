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
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ isActive('admin.dashboard') }}">
                    <i class="nav-icon bi bi-speedometer2"></i>
                    <p>Tổng quan</p>
                </a>
            </li>

            {{-- Quản lý tài khoản --}}
            @canany(['view_users', 'create_users', 'edit_users', 'delete_users', 'assign_users'])
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ isActive('admin.users.*') }}">
                    <i class="nav-icon bi bi-people-fill"></i>
                    <p>Quản lý tài khoản</p>
                </a>
            </li>
            @endcanany

            {{-- Quản lý vai trò --}}
            @canany(['view_roles', 'create_roles', 'edit_roles', 'delete_roles'])
            <li class="nav-item">
                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ isActive('admin.roles.*') }}">
                    <i class="nav-icon bi bi-person-badge-fill"></i>
                    <p>Quản lý vai trò</p>
                </a>
            </li>
            @endcanany

            {{-- Quản lý quyền --}}
            @canany(['view_permissions', 'create_permissions', 'edit_permissions', 'delete_permissions'])
            <li class="nav-item">
                <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ isActive('admin.permissions.*') }}">
                    <i class="nav-icon bi bi-shield-lock-fill"></i>
                    <p>Quản lý quyền</p>
                </a>
            </li>
            @endcanany

            {{-- Quản lý slide --}}
            <li class="nav-item">
                <a href="{{ route('admin.slides.index') }}" class="nav-link {{ isActive('admin.slides.*') }}">
                    <i class="nav-icon bi bi-sliders"></i>
                    <p>Quản lý slide</p>
                </a>
            </li>

            @php
                try {
                    $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
                } catch (\Exception $e) {
                    $pendingOrders = 0;
                }
                
                try {
                    $pendingContacts = \App\Models\StoneContact::where('is_read', 0)->count();
                } catch (\Exception $e) {
                    $pendingContacts = 0;
                }
            @endphp

            {{-- Danh mục đá --}}
            <li class="nav-item">
                <a href="{{ route('admin.stone.categories.index') }}" class="nav-link {{ isActive('admin.stone.categories.*') }}">
                    <i class="nav-icon bi bi-folder2"></i>
                    <p>Danh mục đá</p>
                </a>
            </li>

            {{-- Chất liệu đá --}}
            <li class="nav-item">
                <a href="{{ route('admin.stone.materials.index') }}" class="nav-link {{ isActive('admin.stone.materials.*') }}">
                    <i class="nav-icon bi bi-box-seam"></i>
                    <p>Chất liệu đá</p>
                </a>
            </li>

            {{-- Bề mặt đá --}}
            <li class="nav-item">
                <a href="{{ route('admin.stone.surfaces.index') }}" class="nav-link {{ isActive('admin.stone.surfaces.*') }}">
                    <i class="nav-icon bi bi-layers"></i>
                    <p>Bề mặt đá</p>
                </a>
            </li>

            {{-- Ứng dụng đá --}}
            <li class="nav-item">
                <a href="{{ route('admin.stone.applications.index') }}" class="nav-link {{ isActive('admin.stone.applications.*') }}">
                    <i class="nav-icon bi bi-tools"></i>
                    <p>Ứng dụng đá</p>
                </a>
            </li>

            {{-- Sản phẩm đá --}}
            <li class="nav-item">
                <a href="{{ route('admin.stone.products.index') }}" class="nav-link {{ isActive('admin.stone.products.*') }}">
                    <i class="nav-icon bi bi-grid"></i>
                    <p>Sản phẩm đá</p>
                </a>
            </li>

            {{-- Dự án đá --}}
            <li class="nav-item">
                <a href="{{ route('admin.stone.projects.index') }}" class="nav-link {{ isActive('admin.stone.projects.*') }}">
                    <i class="nav-icon bi bi-building"></i>
                    <p>Dự án đá</p>
                </a>
            </li>

            {{-- Showroom --}}
            <li class="nav-item">
                <a href="{{ route('admin.stone.showrooms.index') }}" class="nav-link {{ isActive('admin.stone.showrooms.*') }}">
                    <i class="nav-icon bi bi-shop"></i>
                    <p>Showroom</p>
                </a>
            </li>

            {{-- Video --}}
            <li class="nav-item">
                <a href="{{ route('admin.stone.videos.index') }}" class="nav-link {{ isActive('admin.stone.videos.*') }}">
                    <i class="nav-icon bi bi-play-circle"></i>
                    <p>Video</p>
                </a>
            </li>

            {{-- Đơn hàng --}}
            <li class="nav-item">
                <a href="{{ route('admin.stone.orders.index') }}" class="nav-link {{ isActive('admin.stone.orders.*') }}">
                    <i class="nav-icon bi bi-cart-check"></i>
                    <p>
                        Đơn hàng
                        @if($pendingOrders > 0)
                            <span class="badge bg-danger float-end">{{ $pendingOrders }}</span>
                        @endif
                    </p>
                </a>
            </li>

            {{-- Liên hệ --}}
            <li class="nav-item">
                <a href="{{ route('admin.stone.contacts.index') }}" class="nav-link {{ isActive('admin.stone.contacts.*') }}">
                    <i class="nav-icon bi bi-envelope"></i>
                    <p>
                        Liên hệ
                        @if($pendingContacts > 0)
                            <span class="badge bg-danger float-end">{{ $pendingContacts }}</span>
                        @endif
                    </p>
                </a>
            </li>

            {{-- Cấu hình --}}
            <li class="nav-item">
                <a href="{{ route('admin.contact-info.edit') }}" class="nav-link {{ isActive('admin.contact-info.*') }}">
                    <i class="nav-icon bi bi-gear"></i>
                    <p>Cấu hình hệ thống</p>
                </a>
            </li>

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
