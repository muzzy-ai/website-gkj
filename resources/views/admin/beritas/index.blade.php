@extends('admin.layouts.app')
@section('title','Berita')

@section('content')
@php
  // Daftar kategori (silakan sesuaikan dengan kebutuhanmu / ambil dari DB)
  $categories = [
    'umum' => 'Umum',
    'koinonia' => 'Koinonia',
    'diakonia' => 'Diakonia',
    'marturia' => 'Marturia',
    'pemuda' => 'Pemuda',
    'remaja' => 'Remaja',
    'anak' => 'Anak',
  ];
@endphp

<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="m-0">Berita</h4>
  <a href="{{ route('admin.beritas.create') }}" class="btn btn-maroon">+ Tambah</a>
</div>

<form class="row g-2 mb-3" method="GET" action="{{ route('admin.beritas.index') }}">
  <div class="col-md-4">
    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari judul…">
  </div>
  <div class="col-md-3">
    <select name="category" class="form-select">
      <option value="">— Semua Kategori —</option>
      @foreach ($categories as $val=>$label)
        <option value="{{ $val }}" @selected(request('category')===$val)>{{ $label }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <select name="status" class="form-select">
      <option value="">— Semua Status —</option>
      @foreach (['draft'=>'Draft','published'=>'Published','archived'=>'Archived'] as $val=>$label)
        <option value="{{ $val }}" @selected(request('status')===$val)>{{ $label }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-2">
    <button class="btn btn-outline-secondary w-100">Filter</button>
  </div>
</form>

<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th width="60">ID</th>
          <th>Judul</th>
          <th width="140">Kategori</th>
          <th width="120">Status</th>
          <th width="170">Published At</th>
          <th width="140"></th>
        </tr>
      </thead>
      <tbody>
      @forelse ($items as $it)
        <tr>
          <td>{{ $it->id }}</td>
          <td>
            <div class="fw-semibold">{{ $it->title }}</div>
            <div class="text-muted small">{{ $it->slug }}</div>
          </td>
          <td>{{ $categories[$it->category] ?? ucfirst($it->category ?? '—') }}</td>
          <td>
            @php $map = ['draft'=>'secondary','published'=>'success','archived'=>'dark']; @endphp
            <span class="badge bg-{{ $map[$it->status] ?? 'secondary' }} badge-status">
              {{ ucfirst($it->status) }}
            </span>
          </td>
          <td>{{ $it->published_at?->format('d M Y H:i') ?? '—' }}</td>
          <td class="text-end">
            <a href="{{ route('admin.beritas.edit',$it) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="{{ route('admin.beritas.destroy',$it) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin hapus?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center text-muted">Belum ada data.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">
  {{ $items->links() }}
</div>
@endsection
