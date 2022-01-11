@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Stock History')
@section('page-title','Stock History')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('report.stock-history') }}">Data Stock History</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <livewire:widget-stock-qty>
                <h4 class="card-title">Stock History Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Dealer</th>
                            <th>First Stock</th>
                            <th>In Stock</th>
                            <th>Out Stock</th>
                            <th>Sale Stock</th>
                            <th>Last Stock</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Dealer</th>
                            <th>First Stock</th>
                            <th>In Stock</th>
                            <th>Out Stock</th>
                            <th>Sale Stock</th>
                            <th>Last Stock</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->history_date }}</td>
                            <td>{{ $o->dealer->dealer_name }}</td>
                            <td>{{ $o->first_stock }}</td>
                            <td>{{ $o->in_qty }}</td>
                            <td>{{ $o->out_qty }}</td>
                            <td>{{ $o->sale_qty }}</td>
                            <td>{{ $o->last_stock }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>{{ $o->updatedBy->first_name }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('report.update-status', $o->id, $o->status) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Change Status"
                                        onclick="return tanya('Ubah status History?')">
                                        @if($o->status == 'uncompleted') 
                                        <i class="fas fa-toggle-on" style="color:green;"></i>
                                        @else
                                        <i class="fas fa-toggle-off" style="color:grey;"></i>
                                        @endif
                                    </a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('report.delete', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                        onclick="return tanya('Yakin hapus stock {{ $o->unit->model_name }}?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
