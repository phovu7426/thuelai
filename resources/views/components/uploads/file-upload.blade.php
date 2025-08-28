@props(['name', 'label' => null, 'required' => false, 'value' => null, 'preview' => true])

<div class="image-uploader">
    @if($label)
        <label class="form-label">{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
    @endif

    <div class="d-flex align-items-center gap-3">
        <input type="file"
               class="upload-field form-control"
               accept="image/*"
               data-target="{{ $name }}_input"
               data-preview="{{ $name }}_preview"
               data-url="{{ route('upload') }}"
               {{ $required ? 'required' : '' }}>

        <div class="image-preview" style="min-width: 100px;">
            @php
                $src = '';
                if (!empty($value)) {
                    $src = (str_starts_with($value, 'http') || str_starts_with($value, '/')) ? $value : asset($value);
                }
            @endphp
            <img id="{{ $name }}_preview" src="{{ $src }}"
                 alt="preview"
                 style="max-height: 80px; {{ !empty($src) ? '' : 'display:none;' }}">
        </div>
    </div>

    <input type="hidden" id="{{ $name }}_input" name="{{ $name }}" value="{{ $value ?? '' }}" readonly {{ $required ? 'required' : '' }}>

    <small class="text-muted d-block mt-1">Chọn ảnh, hệ thống sẽ tải lên và tự điền URL vào input ẩn.</small>
</div>
