@extends('layouts.app')
@section('title','Renungan - GKJ Yeremia Depok')
@section('page_title','RENUNGAN')

@section('content')
<div class="row g-4">
  <div class="col-lg-5">
    <h5 class="fw-bold mb-2">Renungan Terbaru</h5>
    <div class="sep mb-2"></div>
    @php
      $latest = [
        ['title'=>'Hidup Dalam Kasih', 'url'=>route('renungan.index').'#1'],
        ['title'=>'Harap Pada Tuhan',   'url'=>route('renungan.index').'#2'],
        ['title'=>'Syukur Dalam Lelah', 'url'=>route('renungan.index').'#3'],
      ];
      $arsip = [
        ['title'=>'Renungan Pagi',  'url'=>route('renungan.index').'#a1'],
        ['title'=>'Renungan Malam', 'url'=>route('renungan.index').'#a2'],
        ['title'=>'Keluarga',       'url'=>route('renungan.index').'#a3'],
      ];
    @endphp
    <div class="list-thin mb-4">
      @foreach ($latest as $i)
        <a href="{{ $i['url'] }}" class="text-decoration-none">
          <div class="item"><span>{{ $i['title'] }}</span><span class="ms-3">&gt;</span></div>
        </a>
      @endforeach
    </div>

    <h5 class="fw-bold mb-2 mt-4">Arsip Renungan</h5>
    <div class="sep mb-2"></div>
    <div class="list-thin">
      @foreach ($arsip as $i)
        <a href="{{ $i['url'] }}" class="text-decoration-none">
          <div class="item"><span>{{ $i['title'] }}</span><span class="ms-3">&gt;</span></div>
        </a>
      @endforeach
    </div>
  </div>

  <div class="col-lg-7">
    <div class="panel shadow-sm rounded">
      <div class="panel-title text-center">Judul Renungan</div>
      <div class="p-3">
        <div class="subline mb-2">Bacaan: Mazmur 23 | <em>Minggu, 17 Sept 2025</em></div>
        <div class="sep mb-3"></div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere…</p>
        <p>Sed non magna a risus pulvinar viverra. Nunc in dui et mauris aliquet…</p>
        <p class="mb-0">Amin.</p>
      </div>
    </div>
  </div>
</div>
@endsection
