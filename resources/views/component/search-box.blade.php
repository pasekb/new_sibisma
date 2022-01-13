<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <!-- FORM -->
                        <form action="
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
                            " method="get">
                            @csrf
                        <div class="input-group">
                                <input type="date" class="form-control" placeholder="" aria-label=""
                                    aria-describedby="basic-addon1" name="start" value="{{ $start != null ? $start : null }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="date" class="form-control" placeholder="" aria-label=""
                                aria-describedby="basic-addon1" name="end" value="{{ $end != null ? $end : null }}">
                            <!-- Hidden XS and MD -->
                            <div class="input-group-prepend">
                                <button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                        <!-- END FORM -->
                            <div class="input-group-prepend">
                                <a href="{{ route('report.print') }}" class="btn btn-success" type="button" style="color: #fff;"><i class="fas fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
