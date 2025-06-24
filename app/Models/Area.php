<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'areas';

    // Các trường có thể gán dữ liệu hàng loạt
    protected $fillable = [
        'name',
        'code',
        'location',
        'type',
        'description',
        'capacity',
        'status',
    ];

    // Các trường ẩn khi trả về dữ liệu JSON
    protected $hidden = [
        'deleted_at',
    ];

    // Kiểu dữ liệu cho các trường
//    protected $casts = [
//        'status' => 'boolean',
//    ];

    // Mối quan hệ ví dụ: Một khu vực có nhiều chỗ ngồi
//    public function seats()
//    {
//        return $this->hasMany(Seat::class);
//    }

    public function shelves(): HasMany
    {
        return $this->hasMany(Shelf::class, 'area_id');
    }

    // Phạm vi để lọc các khu vực đang hoạt động
//    public function scopeActive($query)
//    {
//        return $query->where('status', true);
//    }
}
