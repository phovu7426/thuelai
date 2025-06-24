<?php

namespace App\Http\Controllers\Admin\Permissions;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Permissions\StoreRequest;
use App\Http\Requests\Admin\Permissions\UpdateRequest;
use App\Models\Permission;
use App\Services\Admin\Permissions\PermissionService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use lib\DataTable;

class PermissionController extends BaseController
{
    public function __construct(PermissionService $permissionService)
    {
        $this->service = $permissionService;
    }

    public function getService(): PermissionService
    {
        return $this->service;
    }

    /**
     * Hiển thị danh sách quyền
     * @param Request $request
     * @return Factory|Application|View
     */
    public function index(Request $request): View|Application|Factory
    {
        $filters = $this->getFilters($request->all());
        $options = $this->getOptions($request->all());
        $permissions = $this->getService()->getList($filters, $options);
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Hiển thị form tạo quyền
     * @return View|Application|Factory
     */
    public function create(): View|Application|Factory
    {
        $permissions = $this->getService()->getAll();
        return view('admin.permissions.create', compact('permissions'));
    }

    /**
     * Xử lý tạo quyền
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $return = $this->getService()->create($request->all());
        if (!empty($return['success'])) {
            return redirect()->route('admin.permissions.index')
                ->with('success', $return['message'] ?? 'Tạo quyền thành công.');
        }
        return redirect()->route('admin.permissions.index')
            ->with('fail', $return['message'] ?? 'Tạo quyền thất bại.');
    }

    /**
     * Hiển thị form sửa quyền
     * @param $id
     * @return View|Application|Factory
     */
    public function edit($id): View|Application|Factory
    {
        $permission = $this->getService()->findById($id);
        $permissions = $this->getService()->getAll();
        return view('admin.permissions.edit', compact('permission', 'permissions'));
    }

    /**
     * Xử lý cập nhật quyền
     * @param UpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $return = $this->getService()->update($id, $request->all());
        if (!empty($return['success'])) {
            return redirect()->route('admin.permissions.index')
                ->with('success', $return['message'] ?? 'Cập nhật quyền thành công.');
        }
        return redirect()->route('admin.permissions.index')
            ->with('fail', $return['message'] ?? 'Cập nhật quyền thất bại.');
    }

    /**
     * Xóa quyền
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $return = $this->getService()->delete($id);
        if (!empty($return['success'])) {
            return redirect()->route('admin.permissions.index')
                ->with('success', $return['message'] ?? 'Xóa quyền thành công.');
        }
        return redirect()->route('admin.permissions.index')
            ->with('fail', $return['message'] ?? 'Xóa quyền thất bại.');
    }
}
