@push('after-css')
<style>
    a.btnAction{
        font-size: 20px;
    }
</style>
@endpush
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Manpower Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Dealer</th>
                            <th>Contact</th>
                            <th>Position</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th width="120">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Dealer</th>
                            <th>Contact</th>
                            <th>Position</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th width="120">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->name }}</td>
                            <td>{{ $o->dealer->dealer_name }}</td>
                            <td>{{ $o->phone }}</td>
                            <td>{{ $o->position }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>{{ $o->updatedBy->first_name }}</td>
                            <td>
                                <a href="{{ route('manpower.show', $o->id) }}" class="btnAction" data-toggle="tooltip" data-placement="top" title="Detail" style="color:orange;"><i class="fa fa-eye"></i></a>
                                &nbsp; | &nbsp;
                                <a href="{{ route('manpower.edit', $o->id) }}" class="btnAction" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                &nbsp; | &nbsp;
                                <a href="{{ route('manpower.delete', $o->id) }}" class="btnAction" data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;" onclick="return tanya('Yakin hapus manpower {{ $o->name }}?')"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
