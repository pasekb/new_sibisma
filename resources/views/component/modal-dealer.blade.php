<div class="modal fade modalDealer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select Dealer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Dealer Code</th>
                                <th>Dealer Name</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <tr>
                                <th>Dealer Code</th>
                                <th>Dealer Name</th>
                            </tr>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($dealer as $o)
                            <tr data-id="{{ $o->id }}" data-name="{{ $o->dealer_name }}" class="pilih">
                                <td>{{ $o->dealer_code }}</td>
                                <td>{{ $o->dealer_name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" style="text-align: center;">No data available</td>
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
    $(document).on('click', '.pilih', function (e) {
        $('#dealer_id').val($(this).attr('data-id'));
        $('#dealer_name').val($(this).attr('data-name'));
        $('.modalDealer').modal('hide');
    });
</script>
@endpush