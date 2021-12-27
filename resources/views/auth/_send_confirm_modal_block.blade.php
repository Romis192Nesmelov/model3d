@php ob_start(); @endphp

<form method="post" action="{{ url('/confirm-user') }}">
    {!! csrf_field() !!}
    <div class="modal-body">
        <p class="auth-register">{!! trans('auth.confirm_mail_head') !!}</p>
        @include('_input_block',['name' => 'email', 'type' => 'email', 'placeholder' => 'E-mail', 'icon' => 'icon-user', 'usingAjax' => true])
        @include('auth._re_captcha_block', ['usingAjax' => true])
        @include('_button_block', ['type' => 'submit', 'text' => trans('auth.send_confirm_mail')])
    </div>
</form>
@include('layouts._modal_block',[
    'id' => 'send-confirm',
    'title' => trans('auth.confirm_mail'),
    'content' => ob_get_clean()
])