<!--begin::Sidebar Wrapper-->
<div class="sidebar-wrapper">
    <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

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
                            <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ isActive('admin.permissions.*') }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Quản lý quyền</p>
                            </a>
                        </li>
                    @endcanany
                </ul>
            </li>


            {{-- Quản lý khai báo --}}
            @php
                $activeGroupDeclaration = isActive(['admin.*'], 'menu-open');
                $activeLinkDeclaration = isActive(['admin.*']);
            @endphp

            <li class="nav-item {{ $activeGroupDeclaration }}">
                <a href="#" class="nav-link {{ $activeLinkDeclaration }}">
                    <i class="nav-icon bi bi-box-seam-fill"></i>
                    <p>
                        Quản lý khai báo
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @canany(['view_declarations', 'create_declarations', 'edit_declarations', 'delete_declarations'])
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ isActive('admin.categories.*') }}">
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

        </ul>
        <!--end::Sidebar Menu-->
    </nav>
</div>
<!--end::Sidebar Wrapper-->
