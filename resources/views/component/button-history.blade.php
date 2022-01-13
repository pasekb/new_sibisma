<a href="
    @if(Route::is('sale.*'))
        {{ route('sale.history') }}
    @elseif(Route::is('entry.*'))
        {{ route('entry.history') }}
    @elseif(Route::is('out.*'))
        {{ route('out.history') }}
    @elseif(Route::is('sale-delivery.*'))
        {{ route('sale-delivery.history') }}
    @elseif(Route::is('branch-delivery.*'))
        {{ route('branch-delivery.history') }}
    @else
        #
    @endif
" class="btn btn-default btn-round" style="margin-bottom: 20px;"><i class="fas fa-hourglass-half"></i>&nbsp;&nbsp; <strong>@yield('button-title')</strong> </a>