@extends('layouts.main')

@section('content')

    <script>window.homePage = true;</script>
    @if (Request::path() != '/')
        @if (Helper::checkPasswordReset(Request::path()))
            <script>window.showModal = 'new-password';</script>
        @else
            <script>window.showModal = "{{ Request::path() }}";</script>
        @endif
    @else
        <script>window.showModal = null;</script>
    @endif
@endsection