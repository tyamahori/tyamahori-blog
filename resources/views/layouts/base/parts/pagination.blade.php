@if ($paginator->hasPages())
  <nav class="pagination" role="navigation" aria-label="pagination">
    @if (!$paginator->onFirstPage())
      <a class="pagination-previous" rel="prev" href="{{ $paginator->previousPageUrl() }}">@lang('pagination.next')</a>
    @endif

    @if ($paginator->hasMorePages())
      <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.previous')</a>
    @endif
  </nav>
@endif


