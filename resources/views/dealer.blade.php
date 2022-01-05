@extends('layouts.main')
@section('title','Dealer')

@section('content')
    @if(Route::is('dealer.edit'))
        @include('component.dealer-edit') 
    @else
        @include('component.dealer-create')
        @include('component.dealer-data')
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
