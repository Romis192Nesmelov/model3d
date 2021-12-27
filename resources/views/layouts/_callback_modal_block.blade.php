@php ob_start(); @endphp

<form class="form-horizontal" action="{{ url('/callback1') }}" method="post">
    {{ csrf_field() }}
    <div class="modal-body">
        @include('_input_block', [
            'icon' => 'icon-user',
            'label' => trans('content.your_name'),
            'name' => 'user_name',
            'type' => 'text',
            'placeholder' => trans('content.your_name'),
            'value' => '',
            'usingAjax' => true
        ])

        @include('_input_block', [
            'icon' => 'icon-iphone',
            'label' => trans('content.your_phone'),
            'name' => 'phone',
            'type' => 'text',
            'placeholder' => '+7(___)___-__-__',
            'value' => '',
            'usingAjax' => true
        ])

        @include('_textarea_block',[
            'icon' => 'icon-question4',
            'label' => trans('content.your_question'),
            'name' => 'question',
            'value' => '',
            'simple' => true,
            'usingAjax' => true
        ])

        @include('_checkbox_block',[
            'addClass' => 'i_agree',
            'name' => 'i_agree',
            'label' => trans('content.i_agree')
        ])

        @include('auth._re_captcha_block', [
            'id' => 'captcha2',
            'usingAjax' => true
        ])
    </div>
    <!-- Футер модального окна -->
    <div class="modal-footer">
        @include('_button_block', [
            'type' => 'submit',
            'text' => trans('content.callback_me'),
            'icon' => 'icon-phone-wave',
            'addAttr' => ['id' => 'call_me'],
            'disabled' => true
        ])
        @include('_button_block', [
            'type' => 'button',
            'text' => trans('content.cancel'),
            'icon' => 'icon-cancel-circle2',
            'addAttr' => ['data-dismiss' => 'modal'],
            'disabled' => false
        ])
    </div>
</form>

@include('layouts._modal_block',[
    'id' => 'callback-modal',
    'title' => trans('content.callback_me'),
    'content' => ob_get_clean()
])