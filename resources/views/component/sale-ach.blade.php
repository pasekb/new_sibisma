@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

</style>
@endpush

@section('title','Sales Achievement')
@section('page-title','Sales Achievement')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('sale.ach', $param) }}">Data Sales Achievement</a>
</li>
@endpush

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sales Achievement Data</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                    <table id="multi-filter-select" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Last Month</th>
                                <th>This Month</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Last Month</th>
                                <th>This Month</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($data as $o)
                            <tr>
                                <td>{{ $o->lastmonth }}</td>
                                <td>{{ $o->thismont }}</td>
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
    </div>
</div>
