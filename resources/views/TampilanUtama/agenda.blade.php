@extends('layouts.app')
@section('title','Agenda & Kegiatan - GKJ Yeremia Depok')
@section('page_title','AGENDA & KEGIATAN')

@section('content')
<div class="row g-4">
  <div class="col-lg-5">
    <h5 class="fw-bold mb-2">Informasi Terbaru</h5>
    <div class="sep mb-2"></div>

    @php
      $terbaru = [
        ['title'=>'informasi 1', 'url'=> route('informasi.show',['id'=>1])],
        ['title'=>'informasi 2', 'url'=> route('informasi.show',['id'=>2])],
        ['title'=>'informasi 3', 'url'=> route('informasi.show',['id'=>3])],
      ];
      $sebelumnya = [
        ['title'=>'Agenda & Kegiatan 1', 'url'=> route('agenda.show',['id'=>1])],
        ['title'=>'Agenda & Kegiatan 2', 'url'=> route('agenda.show',['id'=>2])],
        ['title'=>'Agenda & Kegiatan 3', 'url'=> route('agenda.show',['id'=>3])],
      ];
    @endphp

    <div class="list-thin mb-4">
      @foreach ($terbaru as $i)
        <a href="{{ $i['url'] }}" class="text-decoration-none">
          <div class="item"><span>{{ $i['title'] }}</span><span class="ms-3">&gt;</span></div>
        </a>
      @endforeach
    </div>

    <h5 class="fw-bold mb-2 mt-4">Agenda &amp; Kegiatan Sebelumnya</h5>
    <div class="sep mb-2"></div>
    <div class="list-thin">
      @foreach ($sebelumnya as $r)
        <a href="{{ $r['url'] }}" class="text-decoration-none">
          <div class="item"><span>{{ $r['title'] }}</span><span class="ms-3">&gt;</span></div>
        </a>
      @endforeach
    </div>
  </div>

  <div class="col-lg-7">
    <div class="panel shadow-sm rounded">
      <div class="panel-title text-center">Agenda &amp; Kegiatan</div>
      <div class="p-3">
        <div class="sep mb-3"></div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
        <p>Nulla tincidunt luctus mauris, nec vestibulum nisi...</p>
        <p class="mb-0">Etiam at eros in lectus gravida ultrices vitae id ligula...</p>
      </div>
    </div>
  </div>
</div>
@endsection
