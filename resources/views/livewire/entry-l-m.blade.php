<div class="col-12 col-sm-6 col-md-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5><b>Entry vs Last Month</b></h5>
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

@push('after-script')
<script>
    $('#vsLM').mouseenter(function(){
        let link = $('#vsLM');
        link.text('Click for detail');
    })

    $('#vsLM').mouseleave(function(){
        let link = $('#vsLM');
        link.text('Stock Ratio');
    })
</script>
@endpush