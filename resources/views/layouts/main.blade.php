<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Wed Mar 21 2018 11:43:04 GMT+0000 (UTC)  -->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $data['seo']['title'] }}</title>
    @foreach($metas as $meta => $params)
        @if ($data['seo'][$meta])
            <meta {{ $params['name'] ? 'name='.$params['name'] : 'property='.$params['property'] }} content="{{ $data['seo'][$meta] }}">
        @endif
    @endforeach

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet">

    <link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/colors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap-switch.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/loader.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/slider.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">

    <!-- Lang vars -->
    @include('layouts._lang_vars_block')
    <!-- /Lang vars -->

    <script src="https://www.google.com/recaptcha/api.js?hl={{ App::getLocale() }}"></script>
    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/libraries/bootstrap.min.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('js/plugins/loaders/blockui.min.js') }}"></script>--}}
    <!-- /core JS files -->

    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/bootstrap-switch.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>--}}

    {{--<script type="text/javascript" src="{{ asset('js/plugins/ui/moment/moment.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/pickers/daterangepicker.js') }}"></script>--}}

    {{--<script type="text/javascript" src="{{ asset('js/plugins/pickers/anytime.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/pickers/pickadate/picker.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/pickers/pickadate/picker.date.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/pickers/pickadate/picker.time.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/pickers/pickadate/legacy.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/pages/picker_date.js') }}"></script>--}}

    {{--<script type="text/javascript" src="{{ asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/plugins/media/fancybox.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('js/pages/datatables_basic.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/pages/components_thumbnails.js') }}"></script>--}}

    {{--<script type="text/javascript" src="{{ asset('js/core/main.controls.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/scrollreveal.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('js/core/libraries/jquery_ui/widgets.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/core/libraries/jquery_ui/touch.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/sliders/slider_pips.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/forms/styling/switchery.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/inputs/typeahead/handlebars.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/core/main.controls.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/loader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/timer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ajax_requests.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('js/preview_image.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/max_height.js') }}"></script>--}}

    <script type="text/javascript" src="{{ asset('js/dm3Slideshow.jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/masks.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/basket.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/delete.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</head>
<body>
@if (Auth::guest())
    @include('auth._login_phone_modal_block')
    @include('auth._login_sms_modal_block')
    @include('auth._login_email_modal_block')
    @include('auth._register_modal_block')
    @include('auth._password_reset_modal_block')
    @include('auth._send_confirm_modal_block')

    @if (Helper::checkPasswordReset())
        @include('auth._reset_modal_block')
    @endif
@endif

@include('layouts._message_modal_block')
@include('layouts._callback_modal_block')
@include('layouts._basket_modal_block')

<!-- Top navbar -->
<div class="navbar navbar-inverse" data-scroll-destination='top'>
    <div class="container">
        <div class="navbar-left">
            <ul class="nav navbar-nav">
                <li>
                    <a id="call-to-us" href="tel:{{ Helper::hrefTel() }}">
                        <div>{{ trans('menu.call_us') }}</div>
                        <div>{{ Settings::getSettings()->phone }}</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="socnet-icon">@include('layouts._socnet_icon_block', ['href' => 'https://vk.com/'.Settings::getSettings()->vk_group, 'icon' => 'fa fa-vk'])</li>
                @if (Auth::guest())
                    @include('layouts._auth_button_block',['loginMode' => true])
                @else
                    @include('layouts._auth_button_block',['loginMode' => false])

                    {{--<li class="dropdown">--}}
                        {{--<a class="dropdown-toggle" data-toggle="dropdown">--}}
                            {{--@include('layouts._avatar_block',['avatar' => Auth::user()->avatar])--}}
                            {{--<div class="user-creds">{!! Helper::userCreds() !!}</div>--}}
                            {{--<i class="caret"></i>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu dropdown-menu-right">--}}
                            {{--<li><a href="{{ url('/profile') }}"><i class="icon-user-plus"></i> {{ trans('content.my_profile') }}</a></li>--}}
                            {{--@if (Gate::allows('admin') || Gate::allows('half_admin'))--}}
                                {{--<li><a href="{{ url('/admin') }}"><i class="icon-brain"></i> {{ trans('admin.admin_page') }}</a></li>--}}
                            {{--@endif--}}
                            {{--<li><a href="{{ url('/logout') }}"><i class="icon-switch2"></i> {{ trans('content.logout') }}</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- /top navbar -->

<!-- Main navbar -->
<nav class="navbar navbar-default main-menu">
    <div class="navbar-header">
        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
            <i class="icon-arrow-down12"></i>
        </button>
    </div>
    @include('layouts._main_logo_block',['addClass' => 'visible-xs'])
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <div class="container">
            @include('layouts._main_logo_block',['addClass' => 'hidden-xs'])
            <div class="navbar-left">
                <ul class="nav navbar-nav">
                    @include('layouts._menu_items_block',['menu' => $mainMenu, 'start' => 0, 'end' => count($mainMenu), 'break' => false, 'dropdown' => true])
                </ul>
            </div>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li>
                        <a id="basket" data-toggle="modal" data-target="#basket-modal">
                            @if (Session::has('basket') && count(Session::get('basket')))
                                <div id="basket-counter">{{ Helper::countBasket() }}</div>
                            @endif
                            <i class="icon-cart2"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- /main navbar -->

<!-- Page container -->
@include('layouts._slider_block', ['slim' =>
        !in_array(Request::path(),['/','login-phone','login-email','register','password-reset','send-confirm']) &&
        !Helper::checkPasswordReset(Request::path()
    )
])
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
</div>
<!-- /page container -->

<!-- Footer -->
<div class="footer">
    <div class="container">
        <ul class="menu">
            @include('layouts._menu_items_block',['menu' => $mainMenu, 'start' => 0, 'end' => count($mainMenu), 'break' => false, 'dropdown' => false])
        </ul>
        <div class="copyright">
            @include('layouts._socnet_icon_block', ['href' => 'https://vk.com/'.Settings::getSettings()->vk_group, 'icon' => 'fa fa-vk']) © BeefKo 2020
        </div>
    </div>
</div>
<!-- /footer -->

<div id="on-top-button" data-scroll="home"><i class="icon-arrow-up12"></i></div>
<a href="https://wa.me/{{ Helper::hrefTel() }}" target="_blank"><img id="whatsapp-icon" src="{{ asset('images/whatsapp-messenger.png') }}"></a>
<a id="callback-button" data-toggle="modal" data-target="#callback-modal"><i class="icon-phone-wave"></i></a>
@if (Session::has('message'))
    <script>window.showModal = 'message';</script>
    @php Session::forget('message'); @endphp
@endif
</body>
</html>
