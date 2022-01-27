<li class="nav-item {{ Route::is('dashboard') || Route::is('search') ? 'active' : '' }}">
    <a href="{{ route('dashboard') }}">
        <i class="far fa-chart-bar"></i>
        <p>Dashboard</p>
    </a>
</li>
