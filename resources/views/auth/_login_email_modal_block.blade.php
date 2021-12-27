@php ob_start(); @endphp

<form method="post" action="{{ url('/login') }}">
    {!! csrf_field() !!}
    <div class="modal-body">
        <p>{{ trans('auth.or_pass') }} <a data-dismiss="modal" data-toggle="modal" data-target="#register"> {{ trans('auth.registration') }}</a></p>
        @include('auth._login_fields_block')
        @include('auth._oauth2_block')
        @include('_button_block', ['type' => 'submit', 'text' => trans('content.enter'), 'mainClass' => 'btn-primary wide'])
    </div>
</form>
@include('layouts._modal_block',[
    'id' => 'login-email',
    'title' => trans('auth.login_to_your_account'),
    'content' => ob_get_clean()
])