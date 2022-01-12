@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Document')
@section('page-title','Document')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('document.index') }}">Data Document</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sales Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-striped table-hover" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer Name</th>
                            <th>Model Name</th>
                            <th>STCK</th>
                            <th>STNK</th>
                            <th>BPKB</th>
                            <th>Frame No.</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Customer Name</th>
                            <th>Model Name</th>
                            <th>STCK</th>
                            <th>STNK</th>
                            <th>BPKB</th>
                            <th>Frame No.</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php($no = 1)
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $o->sale->customer_name }}</td>
                            <td>{{ $o->sale->stock->unit->model_name }}</td>
                            <td>{{ $o->stck }}</td>
                            <td>{{ $o->stnk}}</td>
                            <td>{{ $o->bpkb}}</td>
                            <td>{{ $o->frame_no }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('document.show', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Detail"
                                        style="color:orange;"><i class="fa fa-eye"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <a href="{{ route('document.edit', $o->id) }}" class="btnAction"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                </div>
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
