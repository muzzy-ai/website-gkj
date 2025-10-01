@extends('layouts.app')
@section('title','GKJ Yeremia Depok')
@section('page_title','Lorem ipsum')

@section('content')
<div class="row g-4">
  <div class="col-lg-5">
    <div class="card gallery-card shadow-sm border-0">
      <div class="card-header">
        Galeri Foto
        <div class="small text-muted fw-normal">Bazar Kasih GKJ Yeremia, Depok, 21 Juni 2023</div>
      </div>
      <div class="card-body">
        <img src="{{ asset('images/galeri/foto-utama.jpg') }}" class="img-fluid rounded" alt="Galeri Foto">
      </div>
    </div>

    <div class="mt-4">
      <h5 class="fw-bold mb-2">Informasi Terbaru</h5>
      <div class="sep mb-2"></div>
      <div class="latest-list">
        @php
          $items = [
            ['title' => 'informasi 1', 'url' => route('informasi.show', ['id' => 1])],
            ['title' => 'informasi 2', 'url' => route('informasi.show', ['id' => 2])],
            ['title' => 'informasi 3', 'url' => route('informasi.show', ['id' => 3])],
          ];
        @endphp
        @foreach ($items as $item)
          <a href="{{ $item['url'] }}" class="text-decoration-none">
            <div class="item">
              <span>{{ $item['title'] }}</span>
              <span class="ms-3">&gt;</span>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>

  <div class="col-lg-7">
    <div class="card shadow-sm border-0">
      <div class="card-body">
        <h4 class="fw-bold text-center mb-3">Judul Informasi</h4>
        <div class="sep mb-3"></div>
        <p>...</p><p>...</p><p>...</p><p>...</p>
        <p class="mb-0">...</p>
      </div>
    </div>
  </div>
</div>
@endsection
