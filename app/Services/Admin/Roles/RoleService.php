<?php

namespace App\Services\Admin\Roles;

use App\Repositories\Admin\Roles\RoleRepository;
use App\Services\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use lib\DataTable;

class RoleService extends BaseService
{
    public function __construct(RoleRepository $roleRepository)
    {
        $this->repository = $roleRepository;
    }

    protected function getRepository(): RoleRepository
    {
        return $this->repository;
    }

    /**
     * Lấy thông tin vai trò theo ID
     * @param $id
     * @return Model|null
     */
    public function findById($id): ?Model
    {
        $options['relations'] = ['permissions'];
        return $this->getRepository()->findById($id, $options);
    }

    /**
     * Xử lý tạo vai trò
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $return = [
            'success' => false,
            'messages' => 'Thêm mới quyền thất bại'
        ];
        $keys = ['title', 'name', 'permissions'];
        if (($insertData = DataTable::getChangeData($data, $keys))
            && $this->getRepository()->create($insertData)
        ) {
            $return['success'] = true;
            $return['messages'] = 'Thêm mới quyền thành công';
        }
        return $return;
    }

    /**
     * Xử lý cập nhật vai trò
     * @param $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data): array
    {
        $return = [
            'success' => false,
            'messages' => 'Cập nhật vai trò thất bại'
        ];
        $keys = ['title', 'name', 'permissions'];
        $updateData = DataTable::getChangeData($data, $keys);
        if (!empty($updateData)
            && ($role = $this->getRepository()->findById($id))
            && $this->getRepository()->update($role, $data)
        ) {
            $return['success'] = true;
            $return['messages'] = 'Cập nhật vai trò thành công';
        }
        return $return;
    }
}
