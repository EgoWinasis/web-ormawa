<div class="nav-container">
    <div class="nav-logo">
        <div class="logo-container">
            <img class="logo-ormawa"
                src="{{ asset('storage/file-logo/landing-page.png') }}"
                alt="Logo ORMAWA" width="200rem">
        </div>
    </div>
    <div class="nav-list">
        <a href="#beranda" class="active">Beranda</a>
        <a href="#jadwal">Jadwal Kegiatan</a>
        <div class="dropdown">
            <a class="showOrg" href="#organisasi">Organisasi</a>
            <div class="dropdown-options">
                @yield('dropdown-options')
            </div>
        </div>
    </div>
    <div class="nav-button">
        <div class="btn"><a href="/login">Masuk</a></div>
    </div>
</div>
