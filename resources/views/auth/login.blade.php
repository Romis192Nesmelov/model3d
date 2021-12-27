@extends('layouts.auth')

@section('content')

<!-- Advanced login -->
<form method="POST" action="{{ url('/login') }}">
    {!! csrf_field() !!}
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div id="dog"><img width="100%" src="{{ asset('images/dog.jpg') }}" /></div>
            <h5 class="content-group-lg">{{ trans('auth.login_to_your_account') }} <small class="display-block">{!! trans('auth.login_head') !!}</small></h5>
        </div>
        @include('_input_block',[
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'E-mail',
            'icon' => 'icon-user',
            'usingAjax' => false
        ])
        @include('_input_block',[
            'name' => 'password',
            'type' => 'password',
            'placeholder' => trans('auth.password'),
            'icon' => 'icon-lock2',
            'usingAjax' => false
        ])
        @include('auth._re_captcha_block',['usingAjax' => false])

        <div class="form-group login-options">
            <div class="row">
                @include('_checkbox_block', [
                    'name' => 'remember',
                    'checked' => true,
                    'label' => trans('auth.remember_me')
                ])
            </div>
        </div>

        <div class="form-group">
            @include('admin._button_block', [
                'type' => 'submit',
                'mainClass' => 'bg-warning-400 btn-block',
                'text' => trans('content.enter'),
                'icon' => 'icon-circle-right2 position-right'
            ])
        </div>
    </div>
</form>
@endsection