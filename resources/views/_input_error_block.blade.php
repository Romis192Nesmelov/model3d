@if ( (count($errors) && $errors->has($name)) || (isset($usingAjax) && $usingAjax))
    <span class="error help-block">{{ (isset($usingAjax) && $usingAjax) && !count($errors) ? '' : $errors->first($name) }}</span>
@endif