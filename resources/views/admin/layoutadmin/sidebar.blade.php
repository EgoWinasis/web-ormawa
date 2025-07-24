<div class="sidebar">
    <div class="link-bar d-flex">
        <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined">home</span>Dashboard
            </a>
        </li>
        <li class="{{ Route::is('admin.news') ? 'active' : '' }}">
            <a href="{{ route('admin.news') }}">
                <span class="material-symbols-outlined">campaign</span>NEWS
            </a>
        </li>
        <li class="{{ Route::is('admin.arsip') ? 'active' : '' }}">
            <a href="{{ route('admin.arsip') }}">
                <span class="material-symbols-outlined">bookmark</span>Arsip
            </a>
        </li>
        @if ($user->nama_organisasi == 'bem')
            <li class="{{ Route::is('rutin.index') ? 'active' : '' }}">
                <a href="{{ route('rutin.index') }}">
                    <span class="material-symbols-outlined">routine</span>Rutinitas
                </a>
            </li>
        @endif
        <li class="{{ Route::is('admin.absensi') ? 'active' : '' }}">
            <a href="{{ route('admin.absensi') }}">
                <span class="material-symbols-outlined">diversity_3</span>Pengurus
            </a>
        </li>
        <li class="{{ Route::is('admin.calon') ? 'active' : '' }}">
            <a href="{{ route('admin.calon') }}">
                <span class="material-symbols-outlined">inventory</span>Seleksi Administrasi
            </a>
        </li>
        <li class="{{ Route::is('admin.wawancara') ? 'active' : '' }}">
            <a href="{{ route('admin.wawancara') }}">
                <span class="material-symbols-outlined">inventory</span>Seleksi Wawancara
            </a>
        </li>
        <li class="{{ Route::is('admin.profile') ? 'active' : '' }}">
            <a href="{{ route('admin.profile') }}">
                <span class="material-symbols-outlined">person</span>Data Profile
            </a>
        </li>
    


        <li>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    style="display:flex; align-items:center; justify-content: center; color:black; border:none; background:none;">
                    <span class="material-symbols-outlined">close</span>Keluar
                </button>
            </form>
        </li>
    </div>
</div>
