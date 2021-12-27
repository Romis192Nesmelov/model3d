@php ob_start(); @endphp
<input type="text" name="{{ $name }}" class="form-control colorpicker-flat-palette" value="{!! isset($value) && $value ? $value : '#rgb(255,255,255)' !!}">
@include('_input_cover_block',['content' => ob_get_clean()])