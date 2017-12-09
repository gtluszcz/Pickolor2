@if ($paginator->hasPages())
    <ul class="palettes-tabs">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        @else
            <a class="tab-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="tab-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
        @else
        @endif
    </ul>
@endif
