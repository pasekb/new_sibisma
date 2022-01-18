@push('after-css')
<style>
    a.btnAction {
        font-size: 20px;
    }

    table tr th,
    table tr td {
        padding: 10px;
        border: 2px solid #fff;
    }

    table tr th.full {
        width: 100%;
    }

    table tbody tr:nth-child(odd) {
        background-color: #00000010;
    }

    table .ctr {
        text-align: center;
    }

    table .customTable {
        overflow-x: auto;
    }

    table a:hover {
        text-decoration: none;
        font-weight: bold;
    }

    .header {
        font-weight: bold;
    }

    .total {
        color: white;
        background-color: #0f5abc;
    }

    .sum {
        background-color: #00000010;
    }

</style>
@endpush

@section('title','Send Report')
@section('page-title','Send Report')

@push('link-bread')
<li class="nav-item">
    <a href="{{ route('report.send-report') }}">Send Report</a>
</li>
@endpush

@push('button')
    @section('button-title','Stock History')
    @include('component.button-history')
@endpush

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Stock Report</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" align="right">
                    <button class="btn btnCopy" data-clipboard-action="copy" data-clipboard-target="#reportStock"><i class="fas fa-copy" id="icon"></i>&nbsp;&nbsp;Copy</button>
                </div>
            </div>
            <table style="width: 100%;">
                <div id="reportStock">
                    <p class="header">*Lap. Stok @if(Auth::user()->dealer_code != 'group') {{ $dealerName }} @endif {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}*</p>

                    <p class="header total">
                        *_Stok Awal : {{ $firstStock }}_*
                    </p>

                    <p class="header sum">
                        Masuk YIMM : *{{ $inYIMM }}* (+)
                    </p>
                    <p>
                        @foreach($dataInYIMM as $o)
                        {{ $o->in_qty }} | {{ $o->stock->unit->model_name }} |
                        {{ $o->stock->unit->color->color_name }} | {{ $o->stock->unit->year_mc }} <br>
                        @endforeach
                    </p><br>

                    <p class="header sum">
                        Masuk Cabang : *{{ $inBranch }}* (+)
                    </p>
                    <p>
                        @foreach($dataInBranch as $o)
                        {{ $o->in_qty }} | {{ $o->stock->unit->model_name }} |
                        {{ $o->stock->unit->color->color_name }} | {{ $o->stock->unit->year_mc }} <br>
                        @endforeach
                    </p><br>

                    <p class="header sum">
                        Keluar : *{{ $out }}* (-)
                    </p>
                    <p>
                        @foreach($dataOut as $o)
                        <span style="color: #0f5abc;">{{ $o->dealer_name }}</span> : {{ $o->qty }} |
                        {{ $o->stock->unit->model_name }} |
                        {{ $o->stock->unit->color->color_name }} | {{ $o->stock->unit->year_mc }} <br>
                        @endforeach
                    </p><br>

                    <p class="header sum">
                        Terjual : *{{ $sale }}* (-)
                    </p>
                    <p>
                        @foreach($dataSale as $o)
                        {{ $o->qty }} | {{ $o->stock->unit->model_name }} | {{ $o->stock->unit->color->color_name }} |
                        {{ $o->stock->unit->year_mc }} | {{ $o->leasing->leasing_code }} <br>
                        @endforeach
                    </p><br>

                    <p class="header total">
                        *_Stok Akhir : {{ $lastStock }}_*
                    </p><br>

                    <p class="{{ $diff == '0' ? 'd-none' : 'd-block' }}" style="color: red;">
                        Stok sistem : {{ $sysStock }} <br>
                        Selisih : {{ $diff }}
                    </p>

                    <p>_recorded in SiBisma on id:_ <br> _{{ $reportId }}_</p>
                </div>
            </table>
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
                            <th class="full">Date</th>
                            <th class="full">Dealer</th>
                            <th class="full">First Stock</th>
                            <th class="full">In</th>
                            <th class="full">Out</th>
                            <th class="full">Sale</th>
                            <th class="full">Last Stock</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Dealer</th>
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
                            <td><a href="{{ Auth::user()->dealer_code == 'group' ? url('report/'.$o->dealer_code.'/'.$o->history_date) : route('report.send-report', $o->history_date) }}" data-toggle="tooltip"
                                    data-placement="top"
                                    title="Show details">{{ \Carbon\Carbon::parse($o->history_date)->isoFormat('ddd, D-M-Y') }}
                                </a>
                            </td>
                            <td class="ctr">{{ $o->dealer_code }}</td>
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

@push('after-script')
<script src="{{ asset('clipboardjs/dist/clipboard.min.js') }}"></script>

<script>
    var clipboard = new ClipboardJS('.btnCopy');
    clipboard.on('success', function (e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);
        e.clearSelection();
    });
    clipboard.on('error', function (e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });

</script>

<script>
    $('.btnCopy').click(function(){
        $(this).text('Copied');
        $(this).addClass('btn-success');
        $(this).prepend(`<i class="fas fa-check"></i>&nbsp;&nbsp;`);
    })
</script>
@endpush
