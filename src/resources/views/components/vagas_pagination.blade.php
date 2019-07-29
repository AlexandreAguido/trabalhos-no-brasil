
<div class="pagination">
{{-- pagina anterior --}}
@if( !$paginator->onFirstPage() )
    <a href="{{ pagination_url_pretty(url()->full(), $paginator->currentPage() - 1) }}">Anterior</a>
@endif

@php
    $start = $paginator->currentPage() - 2;
    $nextpg = $paginator->currentPage() + 1;
@endphp

@if( $nextpg <= $paginator->lastPage() )
    <a href="{{ pagination_url_pretty(url()->full(), $nextpg) }}">Proxima</a>
@endif
</div>
