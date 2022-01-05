@extends('layouts.main')

@section('content')
    @if(Route::is('unit.edit'))
        @include('component.unit-edit')
    @elseif(Route::is('unit.show'))
        @include('component.unit-show')
    @else
        @include('component.unit-create')
        @include('component.unit-data')
    @endif
@endsection

@push('after-script')
<script>
    $(document).ready(function () {
        $('#basic-datatables').DataTable({
            "scrollX": true
        });

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
