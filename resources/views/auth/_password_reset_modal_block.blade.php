@php ob_start(); @endphp

{{--<form method="post" action="{{ url('/password/email') }}">--}}
<form method="post" action="{{ route('password.email') }}">
    {!! csrf_field() !!}
    <div class="modal-body">
        <p>{!! trans('auth.reset_password_head') !!}</p>
        @include('_input_block',['name' => 'email', 'type' => 'email', 'placeholder' => 'E-mail', 'icon' => 'icon-user', 'usingAjax' => true])
        @include('auth._re_captcha_block',['usingAjax' => true])
        @include('_button_block', ['type' => 'submit', 'text' => trans('auth.send_password_reset_link')])
    </div>
</form>

@include('layouts._modal_block',[
    'id' => 'password-reset',
    'title' => trans('auth.reset_password'),
    'content' => ob_get_clean()
])