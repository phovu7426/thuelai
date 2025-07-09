<?php

namespace App\Services\Admin\Users;

use App\Repositories\Admin\Users\UserRepository;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use lib\DataTable;

class UserService extends BaseService
{
    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    protected function getRepository(): UserRepository
    {
        return $this->repository;
    }

    /**
     * Service xử lý tạo tài khoản
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $return = [
            'success' => false,
            'messages' => 'Thêm mới tài khoản thất bại'
        ];
        if (empty($data['name'])) {
            $data['name'] = $data['email'];
        }
        $keys = ['name', 'email', 'password'];
        if (($insertData = DataTable::getChangeData($data, $keys))
            && $this->getRepository()->create($insertData)
        ) {
            $return['success'] = true;
            $return['messages'] = 'Thêm mới tài khoản thành công';
        }
        return $return;
    }

    /**
     * Hàm cập nhật tài khoản
     * @param $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data): array
    {
        $return = [
            'success' => false,
            'messages' => 'Cập nhật tài khoản thất bại'
        ];
        if (empty($data['name'])) {
            $data['name'] = $data['email'];
        }
        $keys = ['name', 'email'];
        $updateData = DataTable::getChangeData($data, $keys);
        if (!empty($updateData)
            && ($user = $this->getRepository()->findById($id))
            && $this->getRepository()->update($user, $data)
        ) {
            $return['success'] = true;
            $return['messages'] = 'Cập nhật tài khoản thành công';
        }
        return $return;
    }

    /**
     * Hàm đồng bộ lại vai trò của người dùng
     * @param $id
     * @param array $roles
     * @return void
     */
    public function assignRoles($id, array $roles): void
    {
        $user = $this->getRepository()->findById($id);
        // Chặn phân quyền cho tài khoản admin
        if ($user->email === 'dinhminhlh@gmail.com') {
            throw new \Exception('Không thể phân quyền cho tài khoản admin!');
        }
        $user->syncRoles($roles);
    }

    /**
     * Hàm thay đổi trạng thái tài khoản
     * @param $id
     * @param int $status
     * @return array
     */
    public function changeStatus($id, int $status = 0): array
    {
        $return = [
            'success' => false,
            'messages' => 'Thay đổi trạng thái tài khoản thất bại'
        ];
        $status = !empty($status) ? 1 : 0;
        if ($user = $this->getRepository()->findById($id)) {
            if ((!empty($user->status) && !empty($status))
                || (empty($user->status) && empty($status))
            ) {
                $return['messages'] = 'Trạng thái cần không thay đổi không đúng';
            } elseif ($this->getRepository()->update($user, ['status' => $status])) {
                $return['success'] = true;
                $return['messages'] = 'Thay đổi trạng thái tài khoản thành công';
            }
        } else {
            $return['messages'] = 'Tài khoản không hợp lệ';
        }
        return $return;
    }

    /**
     * Hàm lấy ra danh sách người dùng theo từ
     * @param string $term
     * @param string $column
     * @param int $limit
     * @return JsonResponse
     */
    public function autocomplete(string $term = '', string $column = 'title', int $limit = 10): JsonResponse
    {
        return parent::autocomplete($term, 'email', $limit);
    }

    /**
     * Hàm xóa tài khoản
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        $return = [
            'success' => false,
            'message' => 'Xóa tài khoản thất bại'
        ];
        $user = $this->getRepository()->findById($id);
        // Chặn xóa tài khoản admin
        if ($user && ($user->email === 'admin@gmail.com' || $user->hasRole('admin'))) {
            $return['message'] = 'Không thể xóa tài khoản admin!';
            return $return;
        }
        if ($user && $this->getRepository()->delete($user)) {
            $return['success'] = true;
            $return['message'] = 'Xóa tài khoản thành công';
        }
        return $return;
    }
}
