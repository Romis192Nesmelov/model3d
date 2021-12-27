@php ob_start(); @endphp
<textarea class="form-control {{ isset($simple) && $simple ? 'simple' : '' }}" name="{{ $name }}">{{ count($errors) ? old($name) : (isset($value) ? $value : '') }}</textarea>
@include('_input_cover_block',['content' => ob_get_clean()])
@if (!isset($simple) || !$simple)
    <script>
        var editor = CKEDITOR.replace('{{ $name }}', {
            height: '{{ isset($height) ? $height.'px' : '200px' }}'
        });
    </script>
@endif
