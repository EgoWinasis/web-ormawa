@extends('admin.layoutadmin.main')
@section('konten')
    <div id="dashboard" class="container-dashboard d-flex active">
        
        <div class="box-container">
            <h2>{{ count($anggota) }}</h2>
            <p>Total Anggota</p>
        </div>
        <div class="box-container">
            <h2>{{ count($kegiatan) }}</h2>
            <p>Total Arsip</p>
        </div>
        <div class="box-container">
            @php
                $count = 0;
            @endphp
            @foreach ($kegiatan as $item)
                @isset($item->lpj)
                    @php
                        $count++;
                    @endphp
                @endisset
            @endforeach
            <h2>{{ $count }}</h2>
            <p>Total News</p>
        </div>
    </div>
@endsection
