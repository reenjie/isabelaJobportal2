<div style="display: flex;justify-content:center">
    <ul class="pagination">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a class="page-link"
                    href="{{ $paginator->previousPageUrl() }}@if (request()->has('status') || request()->has('jobpost') || request()->has('search')) &status={{ request('status') }}&jobpost={{ request('jobpost') }}&search={{ request('search') }} @endif"
                    rel="prev">&laquo;</a>
            </li>
        @endif

        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link"
                                href="{{ $url }}@if (request()->has('status') || request()->has('jobpost') || request()->has('search')) &status={{ request('status') }}&jobpost={{ request('jobpost') }}&search={{ request('search') }} @endif">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link"
                    href="{{ $paginator->nextPageUrl() }}@if (request()->has('status') || request()->has('jobpost') || request()->has('search')) &status={{ request('status') }}&jobpost={{ request('jobpost') }}&search={{ request('search') }} @endif"
                    rel="next">&raquo;</a>
            </li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>

</div>
