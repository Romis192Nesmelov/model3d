<div class="form-group has-feedback has-feedback-left input-g-recaptcha-response {{ count($errors) && $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
    <div class="g-recaptcha" data-sitekey="{{ env('RE_CAPTCHA_KEY') }}"></div>
    @include('_input_error_block', ['name' => 'g-recaptcha-response'])
</div>