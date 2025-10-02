@extends('admin.layouts.app')
@section('title','Dashboard')

@section('content')
<div class="row g-3">
  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="small text-muted">Renungan</div>
        <div class="h4 mb-0">{{ \App\Models\Renungan::count() }}</div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="small text-muted">Berita</div>
        <div class="h4 mb-0">{{ \App\Models\Berita::count() }}</div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="small text-muted">Agenda</div>
        <div class="h4 mb-0">{{ \App\Models\AgendaItem::count() }}</div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="small text-muted">Informasi</div>
        <div class="h4 mb-0">{{ \App\Models\Informasi::count() }}</div>
      </div>
    </div>
  </div>
</div>
@endsection
