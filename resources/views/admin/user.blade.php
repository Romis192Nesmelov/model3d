@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => (isset($data['item']) ? Helper::userCreds($data['item']) : trans('admin.adding_user')),'h' => 5])
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/user') }}" method="post">
                {{ csrf_field() }}
                @include('admin._hidden_id_block',['item' => isset($data['item']) ? $data['item'] : null])
                <div class="col-md-2 col-sm-2 col-xs-12 left-block">
                    @include('_image_block', [
                        'label' => trans('content.avatar'),
                        'preview' => isset($data['item']) ? $data['item']->avatar : '',
                        'name' => 'avatar',
                        'placeholder' => asset('images/placeholder.jpg')
                    ])
                </div>

                <div class="col-md-10 col-sm-10 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._panel_title_block',['title' => trans('auth.star_mark'),'h' => 3])
                        <div class="panel-body">
                            @include('_input_block', [
                                'star' => true,
                                'label' => trans('content.user_name'),
                                'name' => 'name',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.user_name'),
                                'value' => isset($data['item']) ? $data['item']->name : '',
                            ])

                            @include('_input_block', [
                                'star' => true,
                                 'label' => trans('content.phone'),
                                 'name' => 'phone',
                                 'type' => 'tel',
                                 'placeholder' => trans('content.phone'),
                                 'value' => isset($data['item']) ? $data['item']->phone : ''
                             ])

                            @include('_input_block', [
                                'star' => true,
                                'label' => 'E-mail:',
                                'name' => 'email',
                                'type' => 'email',
                                'max' => 100,
                                'placeholder' => 'E-mail:',
                                'value' => isset($data['item']) ? $data['item']->email : ''
                            ])
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        @if (isset($data['item']))
                            <div class="panel-heading">
                                <h4 class="text-grey-300">{!! trans('auth.keep_password') !!}</h4>
                            </div>
                        @endif
                        <div class="panel-body">
                            @include('_input_block',[
                                'name' => 'password',
                                'type' => 'password',
                                'placeholder' => trans('auth.password')
                            ])
                            @include('_input_block',[
                                'name' => 'password_confirmation',
                                'type' => 'password',
                                'placeholder' => trans('auth.password_confirm')
                            ])
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        @include('admin._panel_title_block',['title' => trans('admin.user_type'),'h' => 5])
                        <div class="panel-body">
                            @include('admin._radio_button_block', [
                                'name' => 'type',
                                'values' => [
                                    ['val' => 1, 'descript' => trans('admin.user')],
                                    ['val' => 2, 'descript' => trans('admin.admin')]
                                ],
                                'activeValue' => isset($data['item']) ? $data['item']->type : 1
                            ])

                            @include('_checkbox_block',[
                                'label' => trans('admin.user_active'),
                                'name' => 'active',
                                'checked' => isset($data['item']) ? $data['item']->active : true
                            ])
                        </div>
                    </div>
                </div>

                @include('admin._save_button_block')
            </form>
        </div>
    </div>
    @if (isset($data['item']))
        @include('_modal_delete_block',['modalId' => 'delete-sms-login-modal', 'function' => url('admin/delete-sms-login'), 'head' => trans('admin.do_you_want_to_delete_record')])

        <div class="panel panel-flat">
            @include('admin._panel_title_block',['title' => trans('admin.logins_via_phone')])
            <div class="panel-body">
                @if (count($data['item']->smsLogin))
                    <table class="table datatable-basic table-items">
                        <tr>
                            <th class="text-center">{{ trans('admin.requested_code') }}</th>
                            <th class="text-center">{{ trans('admin.requested_code_time') }}</th>
                            <th class="text-center">{{ trans('admin.login_result') }}</th>
                            <th class="text-center">{{ trans('admin.login_time') }}</th>
                            <th width="0"></th>
                            <th class="text-center">{{ trans('admin.del') }}</th>
                        </tr>
                        @foreach ($data['item']->smsLogin as $login)
                            <tr class="data" role="row" id="{{ 'sms_'.$login->id }}">
                                <td class="text-center name">{{ $login->code }}</td>
                                <td class="text-center">{{ $login->created_at->format('H-i-s d.m.Y') }}</td>
                                <td class="text-center">
                                    @include('admin._status_simple_block',[
                                        'status' => $login->done,
                                        'trueLabel' => trans('admin.login_done'),
                                        'falseLabel' => trans('admin.login_not_done')
                                    ])
                                </td>
                                <td class="text-center">{{ $login->done ? $login->updated_at->format('H-i-s d.m.Y') : '' }}</td>
                                <td></td>
                                @include('_delete_on_table_block',['method' => 'delete-sms-login-modal', 'id' => $login->id])
                            </tr>
                        @endforeach
                    </table>
                @else
                    <h2 class="text-center">{{ trans('admin.no_data') }}</h2>
                @endif
            </div>
        </div>

        @include('admin._orders_table_block',['orders' => $data['item']->orders, 'parentId' => $data['item']->id, 'userId' => $data['item']->id])
    @endif
@endsection