<?php

namespace App\Services\Admin\Posts;

use App\Repositories\Admin\Posts\PostRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\Storage;
use lib\DataTable;

class PostService extends BaseService
{
    public function __construct(PostRepository $postRepository) {
        $this->repository = $postRepository;
    }

    protected function getRepository(): PostRepository
    {
        return $this->repository;
    }

    /**
     * Tạo mới bài đăng
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $return = [
            'success' => false,
            'message' => 'Thêm mới bài đăng thất bại'
        ];

        $keys = ['name', 'content', 'description', 'require_login', 'status'];
        $insertData = DataTable::getChangeData($data, $keys);

        // Xử lý boolean require_login
        $insertData['require_login'] = isset($data['require_login']) ? true : false;

        // Xử lý upload ảnh
        if (isset($data['image']) && $data['image']) {
            $path = $data['image']->store('uploads/posts', 'public');
            $insertData['image'] = 'storage/' . $path;
        }

        if ($this->getRepository()->create($insertData)) {
            $return['success'] = true;
            $return['message'] = 'Thêm mới bài đăng thành công';
        }

        return $return;
    }

    /**
     * Cập nhật bài đăng
     * @param $id
     * @param array $data
     * @return array
     */
    public function update($id, array $data): array
    {
        $return = [
            'success' => false,
            'message' => 'Cập nhật bài đăng thất bại'
        ];

        $keys = ['name', 'content', 'description', 'status'];
        $updateData = DataTable::getChangeData($data, $keys);
        $post = $this->getRepository()->findById($id);

        if (!$post) {
            return $return;
        }

        // Xử lý boolean require_login
        $updateData['require_login'] = isset($data['require_login']) ? true : false;

        // Xử lý upload ảnh
        if (isset($data['image']) && $data['image']) {
            // Xóa ảnh cũ nếu có
            if ($post->image && file_exists(public_path($post->image))) {
                $oldPath = str_replace('storage/', '', $post->image);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $data['image']->store('uploads/posts', 'public');
            $updateData['image'] = 'storage/' . $path;
        }

        if ($this->getRepository()->update($post, $updateData)) {
            $return['success'] = true;
            $return['message'] = 'Cập nhật bài đăng thành công';
        }

        return $return;
    }

    /**
     * Xóa bài đăng
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        $return = [
            'success' => false,
            'message' => 'Xóa bài đăng thất bại'
        ];

        $post = $this->getRepository()->findById($id);
        if (!$post) {
            return $return;
        }

        // Xóa ảnh khi xóa bài đăng
        if ($post->image && file_exists(public_path($post->image))) {
            $oldPath = str_replace('storage/', '', $post->image);
            Storage::disk('public')->delete($oldPath);
        }

        if ($this->getRepository()->delete($post)) {
            $return['success'] = true;
            $return['message'] = 'Xóa bài đăng thành công';
        }

        return $return;
    }
}
