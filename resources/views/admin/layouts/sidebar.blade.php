<!--begin::Sidebar Wrapper-->
<div class="sidebar-wrapper">
    <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
            <style>
                /* CSS để khắc phục menu */
                .sidebar-menu .nav-treeview {
                    display: none;
                }

                .sidebar-menu .menu-open>.nav-treeview {
                    display: block !important;
                }
            </style>

            {{-- Quản lý chung --}}
            @php
                $activeGroupGeneral = isActive(['admin.users.*', 'admin.roles.*', 'admin.permissions.*'], 'menu-open');
                $activeLinkGeneral = isActive(['admin.users.*', 'admin.roles.*', 'admin.permissions.*']);
            @endphp

            <li class="nav-item {{ $activeGroupGeneral }}">
                <a href="#" class="nav-link {{ $activeLinkGeneral }}">
                    <i class="nav-icon bi bi-box-seam-fill"></i>
                    <p>
                        Quản lý chung
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @canany(['view_users', 'create_users', 'edit_users', 'delete_users', 'assign_users'])
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ isActive('admin.users.*') }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Quản lý tài khoản</p>
                            </a>
                        </li>
                    @endcanany

                    @canany(['view_roles', 'create_roles', 'edit_roles', 'delete_roles'])
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ isActive('admin.roles.*') }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Quản lý vai trò</p>
                            </a>
                        </li>
                    @endcanany

                    @canany(['view_permissions', 'create_permissions', 'edit_permissions', 'delete_permissions'])
                        <li class="nav-item">
                            <a href="{{ route('admin.permissions.index') }}"
                                class="nav-link {{ isActive('admin.permissions.*') }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Quản lý quyền</p>
                            </a>
                        </li>
                    @endcanany
                </ul>
            </li>


            {{-- Quản lý khai báo --}}
            @php
                $activeGroupDeclaration = isActive(
                    ['admin.categories.*', 'admin.series.*', 'admin.posts.*'],
                    'menu-open',
                );
                $activeLinkDeclaration = isActive(['admin.categories.*', 'admin.series.*', 'admin.posts.*']);
            @endphp

            <li class="nav-item {{ $activeGroupDeclaration }}">
                <a href="#" class="nav-link {{ $activeLinkDeclaration }}">
                    <i class="nav-icon bi bi-file-earmark-text"></i>
                    <p>
                        Quản lý khai báo
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @canany(['view_declarations', 'create_declarations', 'edit_declarations', 'delete_declarations'])
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}"
                                class="nav-link {{ isActive('admin.categories.*') }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Quản lý danh mục</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.series.index') }}" class="nav-link {{ isActive('admin.series.*') }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Quản lý series</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.posts.index') }}" class="nav-link {{ isActive('admin.posts.*') }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Quản lý bài đăng</p>
                            </a>
                        </li>
                    @endcanany
                </ul>
            </li>

            {{-- Quản lý slide --}}
            @php
                $activeGroupSlide = isActive(['admin.slides.*'], 'menu-open');
                $activeLinkSlide = isActive(['admin.slides.*']);
            @endphp
            <li class="nav-item {{ $activeGroupSlide }}">
                <a href="{{ route('admin.slides.index') }}" class="nav-link {{ $activeLinkSlide }}">
                    <i class="nav-icon bi bi-images"></i>
                    <p>Quản lý slide</p>
                </a>
            </li>

            {{-- Quản lý trang Stone --}}
            @php
                $activeGroupStone = isActive(['admin.stone.*'], 'menu-open');
                $activeLinkStone = isActive(['admin.stone.*']);
            @endphp

            <li class="nav-item {{ $activeGroupStone }}">
                <a href="#" class="nav-link {{ $activeLinkStone }}">
                    <i class="nav-icon bi bi-gem"></i>
                    <p>
                        Quản lý trang Stone
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.stone.categories.index') }}"
                            class="nav-link {{ isActive('admin.stone.categories.*') }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Danh mục đá</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.stone.materials.index') }}"
                            class="nav-link {{ isActive('admin.stone.materials.*') }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Chất liệu đá</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.stone.surfaces.index') }}"
                            class="nav-link {{ isActive('admin.stone.surfaces.*') }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Bề mặt đá</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.stone.applications.index') }}"
                            class="nav-link {{ isActive('admin.stone.applications.*') }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Ứng dụng đá</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.stone.products.index') }}"
                            class="nav-link {{ isActive('admin.stone.products.*') }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Sản phẩm đá</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.stone.projects.index') }}"
                            class="nav-link {{ isActive('admin.stone.projects.*') }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Dự án đá</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.stone.showrooms.index') }}"
                            class="nav-link {{ isActive('admin.stone.showrooms.*') }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Showroom</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.stone.videos.index') }}"
                            class="nav-link {{ isActive('admin.stone.videos.*') }}">
                            <i class="nav-icon bi bi-circle"></i>
                            <p>Video</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.stone.orders.index') }}"
                            class="nav-link {{ isActive('admin.stone.orders.*') }}">
                            <i class="nav-icon bi bi-cart-check"></i>
                            <p>Đơn hàng</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.stone.contacts.index') }}"
                            class="nav-link {{ isActive('admin.stone.contacts.*') }}">
                            <i class="nav-icon bi bi-cart-check"></i>
                            <p>Liên hệ</p>
                        </a>
                    </li>
                </ul>
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
