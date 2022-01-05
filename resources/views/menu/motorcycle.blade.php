<li class="nav-item {{ Route::is('unit.index') || Route::is('unit.show') || Route::is('unit.edit') || Route::is('color.index') || Route::is('color.show') || Route::is('color.edit') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#base">
        <i class="fas fa-database"></i>
        <p>Data Master</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="base">
        <ul class="nav nav-collapse">
            <li>
                <a href="{{ route('unit.index') }}">
                    <span class="sub-item">Data Unit</span>
                </a>
            </li>
            <li>
                <a href="{{ route('color.index') }}">
                    <span class="sub-item">Data Color</span>
                </a>
            </li>
            <li>
                <a href="{{ route('leasing.index') }}">
                    <span class="sub-item">Data Leasing</span>
                </a>
            </li>
        </ul>
    </div>
</li>
