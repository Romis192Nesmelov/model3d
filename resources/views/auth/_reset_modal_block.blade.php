@php ob_start(); @endphp

<form method="post" action="{{ url('/password/reset') }}">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="modal-body">
        <p>{!! trans('auth.new_password_head') !!}</p>
        @include('auth._register_fields_block', ['email' => Request::has('email') ? Request::input('email') : ''])
        @include('_button_block', ['type' => 'submit', 'text' => trans('auth.save_new_password')])
    </div>
</form>

@include('layouts._modal_block',[
    'id' => 'new-password',
    'title' => trans('auth.reset_password'),
    'content' => ob_get_clean()
])