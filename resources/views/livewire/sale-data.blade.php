@section('title','Sales')
@section('page-title','Sales')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sale.index') }}">Data Sales</a>
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
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Year</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Model Name</th>
                            <th>Color</th>
                            <th>Year</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td>{{ $o->model_name }}</td>
                            <td style="background-color: <?php echo $o->color->color_code ?>50 ;">
                                {{ $o->color->color_name }}
                            </td>
                            <td>{{ $o->year_mc }}</td>
                            <td>{{ $o->createdBy->first_name }}</td>
                            <td>{{ $o->updatedBy->first_name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
