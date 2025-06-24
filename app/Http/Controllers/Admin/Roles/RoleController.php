<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Roles\StoreRequest;
use App\Http\Requests\Admin\Roles\UpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\Admin\Permissions\PermissionService;
use App\Services\Admin\Roles\RoleService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use lib\DataTable;

class RoleController extends BaseController
{
    protected PermissionService $permissionService;

    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->service = $roleService;
        $this->permissionService = $permissionService;
    }

    public function getService(): RoleService
    {
        return $this->service;
    }

    /**
     * Hiển thị danh sách vai trò
     * @param Request $request
     * @return View|Application|Factory
     */
    public function index(Request $request): View|Application|Factory
    {
        $filters = $this->getFilters($request->all());
        $options = $this->getOptions($request->all());
        $options['relations'] = ['permissions'];
        $roles = $this->getService()->getList($filters, $options);
        return view('admin.roles.index', compact('roles', 'filters', 'options'));
    }

    /**
     * Hiển thị form tạo vai trò
     * @return View|Application|Factory
     */
    public function create(): View|Application|Factory
    {
        $permissions = $this->permissionService->getList();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Xử lý tạo vai trò
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $return = $this->getService()->create($request->all());
        if (!empty($return['success'])) {
            return redirect()->route('admin.roles.index')
                ->with('success', $return['message'] ?? 'Tạo vai trò thành công.');
        }
        return redirect()->route('admin.roles.index')
            ->with('fail', $return['message'] ?? 'Tạo vai trò thất bại.');
    }

    /**
     * Hiển thị form sửa vai trò
     * @param $id
     * @return View|Application|Factory
     */
    public function edit($id): View|Application|Factory
    {
        $role = $this->getService()->findById($id);
        $permissions = $this->permissionService->getList();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Xử lý cập nhật vai trò
     * @param UpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $return = $this->getService()->update($id, $request->all());
        if (!empty($return['success'])) {
            return redirect()->route('admin.roles.index')
                ->with('success', $return['message'] ?? 'Cập nhật vai trò thành công.');
        }
        return redirect()->route('admin.roles.index')
            ->with('fail', $return['message'] ?? 'Cập nhật vai trò thất bại.');
    }

    /**
     * Xóa vai trò
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $return = $this->getService()->delete($id);
        if (!empty($return['success'])) {
            return redirect()->route('admin.roles.index')
                ->with('success', $return['message'] ?? 'Xóa vai trò thành công.');
        }
        return redirect()->route('admin.roles.index')
            ->with('fail', $return['message'] ?? 'Xóa vai trò thất bại.');
    }
}
