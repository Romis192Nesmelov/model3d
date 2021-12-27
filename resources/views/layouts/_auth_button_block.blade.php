<li class="button">
    @if ($loginMode)
        <a data-toggle="modal" data-target="#login-phone">{{ trans('auth.login_register') }}</a>
    @else
        <a href="{{ url('/logout') }}">{{ trans('auth.logout') }}</a>
    @endif
</li>