<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProcessOrderStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Chỉ xử lý các request đến route cập nhật đơn hàng
        if ($request->is('admin/stone/orders/*') && $request->isMethod('put')) {
            // Kiểm tra xem có tham số status không
            if ($request->has('status')) {
                $status = $request->input('status');
                
                // Xử lý giá trị status để đảm bảo nó là một chuỗi hợp lệ
                switch ($status) {
                    case 'pending':
                        $request->merge(['status' => 'pending']);
                        break;
                    case 'processing':
                        $request->merge(['status' => 'processing']);
                        break;
                    case 'completed':
                        $request->merge(['status' => 'completed']);
                        break;
                    case 'cancelled':
                        $request->merge(['status' => 'cancelled']);
                        break;
                    default:
                        $request->merge(['status' => 'pending']);
                }
            }
        }

        return $next($request);
    }
} 