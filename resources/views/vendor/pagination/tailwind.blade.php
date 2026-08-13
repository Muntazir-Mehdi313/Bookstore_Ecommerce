@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

    <div class="flex gap-2 items-center justify-between sm:hidden">

        @if ($paginator->onFirstPage())
        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600  border border-blue-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
            {!! __('pagination.previous') !!}
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800  border border-blue-300 leading-5 rounded-md hover:text-blue-600 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 hover:bg-blue-100 dark:hover:bg-gray-900 dark:hover:text-gray-200">
            {!! __('pagination.previous') !!}
        </a>
        @endif

        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-800  border border-blue-300 leading-5 rounded-md hover:text-blue-600 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-800 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 hover:bg-blue-100 dark:hover:bg-gray-900 dark:hover:text-gray-200">
            {!! __('pagination.next') !!}
        </a>
        @else
        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600  border border-blue-300 cursor-not-allowed leading-5 rounded-md dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600">
            {!! __('pagination.next') !!}
        </span>
        @endif

    </div>
    <div class="hidden sm:flex sm:justify-center">
        <span class="inline-flex shadow-sm rounded-md">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
            <span class="inline-flex items-center px-3 py-2 text-blue-300 bg-white border border-blue-300 rounded-l-md cursor-not-allowed">
                &lsaquo;
            </span>
            @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="inline-flex items-center px-3 py-2 text-blue-600 bg-white border border-blue-300 rounded-l-md hover:bg-blue-100 transition">
                &lsaquo;
            </a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)

            @if (is_string($element))
            <span class="inline-flex items-center px-4 py-2 text-blue-600 bg-white border border-blue-300">
                {{ $element }}
            </span>
            @endif

            @if (is_array($element))
            @foreach ($element as $page => $url)

            @if ($page == $paginator->currentPage())
            <span class="inline-flex items-center px-4 py-2 text-white bg-blue-600 border border-blue-600">
                {{ $page }}
            </span>
            @else
            <a href="{{ $url }}"
                class="inline-flex items-center px-4 py-2 text-blue-600 bg-white border border-blue-300 hover:bg-blue-100 hover:text-blue-700 transition">
                {{ $page }}
            </a>
            @endif

            @endforeach
            @endif

            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="inline-flex items-center px-3 py-2 text-blue-600 bg-white border border-blue-300 rounded-r-md hover:bg-blue-100 transition">
                &rsaquo;
            </a>
            @else
            <span class="inline-flex items-center px-3 py-2 text-blue-300 bg-white border border-blue-300 rounded-r-md cursor-not-allowed">
                &rsaquo;
            </span>
            @endif

        </span>
    </div>
</nav>
@endif