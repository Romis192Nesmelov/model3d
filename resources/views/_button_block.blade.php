<?php $attrString = ''; ?>
@if (isset($addAttr) && $addAttr && is_array($addAttr))
    @foreach ($addAttr as $attr => $val)
        <?php $attrString .= $attr.'='.$val.' '; ?>
    @endforeach
@endif
<button {{ isset($disabled) && $disabled ? 'disabled' : '' }} {{ isset($type) && $type ? 'type='.$type : '' }} {!! $attrString !!} class="btn {{ isset($mainClass) ? $mainClass : 'btn-primary' }} {{ isset($addClass) ? $addClass : '' }}">
    @if (isset($icon))
        <span class="icon {{ $icon }}"></span>
    @endif
    {!! $text !!}
</button>