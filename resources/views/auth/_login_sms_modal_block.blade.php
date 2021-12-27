@php ob_start(); @endphp

<div class="modal-body">
    <form method="post" action="{{ url('/login-sms') }}">
        {!! csrf_field() !!}

        @include('_input_block', [
            'icon' => 'icon-iphone',
            'name' => 'code',
            'type' => 'text',
            'placeholder' => '__-__-__',
            'value' => '',
            'usingAjax' => true
        ])
        @include('_button_block', [
            'addAttr' => ['id' => 'sms-login'],
            'disabled' => true,
            'type' => 'submit',
            'text' => trans('auth.login'),
            'mainClass' => 'btn-primary wide'
        ])
    </form>

    <form method="post" action="{{ url('/send-sms') }}">
        {!! csrf_field() !!}
        <p style="margin-top: 15px; margin-bottom: 0;">{{ trans('auth.resend_code_after') }}</p>
        <div id="timer">0</div>
        <div style="margin-bottom: 10px;">{{ trans('content.seconds') }}</div>
        @include('_button_block', [
            'addAttr' => ['id' => 'resend-sms'],
            'disabled' => true,
            'type' => 'submit',
            'text' => trans('auth.send_code')
        ])
    </form>
</div>

@include('layouts._modal_block',[
    'id' => 'login-sms',
    'title' => trans('auth.enter_sms_code'),
    'content' => ob_get_clean()
])