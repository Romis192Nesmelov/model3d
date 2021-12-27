<tr>
    <td colspan="3">
        @include('_button_block', [
            'addClass' => 'change-basket wide',
            'type' => 'button',
            'disabled' => false,
            'text' => trans('content.change_basket')
        ])

        <a href="{{ url('/order') }}">
            @include('_button_block', [
                'addClass' => 'wide',
                'type' => 'button',
                'disabled' => false,
                'text' => trans('content.complete_order')
            ])
        </a>
    </td>
</tr>