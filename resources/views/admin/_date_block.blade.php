@php ob_start(); @endphp
<div class="input-group">
    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
    <input type="text" name="{{ $name }}" class="form-control daterange-single {{ $errors && $errors->has($name) ? 'has-error' : '' }}" value="{{ (count($errors) ? old($name) : date('d.m.Y', $value)) }}">
</div>
@include('_input_cover_block',['content' => ob_get_clean()])