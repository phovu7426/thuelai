@props(['name', 'required' => false])

<div>
    <input type="file" class="upload-field" data-target="{{ $name }}_input" {{ $required ? 'required' : '' }} data-url="{{ route('upload') }}">
    <input type="hidden" id="{{ $name }}_input" name="{{ $name }}" readonly {{ $required ? 'required' : '' }}>
</div>
