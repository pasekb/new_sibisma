<div class="modal fade modalData" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">@yield('modal-title')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>Model Name</th>
                                    <th>Category</th>
                                    <th>Color</th>
                                    <th>Year</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                    <th>Model Name</th>
                                    <th>Category</th>
                                    <th>Color</th>
                                    <th>Year</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @forelse($unit as $o)
                                <tr data-id="{{ $o->id }}"
                                    data-model="{{ $o->model_name }}"
                                    data-color="{{ $o->color->color_name }}"
                                    data-colorcode="{{ $o->color->color_code }}"
                                    data-yearmc="{{ $o->year_mc }}" class="klik">
                                    <td>{{ $o->model_name }}</td>
                                    <td>{{ $o->category }}</td>
                                    <td style="background-color: <?php echo $o->color->color_code ?>50 ;">
                                        {{ $o->color->color_name }}
                                    </td>
                                    <td>{{ $o->year_mc }}</td>
                                    <td>{{ $o->createdBy->first_name }}</td>
                                    <td>{{ $o->updatedBy->first_name }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" style="text-align: center;">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <p><strong>SiBisma</strong> v3.0 &copy; CRM Bisma | Est 2019</p>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $(document).on('click','.klik', function(e){
        let code = $(this).attr('data-colorcode');
        $('#unit_id').val($(this).attr('data-id'));
        $('#model_name').val($(this).attr('data-model'));
        $('#color').val($(this).attr('data-color'));
        $('#year_mc').val($(this).attr('data-yearmc'));
        $('.modalData').modal('hide');

        $('#color_code').css('background',code);
    });
</script>
@endpush
