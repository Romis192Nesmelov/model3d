{!! csrf_field() !!}
<div class="modal-body">
    @if (Session::has('basket'))
        <table class="basket-input basket">
            @foreach (Session::get('basket') as $id => $item)
                @include('_basket_input_row_block',[
                    'productName' => $item['name'],
                    'basketValue' => $item['num'],
                    'inputName' => 'product_id_'.$id,
                    'rowId' => $id
                ])
            @endforeach
            @include('layouts._basket_inputs_table_buttons_block')
        </table>
        <h2 class="hidden">{{ trans('content.basket_is_empty') }}</h2>
    @else
        <table class="basket-input basket hidden">
            @include('layouts._basket_inputs_table_buttons_block')
        </table>
        <h2>{{ trans('content.basket_is_empty') }}</h2>
    @endif
</div>
@include('layouts._modal_block',[
    'id' => 'basket-modal',
    'title' => trans('content.your_basket'),
    'content' => ob_get_clean()
])