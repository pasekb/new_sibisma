@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

    table tr th,
    table tr td{
        padding: 10px;
        border: 2px solid #fff;
    }

    table tr th{
        width: 100%;
    }

    table tbody tr:nth-child(odd){
        background-color: #00000010;
    }

    table .ctr{
        text-align: center;
    }

    table .customTable{
        overflow-x: auto;
    }

    table a:hover{
        text-decoration: none;
        font-weight: bold;
    }
</style>
@endpush

@section('title','Send Report')
@section('page-title','Send Report')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('color.index') }}">Send Report</a>
</li>
@endpush

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Stock Report</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="customTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>First Stock</th>
                            <th>In</th>
                            <th>Out</th>
                            <th>Sale</th>
                            <th>Last Stock</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>First Stock</th>
                            <th>In</th>
                            <th>Out</th>
                            <th>Sale</th>
                            <th>Last Stock</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td><a href="{{ route('report.send-report', $o->history_date) }}" data-toggle="tooltip" data-placement="top" title="Show details">{{ \Carbon\Carbon::parse($o->history_date)->isoFormat('ddd, D-M-Y') }}</></td>
                            <td class="ctr">{{ $o->first_stock }}</td>
                            <td class="ctr">{{ $o->in_qty }}</td>
                            <td class="ctr">{{ $o->out_qty }}</td>
                            <td class="ctr">{{ $o->sale_qty }}</td>
                            <td class="ctr">{{ $o->last_stock }}</td>
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

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Report History</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="customTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>First Stock</th>
                            <th>In</th>
                            <th>Out</th>
                            <th>Sale</th>
                            <th>Last Stock</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>First Stock</th>
                            <th>In</th>
                            <th>Out</th>
                            <th>Sale</th>
                            <th>Last Stock</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse($data as $o)
                        <tr>
                            <td><a href="{{ route('report.send-report', $o->history_date) }}" data-toggle="tooltip" data-placement="top" title="Show details">{{ \Carbon\Carbon::parse($o->history_date)->isoFormat('ddd, D-M-Y') }}</></td>
                            <td class="ctr">{{ $o->first_stock }}</td>
                            <td class="ctr">{{ $o->in_qty }}</td>
                            <td class="ctr">{{ $o->out_qty }}</td>
                            <td class="ctr">{{ $o->sale_qty }}</td>
                            <td class="ctr">{{ $o->last_stock }}</td>
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
