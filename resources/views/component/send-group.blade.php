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
        font-size: 20px;
    }

    .sum {
        background-color: #00000010;
    }

    .t{
        color: transparent;
    }

</style>
@endpush

@section('title','Send Report')
@section('page-title','Send Report')

@push('link-bread')
<li class="nav-item">
    <a href="#">Send Report</a>
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
                    <p class="header"><span class="t">*</span>Lap. Stok {{ $dealerName }} {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}<span class="t">*</span></p>

                    <p class="header total">
                        <span class="t">*_</span>Stok Awal : {{ $firstStock }}<span class="t">_*</span>
                    </p>

                    <p class="header sum">
                        Masuk YIMM : <span class="t">*</span>{{ $inYIMM }}<span class="t">*</span> (+)
                    </p>
                    <p>
                        @foreach($dataInYIMM as $o)
                        {{ $o->in_qty }} | {{ $o->stock->unit->model_name }} |
                        {{ $o->stock->unit->color->color_name }} | {{ $o->stock->unit->year_mc }} <br>
                        @endforeach
                    </p><br>

                    <p class="header sum">
                        Masuk Cabang : <span class="t">*</span>{{ $inBranch }}<span class="t">*</span> (+)
                    </p>
                    <p>
                        @foreach($dataInBranch as $o)
                        {{ $o->in_qty }} | {{ $o->stock->unit->model_name }} |
                        {{ $o->stock->unit->color->color_name }} | {{ $o->stock->unit->year_mc }} <br>
                        @endforeach
                    </p><br>

                    <p class="header sum">
                        Keluar : <span class="t">*</span>{{ $out }}<span class="t">*</span> (-)
                    </p>
                    <p>
                        @foreach($dataOut as $o)
                        <span style="color: #0f5abc;">{{ $o->dealer_name }}</span> : {{ $o->qty }} |
                        {{ $o->stock->unit->model_name }} |
                        {{ $o->stock->unit->color->color_name }} | {{ $o->stock->unit->year_mc }} <br>
                        @endforeach
                    </p><br>

                    <p class="header sum">
                        Terjual : <span class="t">*</span>{{ $sale }}<span class="t">*</span> (-)
                    </p>
                    <p>
                        @foreach($dataSale as $o)
                        {{ $o->qty }} | {{ $o->stock->unit->model_name }} | {{ $o->stock->unit->color->color_name }} |
                        {{ $o->stock->unit->year_mc }} | {{ $o->leasing->leasing_code }} <br>
                        @endforeach
                    </p><br>

                    <p class="header total">
                    <span class="t">*_</span>Stok Akhir : {{ $lastStock }}<span class="t">_*</span>
                    </p><br>

                    <p class="{{ $diff == '0' ? 'd-none' : 'd-block' }}" style="color: red;">
                        Stok sistem : {{ $sysStock }} <br>
                        Selisih : {{ $diff }} <br>
                        <a href="{{ route('opname.history', $dateOpname) }}"
                        data-toggle="tooltip" data-placement="top" title="Detail" style="text-decoration: none;">Stok opname : {{ $stockOpname }}</a>
                    </p>

                    <p><span class="t">_</span>recorded in SiBisma on id:<span class="t">_</span> <br> <span class="t">_</span>{{ $reportId }}<span class="t">_</span></p>
                </div>
            </table>
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