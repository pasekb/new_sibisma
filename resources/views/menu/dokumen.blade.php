<li class="nav-item {{ Route::is('document.index') || Route::is('document.show') || Route::is('document.edit') ? 'active' : '' }}">
    <a href="{{ route('document.index') }}">
        <i class="fas fa-book"></i>
        <p>Dokumen</p>
    </a>
</li>