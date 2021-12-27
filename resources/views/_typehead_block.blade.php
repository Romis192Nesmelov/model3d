@php ob_start(); @endphp
<input name="{{ $name }}" type="text" class="form-control typeahead-basic" placeholder="{{ isset($placeholder) && $placeholder ? $placeholder : '' }}" value="{{ isset($value) && !count($errors) ? $value : (Session::has($name) ? Session::get($name) : old($name)) }}">
@include('_input_cover_block',['content' => ob_get_clean()])

<script>window.typeHeadData = [];</script>
@foreach($data as $item)
    <script>window.typeHeadData.push("{{ $item->name }}");</script>
@endforeach