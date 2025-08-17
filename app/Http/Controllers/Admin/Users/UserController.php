<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\Users\Users\AssignRequest;
use App\Http\Requests\Admin\Users\Users\StoreRequest;
use App\Http\Requests\Admin\Users\Users\UpdateRequest;
use App\Services\Admin\Users\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserController extends BaseController
{
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    public function getService(): UserService
    {
        return $this->service;
    }

    /**
     * Hiển thị danh sách tài khoản
     * @param Request $request
     * @return View|Application|Factory
     */
    public function index(Request $request): View|Application|Factory
    {
        $filters = $this->getFilters($request->all());
        $options = $this->getOptions($request->all());
        $users = $this->getService()->getList($filters, $options);
        return view('admin.users.index', compact('users', 'filters', 'options'));
    }

    /**
     * Hiển thị form tạo tài khoản
     * @return View|Application|Factory
     */
    public function create(): View|Application|Factory
    {
        return view('admin.users.create');
    }

    /**
     * Xử lý tạo tài khoản
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $return = $this->getService()->create($request->all());
        if (!empty($return['success'])) {
            return redirect()->route('admin.users.index')
                ->with('success', $return['message'] ?? 'Tạo tài khoản thành công.');
        }
        return redirect()->route('admin.users.index')
            ->with('fail', $return['message'] ?? 'Tạo tài khoản thất bại.');
    }

    /**
     * Hiển thị form chỉnh sửa tài khoản
     * @param $id
     * @return View|Application|Factory
     */
    public function edit($id): View|Application|Factory
    {
        $user = $this->getService()->findById($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Xử lý chỉnh sửa tài khoản
     * @param UpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $return = $this->getService()->update($id, $request->all());
        if (!empty($return['success'])) {
            return redirect()->route('admin.users.index')
                ->with('success', $return['message'] ?? 'Cập nhật tài khoản thành công.');
        }
        return redirect()->route('admin.users.index')
            ->with('fail', $return['message'] ?? 'Cập nhật tài khoản thất bại.');
    }

    /**
     * Xử lý xóa tài khoản
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $return = $this->getService()->delete($id);
        if (!empty($return['success'])) {
            return redirect()->route('admin.users.index')
                ->with('success', $return['message'] ?? 'Xóa tài khoản thành công.');
        }
        // Nếu là lỗi không thể xóa tài khoản admin thì trả về thông báo riêng
        if (!empty($return['message']) && $return['message'] === 'Không thể xóa tài khoản admin!') {
            return redirect()->route('admin.users.index')
                ->with('fail', 'Không thể xóa tài khoản admin!');
        }
        return redirect()->route('admin.users.index')
            ->with('fail', $return['message'] ?? 'Xóa tài khoản thất bại.');
    }

    /**
     * Hiển thị form phân vai trò
     * @param $id
     * @return View|Application|Factory
     */
    public function showAssignRolesForm($id): View|Application|Factory
    {
        $user = $this->getService()->findById($id);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->unique()->toArray(); // Loại bỏ duplicate
        return view('admin.users.assign-roles', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Xử lý phân vai trò
     * @param AssignRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function assignRoles(AssignRequest $request, $id): RedirectResponse
    {
        $this->getService()->assignRoles($id, $request->roles ?? []);
        return redirect()->route('admin.users.index')->with('success', 'Cập nhật vai trò thành công.');
    }

    /**
     * Khóa hoặc mở khóa tài khoản
     */
    public function changeStatus($id, Request $request): RedirectResponse
    {
        $request->validate([
            'status' => 'required',
        ]);
        $return = $this->getService()->changeStatus($id, (int)($request->status ?? 0));
        if (!empty($return['success'])) {
            return redirect()->route('admin.users.index')
                ->with('success', $return['message'] ?? 'Thay đổi trạng thái tài khoản thành công.');
        }
        return redirect()->route('admin.users.index')
            ->with('fail', $return['message'] ?? 'Thay đổi trạng thái tài khoản thất bại.');
    }

    /**
     * Get user information for AJAX request
     */
    public function getUserInfo($id)
    {
        $user = User::with('profile')->findOrFail($id);
        return response()->json($user);
    }

    /**
     * Toggle block status for AJAX request
     */
    public function toggleBlock($id, Request $request)
    {
        try {
            $user = User::findOrFail($id);
            $newStatus = $request->input('status', 0);
            
            $user->is_blocked = $newStatus;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Đã cập nhật trạng thái thành công',
                'new_status' => $newStatus
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}
