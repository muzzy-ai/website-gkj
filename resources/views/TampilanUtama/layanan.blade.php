@extends('layouts.app')
@section('title','Layanan Jemaat - GKJ Yeremia Depok')
@section('page_title','LAYANAN JEMAAT')

@section('content')
<div class="row g-4">
  <div class="col-lg-5">
    <h5 class="fw-bold mb-2">Daftar Layanan</h5>
    <div class="sep mb-2"></div>
    @php
      $layanan = [
        ['title'=>'Baptis Anak',     'url'=>route('layanan').'#l1'],
        ['title'=>'Pernikahan Kudus','url'=>route('layanan').'#l2'],
        ['title'=>'Konseling',       'url'=>route('layanan').'#l3'],
      ];
      $dokumen = [
        ['title'=>'Formulir Permohonan', 'url'=>route('layanan').'#d1'],
        ['title'=>'Ketentuan Umum',     'url'=>route('layanan').'#d2'],
      ];
    @endphp
    <div class="list-thin mb-4">
      @foreach ($layanan as $i)
        <a href="{{ $i['url'] }}" class="text-decoration-none"><div class="item"><span>{{ $i['title'] }}</span><span class="ms-3">&gt;</span></div></a>
      @endforeach
    </div>

    <h5 class="fw-bold mb-2 mt-4">Dokumen</h5>
    <div class="sep mb-2"></div>
    <div class="list-thin">
      @foreach ($dokumen as $i)
        <a href="{{ $i['url'] }}" class="text-decoration-none"><div class="item"><span>{{ $i['title'] }}</span><span class="ms-3">&gt;</span></div></a>
      @endforeach
    </div>
  </div>

  <div class="col-lg-7">
    <div class="panel shadow-sm rounded">
      <div class="panel-title text-center">Informasi Layanan</div>
      <div class="p-3">
        <div class="subline mb-2">Prosedur & Jadwal</div>
        <div class="sep mb-3"></div>
        <p>Penjelasan umum mengenai cara pendaftaran, syarat, dan jadwal layanan…</p>
        <p class="mb-0">Kontak sekretariat untuk pendaftaran.</p>
      </div>
    </div>
  </div>
</div>
@endsection
