@extends('layouts.main')

@section('content')
    @if(Route::is('dashboard'))
        <livewire:dashboard>

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
        @include('component.sale-create')
        <livewire:ratio-stock>
        <livewire:sale-l-m>
        <livewire:sale-l-y>
        @include('component.sale-data')

    <!-- Entry Page -->
    @elseif(Route::is('entry.*'))
        @include('component.entry-create')
        <livewire:ratio-stock>
        <livewire:entry-l-m>
        <livewire:entry-l-y>
        @include('component.entry-data')

    <!-- Out Page -->
    @elseif(Route::is('out.*'))
        @include('component.out-create')
        <livewire:ratio-stock>
        <livewire:out-l-m>
        <livewire:out-l-y>
        @include('component.out-data')
    
    <!-- Opname Page -->
    @elseif(Route::is('opname.*'))
        @include('component.opname-create')
        @include('component.opname-data')

    <!-- Log Page -->
    @elseif(Route::is('log.*'))
        @include('component.log-data')
        
    @endif
    
@endsection

@push('after-script')
<script>
    $(document).ready(function () {
        $('#basic-datatables').DataTable({});

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
