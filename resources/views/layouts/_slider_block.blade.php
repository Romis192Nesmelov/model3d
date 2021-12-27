<div id="slideshow-wrap" {{ $slim ? 'class=slim' : '' }}>
    <div id="slideshow" {{ $slim ? 'class=slim' : '' }}>
        @if (count($slides) > 1)
            <div class="slideshow-controls">
                <a class="prev" href="#" title="Previous"></a>
                <a class="start" href="#"></a>
                <a class="next" href="#" title="Next"></a>
            </div>
        @endif
        <ul>
            @foreach ($slides as $k => $slide)
                <li>
                    <img class="slide" src="{{ asset($slide['image']) }}" />
                    <div class="text-block">
                        <h1 style="color:{{ $slide->color }}">{!! $slide->head !!}</h1>
                        <p style="color:{{ $slide->color }}">{!! $slide->text !!}</p>
                        <a data-toggle="modal" data-target="#callback-modal">
                            @include('_button_block',[
                                'type' => 'button',
                                'text' => trans('content.callback_me')
                            ])
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<script>window.sliderSlim = parseInt("{{ $slim }}");</script>