<li class="nav-item {{ Route::is('entry.*') || Route::is('sale.*') || Route::is('out.*') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#base">
        <i class="fas fa-pen-alt"></i>
        <p>Manage Stock</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Route::is('entry.*') || Route::is('sale.*') || Route::is('out.*') ? 'show' : '' }}" id="base">
        <ul class="nav nav-collapse">
            <li class="{{ Route::is('entry.index') ? 'active' : '' }}">
                <a href="{{ route('entry.index') }}">
                    <span class="sub-item">Entry Unit</span>
                </a>
            </li>
            <li class="{{ Route::is('sale.index') ? 'active' : '' }}">
                <a href="{{ route('sale.index') }}">
                    <span class="sub-item">Unit Sales</span>
                </a>
            </li>
            <li class="{{ Route::is('out.index') ? 'active' : '' }}">
                <a href="{{ route('out.index') }}">
                    <span class="sub-item">Unit Out</span>
                </a>
            </li>
        </ul>
    </div>
</li>
