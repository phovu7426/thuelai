<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'total_amount',
        'note',
        'status',
        'is_admin_created',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for the order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the formatted status.
     */
    public function getStatusLabelAttribute()
    {
        $statusClasses = [
            'pending' => 'warning',
            'processing' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
        ];

        $statusNames = [
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy',
        ];

        $class = $statusClasses[$this->status] ?? 'secondary';
        $name = $statusNames[$this->status] ?? 'Không xác định';

        return '<span class="badge badge-' . $class . '">' . $name . '</span>';
    }

    /**
     * Get the formatted date.
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }

    /**
     * Generate a unique order number.
     */
    public static function generateOrderNumber(): string
    {
        $prefix = 'ORD-';
        $date = now()->format('Ymd');
        $random = mt_rand(1000, 9999);
        
        return $prefix . $date . '-' . $random;
    }

    /**
     * Get all available statuses
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING => 'Chờ xử lý',
            self::STATUS_PROCESSING => 'Đang xử lý',
            self::STATUS_COMPLETED => 'Hoàn thành',
            self::STATUS_CANCELLED => 'Đã hủy',
        ];
    }

    /**
     * Check if status transition is valid
     */
    public function canTransitionTo(string $newStatus): bool
    {
        // Nếu đơn hàng đã hoàn thành hoặc đã hủy thì không được chuyển trạng thái
        if (in_array($this->status, [self::STATUS_COMPLETED, self::STATUS_CANCELLED])) {
            return false;
        }

        // Nếu đơn hàng đang chờ xử lý
        if ($this->status === self::STATUS_PENDING) {
            // Chỉ được chuyển sang đang xử lý hoặc đã hủy
            return in_array($newStatus, [self::STATUS_PROCESSING, self::STATUS_CANCELLED]);
        }

        // Nếu đơn hàng đang xử lý
        if ($this->status === self::STATUS_PROCESSING) {
            // Chỉ được chuyển sang hoàn thành hoặc đã hủy
            return in_array($newStatus, [self::STATUS_COMPLETED, self::STATUS_CANCELLED]);
        }

        return false;
    }
} 