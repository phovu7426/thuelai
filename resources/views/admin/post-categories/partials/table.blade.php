@foreach($categories as $index => $category)
    <tr data-id="{{ $category->id }}">
        <td>{{ $categories->firstItem() + $index }}</td>
        <td>
            <strong>{{ $category->name ?? '' }}</strong>
            <br><small class="text-muted">Slug: {{ $category->slug ?? '' }}</small>
        </td>
        <td>{{ Str::limit($category->description ?? '', 80) }}</td>
        <td>
            <select class="form-select form-select-sm status-select" 
                    data-category-id="{{ $category->id }}" 
                    data-current-status="{{ $category->is_active ? '1' : '0' }}"
                    data-status-type="post-categories">
                <option value="0" {{ !$category->is_active ? 'selected' : '' }}>
                    Vô hiệu
                </option>
                <option value="1" {{ $category->is_active ? 'selected' : '' }}>
                    Kích hoạt
                </option>
            </select>
        </td>
        <td>
            <select class="form-select form-select-sm featured-select" 
                    data-category-id="{{ $category->id }}" 
                    data-current-featured="{{ $category->is_featured ? '1' : '0' }}"
                    data-featured-type="post-categories">
                <option value="0" {{ !$category->is_featured ? 'selected' : '' }}>
                    Không nổi bật
                </option>
                <option value="1" {{ $category->is_featured ? 'selected' : '' }}>
                    Nổi bật
                </option>
            </select>
        </td>
        <td>
            <div class="action-buttons">
                @can('access_users')
                    <button type="button" class="btn-action btn-edit" title="Chỉnh sửa"
                            onclick="openEditPostCategoryModal({{ $category->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn-action btn-delete" title="Xóa" onclick="deletePostCategory({{ $category->id }})">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                @endcan
            </div>
        </td>
    </tr>
@endforeach
