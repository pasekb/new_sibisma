<div class="col-12 col-sm-6 col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5><b>Unit Entry</b></h5>
                    <p class="text-muted">{{ \Carbon\Carbon::parse($today)->format('l, j F Y') }}</p>
                </div>
                <h3 class="text-info fw-bold">{{ $totalEntry }}</h3>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar"
                    aria-valuenow="{{ $ratioPercent }}" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $ratioPercent ?>%"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <p class="text-muted mb-0"><a href="{{ route('stock.ratio') }}" class="text-info" id="stockRatio" style="text-decoration: none;">Stock Ratio</a></p>
                <p class="text-muted mb-0">{{ $ratio }}</p>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5><b>Sales vs Last Month</b></h5>
                    <p class="text-muted">{{ \Carbon\Carbon::parse($lastMonth)->format('M Y') }} vs {{ \Carbon\Carbon::parse($today)->format('M Y') }}</p>
                </div>
                <h3 class="text-success fw-bold">{{ $vsLM >= 0 ? '+'.$vsLM : $vsLM }}%</h3>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
                    aria-valuenow="{{ $vsLMach }}" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $vsLMach ?>%"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <p class="text-muted mb-0"><a href="{{ route('stock.ratio') }}" class="text-success" id="vsLM" style="text-decoration: none;">vs Last Month</a></p>
                <p class="text-muted mb-0">{{ $vsLMach }}%</p>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-sm-6 col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5><b>Sales vs Last Year</b></h5>
                    <p class="text-muted">{{ \Carbon\Carbon::parse($lastYear)->format('M Y') }} vs {{ \Carbon\Carbon::parse($today)->format('M Y') }}</p>
                </div>
                <h3 class="text-danger fw-bold">{{ $vsLY >= 0 ? '+'.$vsLY : $vsLY }}%</h3>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar"
                    aria-valuenow="{{ $vsLYach }}" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $vsLYach ?>%"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <p class="text-muted mb-0"><a href="{{ route('stock.ratio') }}" class="text-danger" id="vsLY" style="text-decoration: none;">vs Last Year</a></p>
                <p class="text-muted mb-0">{{ $vsLYach }}%</p>
            </div>
        </div>
    </div>
</div>

@push('after-script')
<script>
    $('#stockRatio').mouseenter(function(){
        let link = $('#stockRatio');
        link.text('Click for detail');
    })

    $('#stockRatio').mouseleave(function(){
        let link = $('#stockRatio');
        link.text('Stock Ratio');
    })

    $('#vsLM').mouseenter(function(){
        let link = $('#vsLM');
        link.text('Click for detail');
    })

    $('#vsLM').mouseleave(function(){
        let link = $('#vsLM');
        link.text('Stock Ratio');
    })

    $('#vsLY').mouseenter(function(){
        let link = $('#vsLY');
        link.text('Click for detail');
    })

    $('#vsLY').mouseleave(function(){
        let link = $('#vsLY');
        link.text('Stock Ratio');
    })
</script>
@endpush
