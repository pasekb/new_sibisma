@extends('layouts.main')

@section('content')
    @if(Route::is('dashboard'))
        @section('title','Dashboard')
        @section('page-title','Dashboard')

        @push('link-bread')
        <li class="nav-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        @endpush
        <livewire:sale-chart>
        <livewire:ratio-stock>
        <livewire:sale-l-m>
        <livewire:sale-l-y>
        <livewire:sale-by-dealer-chart>
        <livewire:top-product-chart>
        <livewire:top-stock-chart>
        <livewire:psi-chart>

    <!-- Dealer Page -->
    @elseif(Route::is('dealer.*'))
        @if(Route::is('dealer.edit'))
            @include('component.dealer-edit') 
        @else
            @include('component.dealer-create')
            @include('component.dealer-data')
        @endif

    <!-- Manpower Page -->
    @elseif(Route::is('manpower.*'))
        @if(Route::is('manpower.edit'))
            @include('component.manpower-edit')
        @elseif(Route::is('manpower.show'))
            @include('component.manpower-show')
        @else
            @include('component.manpower-create')
            @include('component.manpower-data')
        @endif

        <!-- Dokumen Page -->
    @elseif(Route::is('document.*'))
        {{-- @include('component.dokumen-create') --}}
        @if(Route::is('document.show'))
            @include('component.dokumen-show')
        @elseif(Route::is('document.edit'))
            @include('component.dokumen-edit')
        @elseif(Route::is('document.history'))
            @include('component.search-box')
            @include('component.dokumen-history') 
        @else
            @include('component.dokumen-data')
        @endif

    <!-- Unit Page -->
    @elseif(Route::is('unit.*'))
        @if(Route::is('unit.edit'))
            @include('component.unit-edit')
        @elseif(Route::is('unit.show'))
            @include('component.unit-show')
        @else
            @include('component.unit-create')
            @include('component.unit-data')
        @endif

    <!-- Color Page -->
    @elseif(Route::is('color.*'))
        @if(Route::is('color.edit'))
            @include('component.color-edit') 
        @else
            @include('component.color-create')
            @include('component.color-data')
        @endif

    <!-- Leasing Page -->
    @elseif(Route::is('leasing.*'))
        @if(Route::is('leasing.edit'))
            @include('component.leasing-edit') 
        @else
            @include('component.leasing-create')
            @include('component.leasing-data')
        @endif

    <!-- Stock Page -->
    @elseif(Route::is('stock.*'))
        @if(Route::is('stock.show'))
            @include('component.stock-show')
        @else
            @include('component.stock-create')
            @include('component.stock-data')
        @endif

    <!-- Sale Page -->
    @elseif(Route::is('sale.*'))
        @if(Route::is('sale.history'))
            <livewire:ratio-stock>
            <livewire:sale-l-m>
            <livewire:sale-l-y>
            @include('component.search-box')
            @include('component.sale-history')
        @elseif(Route::is('sale.ach'))
            @include('component.sale-ach')
        @else
            @include('component.sale-create')
            <livewire:ratio-stock>
            <livewire:sale-l-m>
            <livewire:sale-l-y>
            @include('component.sale-data')
        @endif

    <!-- Entry Page -->
    @elseif(Route::is('entry.*'))
        @if(Route::is('entry.history'))
            <livewire:ratio-stock>
            <livewire:entry-l-m>
            <livewire:entry-l-y>
            @include('component.search-box')
            @include('component.entry-history')
        @else
            @include('component.entry-create')
            <livewire:ratio-stock>
            <livewire:entry-l-m>
            <livewire:entry-l-y>
            @include('component.entry-data')
        @endif

    <!-- Out Page -->
    @elseif(Route::is('out.*'))
        @if(Route::is('out.history'))
            <livewire:ratio-stock>
            <livewire:out-l-m>
            <livewire:out-l-y>
            @include('component.search-box')
            @include('component.out-history')
        @else
            @include('component.out-create')
            <livewire:ratio-stock>
            <livewire:out-l-m>
            <livewire:out-l-y>
            @include('component.out-data')
        @endif
    
    <!-- Opname Page -->
    @elseif(Route::is('opname.*'))
        @if(Route::is('opname.history'))
            @include('component.search-box')
            @include('component.opname-data')
        @else
            @include('component.opname-create')
            @include('component.opname-data')
        @endif

    <!-- Report -->

    @elseif(Route::is('report.*'))
        @if(Route::is('report.stock-history'))
            @include('component.search-box')
            @include('component.stock-history')
        @elseif(Route::is('report.send-report'))
            @include('component.send-report')
        @elseif(Route::is('report.send-group'))
            @include('component.send-group')
        @elseif(Route::is('report.search-id'))
            @include('component.search-report-id')
            @include('component.search-report-id-data')
        @endif

    <!-- Log Page -->
    @elseif(Route::is('log'))
        @include('component.search-box')
        @include('component.log-data')

    <!-- User Page -->
    @elseif(Route::is('user.*'))
        @if(Route::is('user.edit'))
            @include('component.user-edit')
        @elseif(Route::is('user.show'))
            @include('component.user-show')
        @else
            @include('component.user-create')
            @include('component.user-data')
        @endif

    <!-- Sale Delivery Page -->
    @elseif(Route::is('sale-delivery.*'))
        @if(Route::is('sale-delivery.history'))
            @include('component.search-box')
            @include('component.sale-delivery-history')
        @elseif(Route::is('sale-delivery.show'))
            @include('component.sale-delivery-show')
        @elseif(Route::is('sale-delivery.edit'))
            @include('component.sale-delivery-edit')
        @else
            @include('component.sale-delivery-create')
            @include('component.sale-delivery-data')
        @endif

    <!-- Branch Delivery Page -->
    @elseif(Route::is('branch-delivery.*'))
        @if(Route::is('branch-delivery.history'))
            @include('component.search-box')
            @include('component.branch-delivery-history')
        @elseif(Route::is('branch-delivery.show'))
            @include('component.branch-delivery-show')
        @elseif(Route::is('branch-delivery.edit'))
            @include('component.branch-delivery-edit')
        @else
            @include('component.branch-delivery-create')
            @include('component.branch-delivery-data')
        @endif

    <!-- Faktur Service Page -->
    @elseif(Route::is('stock-history.*'))
        @include('component.fns-create')
        
    @endif
    
@endsection

@push('after-script')
<script>
    $(document).ready(function () {
        $('#basic-datatables').DataTable({});

        $('#basic-table-position').DataTable({});

        $('#multi-filter-select').DataTable({
            "pageLength": 20,
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var select = $(
                            '<select class="form-control"><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d +
                            '</option>')
                    });
                });
            }
        });
    });

</script>
@endpush
