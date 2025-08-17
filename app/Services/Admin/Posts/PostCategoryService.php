<?php

namespace App\Services\Admin\Posts;

use App\Repositories\Admin\Posts\PostCategoryRepository;
use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use lib\DataTable;

class PostCategoryService extends BaseService
{
    public function __construct(PostCategoryRepository $postCategoryRepository)
    {
        $this->repository = $postCategoryRepository;
    }

    protected function getRepository(): PostCategoryRepository
    {
        return $this->repository;
    }

    /**
     * Service xử lý tạo danh mục
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $return = [
            'success' => false,
            'message' => 'Thêm mới danh mục thất bại'
        ];

        try {
            $data['is_active'] = isset($data['is_active']);
            $data['is_featured'] = isset($data['is_featured']);
            
            // Xử lý upload hình ảnh
            if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                $data['image'] = $data['image']->store('categories', 'public');
            }
            
            $keys = ['name', 'description', 'image', 'color', 'sort_order', 'is_active', 'is_featured'];
            $insertData = DataTable::getChangeData($data, $keys);
            
            if ($category = $this->getRepository()->create($insertData)) {
                $return['success'] = true;
                $return['message'] = 'Thêm mới danh mục thành công';
                $return['data'] = $category;
            }
        } catch (\Exception $e) {
            $return['message'] = 'Có lỗi xảy ra: ' . $e->getMessage();
        }
        
        return $return;
    }

    /**
     * Hàm cập nhật danh mục
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data): array
    {
        $return = [
            'success' => false,
            'message' => 'Cập nhật danh mục thất bại'
        ];

        try {
            $category = $this->getRepository()->findById($id);
            
            if (!$category) {
                $return['message'] = 'Danh mục không tồn tại';
                return $return;
            }

            $data['is_active'] = isset($data['is_active']);
            $data['is_featured'] = isset($data['is_featured']);
            
            // Xử lý upload hình ảnh
            if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
                // Xóa ảnh cũ
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }
                $data['image'] = $data['image']->store('categories', 'public');
            }
            
            $keys = ['name', 'description', 'image', 'color', 'sort_order', 'is_active', 'is_featured'];
            $updateData = DataTable::getChangeData($data, $keys);
            
            if ($this->getRepository()->update($category, $updateData)) {
                $return['success'] = true;
                $return['message'] = 'Cập nhật danh mục thành công';
                $return['data'] = $category->fresh();
            }
        } catch (\Exception $e) {
            $return['message'] = 'Có lỗi xảy ra: ' . $e->getMessage();
        }
        
        return $return;
    }

    /**
     * Hàm xóa danh mục
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        $return = [
            'success' => false,
            'message' => 'Xóa danh mục thất bại'
        ];

        try {
            $category = $this->getRepository()->findById($id);
            
            if (!$category) {
                $return['message'] = 'Danh mục không tồn tại';
                return $return;
            }

            // Kiểm tra xem danh mục có bài viết nào không
            if ($category->posts()->count() > 0) {
                $return['message'] = 'Không thể xóa danh mục có bài viết!';
                return $return;
            }

            // Xóa ảnh
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            
            if ($this->getRepository()->delete($category)) {
                $return['success'] = true;
                $return['message'] = 'Xóa danh mục thành công';
            }
        } catch (\Exception $e) {
            $return['message'] = 'Có lỗi xảy ra: ' . $e->getMessage();
        }
        
        return $return;
    }

    /**
     * Hàm thay đổi trạng thái danh mục
     * @param int $id
     * @return array
     */
    public function toggleStatus(int $id): array
    {
        $return = [
            'success' => false,
            'message' => 'Thay đổi trạng thái thất bại'
        ];

        try {
            $category = $this->getRepository()->findById($id);
            
            if (!$category) {
                $return['message'] = 'Danh mục không tồn tại';
                return $return;
            }

            $category->update(['is_active' => !$category->is_active]);
            
            $status = $category->is_active ? 'kích hoạt' : 'vô hiệu hóa';
            $message = "Danh mục đã được {$status} thành công!";
            
            $return['success'] = true;
            $return['message'] = $message;
            $return['data'] = ['status' => $category->is_active];
        } catch (\Exception $e) {
            $return['message'] = 'Có lỗi xảy ra: ' . $e->getMessage();
        }
        
        return $return;
    }

    /**
     * Hàm thay đổi trạng thái nổi bật của danh mục
     * @param int $id
     * @return array
     */
    public function toggleFeatured(int $id): array
    {
        $return = [
            'success' => false,
            'message' => 'Thay đổi trạng thái nổi bật thất bại'
        ];

        try {
            $category = $this->getRepository()->findById($id);
            
            if (!$category) {
                $return['message'] = 'Danh mục không tồn tại';
                return $return;
            }

            $category->update(['is_featured' => !$category->is_featured]);
            
            $status = $category->is_featured ? 'nổi bật' : 'không nổi bật';
            $message = "Danh mục đã được {$status} thành công!";
            
            $return['success'] = true;
            $return['message'] = $message;
            $return['data'] = ['is_featured' => $category->is_featured];
        } catch (\Exception $e) {
            $return['message'] = 'Có lỗi xảy ra: ' . $e->getMessage();
        }
        
        return $return;
    }

    /**
     * Hàm lấy ra danh sách danh mục theo từ khóa
     * @param string $term
     * @param string $column
     * @param int $limit
     * @return JsonResponse
     */
    public function autocomplete(string $term = '', string $column = 'name', int $limit = 10): JsonResponse
    {
        return parent::autocomplete($term, $column, $limit);
    }
}


