@extends('layouts.admin')

@include('_modal_delete_block',['modalId' => 'delete-user-modal', 'function' => url('admin/delete-user'), 'head' => trans('admin.do_you_want_to_delete_user')])
@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => trans('admin.users')])
        <div class="panel-body">
            {{ csrf_field() }}
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">{{ trans('auth.avatar') }}</th>
                    <th class="text-center">{{ trans('admin.user_name') }}</th>
                    <th class="text-center">{{ trans('auth.status') }}</th>
                    <th class="text-center">{{ trans('admin.registered') }}</th>
                    <th class="text-center">{{ trans('admin.edit') }}</th>
                    <th class="text-center">{{ trans('admin.del') }}</th>
                </tr>
                @foreach ($data['items'] as $user)
                    <tr class="data" role="row" id="{{ 'user_'.$user->id }}">
                        @include('admin._image_on_table_block',['image' => $user->avatar])
                        <td class="text-center name">{{ Helper::userCreds($user) }}</td>
                        <td class="text-center">
                            @include('admin._status_simple_block',[
                                'status' => $user->active,
                                'trueLabel' => trans('admin.user_active'),
                                'falseLabel' => trans('admin.user_not_active')
                            ])
                        </td>
                        <td class="text-center">{{ $user->created_at->format('d.m.Y') }}</td>
                        @include('admin._edit_on_table_block',['method' => 'users', 'id' => $user->id])
                        @include('_delete_on_table_block',['method' => 'delete-user-modal', 'id' => isset($deleteId) && $deleteId ? $deleteId : $user->id])
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="panel-body">
            @include('admin._add_button_block',['href' => 'users/add', 'text' => trans('admin.add_user')])
        </div>
    </div>
    
@endsection