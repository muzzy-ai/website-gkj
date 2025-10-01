@extends('layouts.app')
@section('title','Berita - GKJ Yeremia Depok')
@section('page_title','BERITA')

@section('content')
<div class="row g-4">
  <div class="col-lg-5">
    <h5 class="fw-bold mb-2">Berita Terbaru</h5>
    <div class="sep mb-2"></div>
    @php
      $latest = [
        ['title'=>'Bakti Sosial Wilayah I',   'url'=>route('berita.index').'#b1'],
        ['title'=>'Seminar Pemuda',           'url'=>route('berita.index').'#b2'],
        ['title'=>'Ibadah Syukur Pembangunan','url'=>route('berita.index').'#b3'],
      ];
      $kategori = [
        ['title'=>'Kategorial & Pemuda', 'url'=>route('berita.index').'#k1'],
        ['title'=>'Koinonia',            'url'=>route('berita.index').'#k2'],
        ['title'=>'Diakonia',            'url'=>route('berita.index').'#k3'],
      ];
    @endphp
    <div class="list-thin mb-4">
      @foreach ($latest as $i)
        <a href="{{ $i['url'] }}" class="text-decoration-none"><div class="item"><span>{{ $i['title'] }}</span><span class="ms-3">&gt;</span></div></a>
      @endforeach
    </div>

    <h5 class="fw-bold mb-2 mt-4">Kategori</h5>
    <div class="sep mb-2"></div>
    <div class="list-thin">
      @foreach ($kategori as $i)
        <a href="{{ $i['url'] }}" class="text-decoration-none"><div class="item"><span>{{ $i['title'] }}</span><span class="ms-3">&gt;</span></div></a>
      @endforeach
    </div>
  </div>

  <div class="col-lg-7">
    <div class="panel shadow-sm rounded">
      <div class="panel-title text-center">Judul Berita</div>
      <div class="p-3">
        <div class="subline mb-2">Kategori: Koinonia • Dipublikasikan: 17 Sept 2025</div>
        <div class="sep mb-3"></div>
        <p>Isi berita dummy… Lorem ipsum dolor sit amet, consectetur adipiscing elit…</p>
        <p class="mb-0">Selengkapnya akan diambil dari database.</p>
      </div>
    </div>
  </div>
</div>
@endsection
