<li class="nav-item {{ Route::is('report.*') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#report">
        <i class="fas fa-file-alt"></i>
        <p>Report</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('report.*') ? 'show' : '' }}" id="report">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('report.stock-history') ? 'active' : '' }}">
                <a href="{{ route('report.stock-history') }}">
                    <span class="sub-item">Stock History</span>
                </a>
            </li>
            <li class="{{ Route::is('report.send-report') ? 'active' : '' }}">
                <a href="{{ route('report.send-report') }}">
                    <span class="sub-item">Send Report</span>
                </a>
            </li>
        </ul>
    </div>
</li>
