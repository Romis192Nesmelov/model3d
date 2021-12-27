@php ob_start(); @endphp

<form method="post" action="{{ url('/send-sms') }}">
    {!! csrf_field() !!}
    <div class="modal-body">
        <p>{{ trans('auth.auth_via') }} <a data-dismiss="modal" data-toggle="modal" data-target="#login-email">{{ trans('auth.email_or_socnet') }}</a></p>
        @include('_input_block', [
            'icon' => 'icon-iphone',
            'label' => trans('content.your_phone'),
            'name' => 'phone',
            'type' => 'text',
            'placeholder' => '+7(___)___-__-__',
            'value' => '',
            'usingAjax' => true
        ])
        @include('_button_block', [
            'type' => 'submit',
            'disabled' => true,
            'text' => trans('auth.send_code'),
            'mainClass' => 'btn-primary wide'
        ])
    </div>
</form>
@include('layouts._modal_block',[
    'id' => 'login-phone',
    'title' => trans('auth.enter_your_phone'),
    'content' => ob_get_clean()
])