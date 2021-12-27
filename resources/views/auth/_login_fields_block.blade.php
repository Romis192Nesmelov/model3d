@include('_input_block',['name' => 'email', 'type' => 'email', 'placeholder' => 'E-mail', 'icon' => 'icon-user', 'usingAjax' => true])
@include('_input_block',['name' => 'password', 'type' => 'password', 'placeholder' => trans('auth.password'), 'icon' => 'icon-lock2', 'usingAjax' => true])
{{--@include('_checkbox_block',['addClass' => 'i_agree', 'name' => 'i_agree', 'label' => trans('content.i_agree')])--}}
@include('auth._re_captcha_block',['usingAjax' => true])
<div class="form-group">
    <div class="row">
        <table class="auth">
            <tr>
                <td valign="middle" align="left">@include('_checkbox_block', ['name' => 'remember', 'checked' => true, 'label' => trans('auth.remember_me')])</td>
                <td valign="middle" align="right">
                    <a data-dismiss="modal" data-toggle="modal" data-target="#password-reset"> {{ trans('auth.forgot_your_password') }}</a>
                </td>
            </tr>
            <tr>
                <td colspan="2" valign="middle" align="center">
                    <a data-dismiss="modal" data-toggle="modal" data-target="#send-confirm"> {{ trans('auth.re_confirmation') }}</a>
                </td>
            </tr>
        </table>
    </div>
</div>