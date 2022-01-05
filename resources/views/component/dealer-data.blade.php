@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Dealer')
@section('page-title','Dealer')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('dealer') }}">Data Dealer</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Dealer Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Dealer Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th width="70">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Dealer Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th width="70">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php($no = 1)
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $no++ }}.&nbsp;&nbsp;{{ $o->dealer_name }}</td>
                            <td>{{ $o->address }}</td>
                            <td>{{ $o->phone }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>{{ $o->updatedBy->first_name }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('dealer.edit', $o->id) }}" class="btnAction" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('dealer.delete', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;"
                                        onclick="return tanya('Yakin hapus dealer {{ $o->dealer_name }}?')"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
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
    </div>
</div>
