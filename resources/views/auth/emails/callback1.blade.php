@extends('layouts.mail')

@section('content')
    @include('auth.emails._head_block',['hLevel' => 2, 'head' => trans('content.callback_request_from', ['user_name' => $user_name])])
    @include('auth.emails._head_block',['hLevel' => 2, 'head' => trans('content.phone',['phone' => $phone])])
    @if ($question)
        <p><b>{{ trans('content.question') }}</b></p>
        <p>{{ $question }}</p>
    @endif
@endsection