@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => (isset($data['item']) ? $data['item']->name : trans('admin.adding_product')),'h' => 5])
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/product') }}" method="post">
                {{ csrf_field() }}
                @include('admin._hidden_id_block',['item' => isset($data['item']) ? $data['item'] : null])
                <div class="col-md-2 col-sm-3 col-xs-12 left-block">
                    @include('_image_block', [
                        'label' => trans('admin.image'),
                        'preview' => isset($data['item']) ? $data['item']->image : '',
                        'name' => 'image',
                        'placeholder' => asset('images/placeholder.jpg')
                    ])
                </div>
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._panel_title_block',['title' => trans('auth.star_mark'),'h' => 3])
                        <div class="panel-body">
                            @include('admin._select_block',[
                                'label' => trans('admin.product_group'),
                                'name' => 'product_group_id',
                                'values' => $data['product_groups'],
                                'selected' => isset($data['item']) ? $data['item']->product_group_id : (Request::has('parent_id') ? Request::input('parent_id') : null)
                            ])

                            @include('_input_block', [
                                'star' => true,
                                'label' => trans('admin.name'),
                                'name' => 'name',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('admin.name'),
                                'value' => isset($data['item']) ? $data['item']->name : '',
                            ])

                            @include('_input_block', [
                                'star' => true,
                                'label' => trans('admin.price'),
                                'name' => 'price',
                                'type' => 'number',
                                'placeholder' => trans('admin.price'),
                                'value' => isset($data['item']) ? $data['item']->price : 500,
                            ])
                        </div>
                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('_checkbox_block',[
                                'label' => trans('admin.groups_active'),
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
        @include('admin._actions_table_block',['actions' => $data['item']->actions, 'parentId' => $data['item']->id])
        @include('admin._orders_table_block',['orders' => $data['item']->orders, 'parentId' => $data['item']->id])
    @endif
@endsection