<div class="modal fade modalBackupDriver" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Select PIC</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Manpower's Name</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Position</th>
                                <th>Manpower's Name</th>
                                @if(Auth::user()->dealer_code == 'group')
                                <th>Dealer</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($manpower as $o)
                            <tr data-id="{{ $o->id }}"
                                data-name="{{ $o->name }}" class="pilihBackupDriver">
                                <td>{{ $o->position }}</td>
                                <td>{{ $o->name }}</td>
                                @if(Auth::user()->dealer_code == 'group')
                                <td>{{ $o->dealer->dealer_code }}</td>
                                @endif
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
    $(document).on('click', '.pilihBackupDriver', function (e) {
        $('#backup_driver').val($(this).attr('data-id'));
        $('#pic_name').val($(this).attr('data-name'));
        $('.modalBackupDriver').modal('hide');
    });
</script>
@endpush
