@extends('layouts.admin')

@include('_modal_delete_block',['modalId' => 'delete-product-group-modal', 'function' => url('admin/delete-product-group'), 'head' => trans('admin.do_you_want_to_delete_product_group')])
@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => trans('admin.product_groups')])
        <div class="panel-body">
            @if (count($data['items']))
                {{ csrf_field() }}
                <table class="table datatable-basic table-items">
                    <tr>
                        <th class="text-center">{{ trans('admin.image') }}</th>
                        <th class="text-center">{{ trans('admin.name') }}</th>
                        <th class="text-center">{{ trans('admin.status') }}</th>
                        <th class="text-center">{{ trans('admin.created_at') }}</th>
                        <th class="text-center">{{ trans('admin.edit') }}</th>
                        <th class="text-center">{{ trans('admin.del') }}</th>
                    </tr>
                    @foreach ($data['items'] as $group)
                        <tr class="data" role="row" id="{{ 'group_'.$group->id }}">
                            @include('admin._image_on_table_block',['image' => $group->image])
                            <td class="text-center name">{{ $group->name }}</td>
                            <td class="text-center">
                                @include('admin._status_simple_block',[
                                    'status' => $group->active,
                                    'trueLabel' => trans('admin.groups_active'),
                                    'falseLabel' => trans('admin.groups_not_active')
                                ])
                            </td>
                            <td class="text-center">{{ $group->created_at->format('d.m.Y') }}</td>
                            @include('admin._edit_on_table_block',['method' => 'product_groups', 'slug' => $group->slug])
                            @include('_delete_on_table_block',['method' => 'delete-product-group-modal', 'id' => $group->id])
                        </tr>
                    @endforeach
                </table>
            @else
                <h4 class="text-center">{{ trans('content.no_data') }}</h4>
            @endif
        </div>
        <div class="panel-body">
            @include('admin._add_button_block',['href' => 'product-groups/add', 'text' => trans('admin.add_product_group')])
        </div>
    </div>

@endsection