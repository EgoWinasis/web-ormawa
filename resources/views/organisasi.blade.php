@extends('layout.main')

@section('title', 'Organisasi')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Organisasi Mahasiswa</h2>

    <!-- Dropdown Pilihan Organisasi -->
    <div class="mb-4 text-center">
        <select id="organisasiDropdown" class="form-select w-50 mx-auto">
            <option value="">-- Pilih Organisasi --</option>
            @foreach ($user as $u)
                @if ($u->nama_organisasi !== 'kesiswaan')
                    <option value="{{ Str::slug($u->nama_organisasi) }}">{{ $u->nama_organisasi }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <!-- Card Organisasi -->
    @foreach ($user as $u)
        @if ($u->nama_organisasi !== 'kesiswaan')
            <div class="card mb-4 shadow-sm organisasi-card" 
                 id="card-{{ Str::slug($u->nama_organisasi) }}" 
                 style="display: none;">
                <div class="card-body">
                    <div class="row text-center align-items-center">
                        
                        <!-- Kolom Visi -->
                        <div class="col-md-4 mb-3">
                            <div class="border rounded p-3 h-100">
                                <h5 class="fw-bold">Visi</h5>
                                <p class="text-justify mb-0">{{ $u->visi }}</p>
                            </div>
                        </div>

                        <!-- Kolom Logo -->
                        <div class="col-md-4 mb-3">
                            <img src="storage/{{ $u->foto }}" 
                                 alt="Logo {{ $u->nama_organisasi }}" 
                                 class="img-fluid mx-auto d-block" 
                                 style="max-width: 200px;">
                            <h5 class="mt-3">{{ $u->nama_organisasi }}</h5>
                        </div>

                        <!-- Kolom Misi -->
                        <div class="col-md-4 mb-3">
                            <div class="border rounded p-3 h-100">
                                <h5 class="fw-bold">Misi</h5>
                                <p class="text-justify mb-0">{{ $u->misi }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<script>
    document.getElementById('organisasiDropdown').addEventListener('change', function () {
        const selected = this.value;
        const cards = document.querySelectorAll('.organisasi-card');

        cards.forEach(card => {
            if (selected === "") {
                card.style.display = "none";
            } else {
                card.style.display = card.id === "card-" + selected ? "block" : "none";
            }
        });
    });
</script>
@endsection
