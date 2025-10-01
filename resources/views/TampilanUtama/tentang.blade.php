@extends('layouts.app')
@section('title','Tentang Kami - GKJ Yeremia Depok')
@section('page_title','TENTANG KAMI')

@section('content')
<div class="row g-4">
  <div class="col-lg-4">
    <div class="panel shadow-sm rounded">
      <div class="panel-title">Sejarah Singkat</div>
      <div class="p-3">
        <p>Paragraf dummy tentang sejarah GKJ Yeremia Depok…</p>
        <p class="mb-0">Tahun berdiri, tonggak pelayanan, dll.</p>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="panel shadow-sm rounded">
      <div class="panel-title">Visi & Misi</div>
      <div class="p-3">
        <ul class="mb-0">
          <li>Visi: Menjadi komunitas…</li>
          <li>Misi: Bersekutu, bersaksi, melayani…</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="panel shadow-sm rounded">
      <div class="panel-title">Kontak & Alamat</div>
      <div class="p-3">
        <p class="mb-1">Jl. Contoh No. 123, Depok</p>
        <p class="mb-1">Telp: (021) 000000</p>
        <p class="mb-0">Email: sekretariat@gkj-yeremia.test</p>
      </div>
    </div>
  </div>
</div>
@endsection
