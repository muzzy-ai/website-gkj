@extends('layouts.app')
@section('title','Warta Jemaat - GKJ Yeremia Depok')
@section('page_title','WARTA JEMAAT')

@section('content')
<div class="row g-4">
  <div class="col-lg-5">
    <h5 class="fw-bold mb-2">Edisi Terbaru</h5>
    <div class="sep mb-2"></div>
    @php
      $edisi = [
        ['title'=>'Warta Minggu 01', 'url'=>route('warta.index').'#w1'],
        ['title'=>'Warta Minggu 02', 'url'=>route('warta.index').'#w2'],
        ['title'=>'Warta Minggu 03', 'url'=>route('warta.index').'#w3'],
      ];
      $arsip = [
        ['title'=>'Warta Agustus', 'url'=>route('warta.index').'#a1'],
        ['title'=>'Warta Juli',    'url'=>route('warta.index').'#a2'],
        ['title'=>'Warta Juni',    'url'=>route('warta.index').'#a3'],
      ];
    @endphp
    <div class="list-thin mb-4">
      @foreach ($edisi as $i)
        <a href="{{ $i['url'] }}" class="text-decoration-none"><div class="item"><span>{{ $i['title'] }}</span><span class="ms-3">&gt;</span></div></a>
      @endforeach
    </div>

    <h5 class="fw-bold mb-2 mt-4">Arsip Warta</h5>
    <div class="sep mb-2"></div>
    <div class="list-thin">
      @foreach ($arsip as $i)
        <a href="{{ $i['url'] }}" class="text-decoration-none"><div class="item"><span>{{ $i['title'] }}</span><span class="ms-3">&gt;</span></div></a>
      @endforeach
    </div>
  </div>

  <div class="col-lg-7">
    <div class="panel shadow-sm rounded">
      <div class="panel-title text-center">Warta Minggu</div>
      <div class="p-3">
        <div class="subline mb-2">Tanggal: Minggu, 17 Sept 2025</div>
        <div class="sep mb-3"></div>
        <p>Ringkasan pengumuman, agenda ibadah, persembahan, dan informasi pelayanan…</p>
        <p class="mb-0">Hubungi sekretariat untuk info lebih lanjut.</p>
      </div>
    </div>
  </div>
</div>
@endsection
