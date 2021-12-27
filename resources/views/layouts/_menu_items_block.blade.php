@if (!$start)
    <li><a class="home {{ Request::path() == '/' ? 'active' : '' }}" href="{{ url('/') }}">{{ trans('content.home_page') }}</a></li>
@endif
@for($i=$start;$i<$end;$i++)
    @php
        $parts = explode(' ',$menu[$i]['name']);
        $name = $break && count($parts) > 2 ? $parts[0].'<br>'.$parts[1].' '.$parts[2] : $menu[$i]['name'];
        $dropDownFlag = $dropdown && isset($menu[$i]['dropdown']) && count($menu[$i]['dropdown']);
    @endphp
    <li {{ $dropDownFlag ? 'class=dropdown' : '' }}>
        <a {{ isset($menu[$i]['href']) && preg_match('/^'.str_replace('/','\/',$menu[$i]['href']).'/',Request::path()) ? 'class=active' : (Request::path() != '/' && isset($menu[$i]['data_scroll']) && preg_match('/^'.str_replace('/','\/#',$menu[$i]['data_scroll']).'/',Request::path()) ? 'class=active' : '' ) }} {{ isset($menu[$i]['href']) ? 'href='.url($menu[$i]['href']) : (Request::path() == '/' ? 'data-scroll='.$menu[$i]['data_scroll'] : 'href='.url('/#'.$menu[$i]['data_scroll'])) }}>
            {!! $name !!}
            @if ($dropDownFlag)
                <span class="caret"></span>
            @endif
        </a>
        @if ($dropDownFlag)
            <ul class="dropdown-menu">
                @foreach ($menu[$i]['dropdown'] as $subMenu)
                    <li><a href="{{ url(isset($menu[$i]['href']) ? (isset($subMenu['prefix']) ? $subMenu['prefix'].'/' : '' ).$menu[$i]['href'].'/'.$subMenu['href'] : (isset($subMenu['prefix']) ? $subMenu['prefix'].'/' : '' ).$menu[$i]['data_scroll'].'/'.$subMenu['href']) }}">{{ $subMenu['name'] }}</a></li>
                @endforeach
            </ul>
        @endif
    </li>
@endfor