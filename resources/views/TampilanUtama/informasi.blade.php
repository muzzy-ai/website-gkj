@extends('layouts.app')
@section('title','Informasi - GKJ Yeremia Depok')
@section('page_title','Informasi')

@section('content')
<div class="row g-4">
  <div class="col-lg-5">
    <h5 class="fw-bold mb-2">Informasi Lainnya</h5>
    <div class="sep mb-2"></div>

    @php
      $lainnya = [
        ['title'=>'informasi 1', 'url'=> route('informasi.show',['id'=>1])],
        ['title'=>'informasi 2', 'url'=> route('informasi.show',['id'=>2])],
        ['title'=>'informasi 3', 'url'=> route('informasi.show',['id'=>3])],
      ];
    @endphp

    <div class="list-thin">
      @foreach ($lainnya as $i)
        <a href="{{ $i['url'] }}" class="text-decoration-none">
          <div class="item"><span>{{ $i['title'] }}</span><span class="ms-3">&gt;</span></div>
        </a>
      @endforeach
    </div>
  </div>

  <div class="col-lg-7">
    <div class="panel shadow-sm rounded">
      <div class="panel-title">Judul Informasi</div>
      <div class="p-3">
        <div class="subline mb-2"><strong>Minggu, 17 september 2025</strong></div>
        <div class="sep mb-3"></div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
        <p>Nulla tincidunt luctus mauris, nec vestibulum nisi...</p>
        <p class="mb-0">Etiam at eros in lectus gravida ultrices vitae id ligula...</p>
      </div>
    </div>
  </div>
</div>
@endsection
