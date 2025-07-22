<div class="nav-container">
    <div class="nav-logo">
        <div class="logo-container">
            <img class='logo-ormawa'
                src="{{ asset('storage/file-logo/landing-page.png') }}"
                alt="poto profile" width="100px">
        </div>
    </div>

    <div class="nav-profile d-flex">
        <p class="nama">{{ $user->name }}</p>
        <div class="foto-container">
            <img class='profile-foto logo' src="{{ asset('storage/' . $user->logo) }}" alt="poto profile"
                width="100px">
        </div>
    </div>
</div>