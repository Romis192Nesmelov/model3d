@extends('layouts.admin')

@section('content')
    @include('admin._products_table_block',['products' => $data['items']])
@endsection