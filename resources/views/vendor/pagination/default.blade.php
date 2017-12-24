@if ($paginator->hasPages())
    <div class="page-wrapper">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="page-link-normal disabled"><span class="glyphicon glyphicon-chevron-left"></span></div>
        @else
            <a href="{{ $paginator->previousPageUrl()}}@if(app('request')->input('order')!=null)&order={{app('request')->input('order')}}@endif" rel="prev" class="page-link-normal "><span class="glyphicon glyphicon-chevron-left"></span></a>
        @endif
        <div class="page-controls">
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <div class="page-link-normal disabled">{{ $element }}</div>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <div class="page-link-normal active-tab">{{ $page }}</div>
                    @else
                        <a href="{{ $url }}@if(app('request')->input('order')!=null)&order={{app('request')->input('order')}}@endif" class="page-link-normal " >{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        </div>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="page-link-normal" href="{{ $paginator->nextPageUrl()}}@if(app('request')->input('order')!=null)&order={{app('request')->input('order')}}@endif" rel="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        @else
            <div class="page-link-normal disabled"><span class="glyphicon glyphicon-chevron-right"></span></div>
        @endif
    </div>
@endif
