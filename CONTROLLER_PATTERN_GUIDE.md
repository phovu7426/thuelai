# Hướng dẫn Pattern Controller-Service-Repository với BaseController

## Tổng quan

Pattern này sử dụng kiến trúc 3 lớp:
- **Controller**: Xử lý HTTP requests và responses
- **Service**: Chứa business logic
- **Repository**: Tương tác với database

## Cấu trúc thư mục

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── BaseController.php
│   │   └── Admin/
│   │       └── Users/
│   │           └── UserController.php
│   └── Requests/
│       └── Admin/
│           └── Users/
│               └── Users/
│                   ├── StoreRequest.php
│                   ├── UpdateRequest.php
│                   └── AssignRequest.php
├── Services/
│   ├── BaseService.php
│   └── Admin/
│       └── Users/
│           └── UserService.php
├── Repositories/
│   ├── BaseRepository.php
│   └── Admin/
│       └── Users/
│           └── UserRepository.php
└── Models/
    └── User.php
```

## 1. BaseController

BaseController cung cấp các method chung cho tất cả controllers:

```php
<?php

namespace App\Http\Controllers;

use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use lib\DataTable;

class BaseController extends Controller
{
    protected BaseService $service;

    /**
     * Hàm lấy ra điều kiện lọc
     */
    protected function getFilters(array $filters, array $allowKeys = []): array
    {
        $validColumns = $this->service->getColumns();
        $filters = DataTable::getFiltersData($filters, $allowKeys);
        return collect($filters)->only($validColumns)->toArray();
    }

    /**
     * Hàm lấy ra các options lấy dữ liệu
     */
    protected function getOptions(array $options): array
    {
        return DataTable::getOptionsData($options);
    }

    /**
     * Hàm dùng chung cho autocomplete
     */
    public function autocomplete(Request $request): JsonResponse
    {
        $term = $request->input('term');
        return $this->service->autocomplete($term ?? '');
    }
}
```

## 2. Controller Implementation

Controller kế thừa từ BaseController và inject service:

```php
<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\BaseController;
use App\Services\Admin\Users\UserService;

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

    public function index(Request $request): View|Application|Factory
    {
        $filters = $this->getFilters($request->all());
        $options = $this->getOptions($request->all());
        $users = $this->getService()->getList($filters, $options);
        
        return view('admin.users.index', compact('users', 'filters', 'options'));
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $result = $this->getService()->create($request->validated());
        
        return response()->json([
            'success' => $result['success'] ?? false,
            'message' => $result['message'] ?? 'Tạo tài khoản thất bại.',
            'data' => $result['data'] ?? null
        ]);
    }
}
```

## 3. Service Layer

Service chứa business logic và kế thừa từ BaseService:

```php
<?php

namespace App\Services\Admin\Users;

use App\Repositories\Admin\Users\UserRepository;
use App\Services\BaseService;
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

    public function create(array $data): array
    {
        $return = [
            'success' => false,
            'message' => 'Thêm mới tài khoản thất bại'
        ];
        
        $keys = ['name', 'email', 'password'];
        if (($insertData = DataTable::getChangeData($data, $keys))
            && $this->getRepository()->create($insertData)
        ) {
            $return['success'] = true;
            $return['message'] = 'Thêm mới tài khoản thành công';
        }
        
        return $return;
    }

    public function update(int $id, array $data): array
    {
        $return = [
            'success' => false,
            'message' => 'Cập nhật tài khoản thất bại'
        ];
        
        $keys = ['name', 'email'];
        $updateData = DataTable::getChangeData($data, $keys);
        
        if (!empty($updateData)
            && ($user = $this->getRepository()->findById($id))
            && $this->getRepository()->update($user, $updateData)
        ) {
            $return['success'] = true;
            $return['message'] = 'Cập nhật tài khoản thành công';
        }
        
        return $return;
    }
}
```

## 4. Repository Layer

Repository kế thừa từ BaseRepository và xử lý database operations:

```php
<?php

namespace App\Repositories\Admin\Users;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
```

## 5. Request Validation

Tạo FormRequest classes để validate dữ liệu:

```php
<?php

namespace App\Http\Requests\Admin\Users\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ];
    }
}
```

## 6. Model

Model định nghĩa cấu trúc dữ liệu và relationships:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'user_id'
    ];

    protected $hidden = [
        'password',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
```

## Lợi ích của Pattern này

1. **Separation of Concerns**: Mỗi layer có trách nhiệm riêng biệt
2. **Reusability**: Code có thể tái sử dụng dễ dàng
3. **Testability**: Dễ dàng viết unit tests cho từng layer
4. **Maintainability**: Code dễ bảo trì và mở rộng
5. **Consistency**: Cấu trúc nhất quán trong toàn bộ ứng dụng

## Cách tạo Controller mới

1. Tạo Model (nếu chưa có)
2. Tạo Repository kế thừa BaseRepository
3. Tạo Service kế thừa BaseService
4. Tạo Request classes cho validation
5. Tạo Controller kế thừa BaseController
6. Đăng ký routes và dependencies trong ServiceProvider

## Ví dụ tạo ProductController

Xem file `app/Http/Controllers/Admin/Products/ProductController.php` để tham khảo cách implement đầy đủ.
