<div class="col-12 col-sm-6 col-md-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <h5><b>Unit Sales</b></h5>
                    <p class="text-muted">{{ $today }}</p>
                </div>
                <h3 class="text-info fw-bold">{{ $totalSales }}</h3>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-info w-{{ $ratioPercent }}" role="progressbar"
                    aria-valuenow="{{ $ratioPercent }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <p class="text-muted mb-0">Stock Ratio</p>
                <p class="text-muted mb-0">{{ $ratio }}</p>
            </div>
        </div>
    </div>
</div>
