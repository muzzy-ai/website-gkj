@extends('layouts.app')
@section('title','GKJ Yeremia Depok')
@section('page_title','Lorem ipsum')

@section('content')
<div class="row g-4">

  {{-- Kolom kiri --}}
  <div class="col-lg-5">

    {{-- Galeri Foto (dinamis) --}}
    <div class="card gallery-card shadow-sm border-0">
      <div class="card-header">
        Galeri Foto
        <div class="small text-muted fw-normal">
          {{-- Taruh subjudul dinamis kalau ada album/tanggal di model Photo --}}
          @if($heroPhoto && $heroPhoto->caption)
            {{ $heroPhoto->caption }}
          @else
            Bazar Kasih GKJ Yeremia, Depok
          @endif
        </div>
      </div>
      <div class="card-body">
        @php
          // Foto utama: gunakan Storage::url jika path tersimpan di disk 'public'
          $img = $heroPhoto && $heroPhoto->path
                ? Storage::url($heroPhoto->path)
                : asset('images/galeri/foto-utama.jpg'); // fallback
        @endphp
        <img src="{{ $img }}" class="img-fluid rounded" alt="Galeri Foto">
      </div>
    </div>

    {{-- Informasi Terbaru (dinamis) --}}
    <div class="mt-4">
      <h5 class="fw-bold mb-2">Informasi Terbaru</h5>
      <div class="sep mb-2"></div>

      <div class="latest-list">
        @forelse ($infos as $info)
          <a href="{{ $infoUrl($info) }}" class="text-decoration-none">
            <div class="item">
              <span>{{ $info->title }}</span>
              <span class="ms-3">&gt;</span>
            </div>
          </a>
        @empty
          <div class="text-muted">Belum ada informasi.</div>
        @endforelse
      </div>
    </div>
  </div>

  {{-- Kolom kanan --}}
  <div class="col-lg-7">
    <div class="card shadow-sm border-0">
      <div class="card-body">
        <h4 class="fw-bold text-center mb-3">
          {{ $featured?->title ?? 'Judul Informasi' }}
        </h4>
        <div class="sep mb-3"></div>

        @php
          use Illuminate\Support\Str;
          $body = $featured?->body;
          // Jika kosong, fallback paragraf dummy
          $paras = $body
            ? collect(preg_split('/\n{2,}/', strip_tags($body)))->take(5)
            : collect(['...', '...', '...', '...', '...']);
        @endphp

        @foreach ($paras as $i => $p)
          <p class="{{ $loop->last ? 'mb-0' : '' }}">
            {{ Str::limit(trim($p), 500) }}
          </p>
        @endforeach
      </div>
    </div>
  </div>

</div>
@endsection
