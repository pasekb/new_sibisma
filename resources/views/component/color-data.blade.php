@push('after-css')
<style>
    a.btnAction{
        font-size: 20px;
    }
</style>
@endpush

@section('title','Color')
@section('page-title','Color')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('color.index') }}">Data Color</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Color Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th width="70">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th width="70">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->color_name }}</td>
                            <td style="background-color: <?php echo $o->color_code ?>50 ;">{{ $o->color_code }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>{{ $o->updatedBy->first_name }}</td>
                            <td>
                                <a href="{{ route('dealer.edit', $o->id) }}" class="btnAction" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                                &nbsp; | &nbsp;
                                <a href="{{ route('dealer.delete', $o->id) }}" class="btnAction" data-toggle="tooltip" data-placement="top" title="Delete" style="color:red;" onclick="return tanya('Yakin hapus dealer {{ $o->dealer_name }}?')"><i class="fas fa-trash-alt"></i></a>
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
