<div class="tabs">
    <ul class="nav nav-tabs">
        @foreach ($tabs as $k => $tab)
            <li style="width: {{ 100/count($tabs) }}%" {{ !$k ? 'class=active' : '' }} ><a href="#{{ $tab['id'] }}" data-toggle="tab">{{ $tab['name']}}</a></li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach ($tabs as $k => $tab)
            <div class="tab-pane {{ !$k ? 'active' : '' }}" id="{{ $tab['id'] }}">
                {!! $tab['content'] !!}
            </div>
        @endforeach
    </div>
</div>