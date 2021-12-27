@php ob_start(); @endphp

<form method="post" action="{{ url('/register') }}">
    {!! csrf_field() !!}
    <div class="modal-body">
        @include('auth._register_fields_block', ['email' => null])
        @include('_button_block', ['type' => 'submit', 'text' => trans('auth.register'), 'mainClass' => 'btn-primary wide'])
    </div>
</form>
@include('layouts._modal_block',[
    'id' => 'register',
    'title' => trans('auth.register'),
    'content' => ob_get_clean()
])