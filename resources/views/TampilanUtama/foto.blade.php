@extends('layouts.app')
@section('title','Foto - GKJ Yeremia Depok')
@section('page_title','FOTO')

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
        ['title'=>'Nama Peristiwa 1', 'url'=> route('foto.show',['id'=>1])],
        ['title'=>'Nama Peristiwa 2', 'url'=> route('foto.show',['id'=>2])],
        ['title'=>'Nama Peristiwa 3', 'url'=> route('foto.show',['id'=>3])],
      ];
    @endphp

    <div class="list-thin mb-4">
      @foreach ($terbaru as $i)
        <a href="{{ $i['url'] }}" class="text-decoration-none">
          <div class="item"><span>{{ $i['title'] }}</span><span class="ms-3">&gt;</span></div>
        </a>
      @endforeach
    </div>

    <h5 class="fw-bold mb-2 mt-4">Foto sebelumnya</h5>
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
    <div class="rounded shadow-sm p-3 position-relative" style="background:#5a1812;color:#fff;border:1px solid #71281f;">
      <div class="text-center fw-bold" style="font-family:Georgia, 'Times New Roman', serif; font-size:1.25rem;">Nama Peristiwa</div>
      <div class="text-center" style="color:#f1dfc7;">Tanggal Peristiwa</div>
      <div style="height:1px;background:#e1c59c;opacity:.6;margin:.4rem 1rem 1rem;"></div>

      <div class="position-relative px-2">
        <div class="position-absolute" style="top:50%;left:-18px;transform:translateY(-50%);width:28px;height:28px;border:1px solid #e1c59c;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;">&lt;</div>
        <div class="position-absolute" style="top:50%;right:-18px;transform:translateY(-50%);width:28px;height:28px;border:1px solid #e1c59c;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;">&gt;</div>
        <img src="{{ asset('images/galeri/foto-utama.jpg') }}" alt="Foto Peristiwa" class="img-fluid rounded" style="border:1px solid #e1c59c;">
      </div>

      <div style="color:#f4e6cf;" class="mt-2">Keterangan lanjutan foto</div>
    </div>
  </div>
</div>
@endsection
