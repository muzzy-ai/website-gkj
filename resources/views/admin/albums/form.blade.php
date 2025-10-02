@extends('admin.layouts.app')
@section('title', ($item->exists ? 'Edit' : 'Tambah') . ' Album')

@section('content')
<h4 class="mb-3">{{ $item->exists ? 'Edit' : 'Tambah' }} Album</h4>

<form method="POST"
      action="{{ $item->exists ? route('admin.albums.update',$item) : route('admin.albums.store') }}"
      class="row g-3">
  @csrf
  @if($item->exists) @method('PUT') @endif

  <div class="col-lg-8">
    <div class="card shadow-sm mb-3">
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Nama Album</label>
          <input type="text" name="name" class="form-control" value="{{ old('name',$item->name) }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi (opsional)</label>
          <textarea name="description" rows="4" class="form-control">{{ old('description',$item->description) }}</textarea>
        </div>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-body d-flex gap-2">
        <button class="btn btn-maroon px-4">{{ $item->exists ? 'Simpan Perubahan' : 'Simpan' }}</button>
        <a href="{{ route('admin.albums.index') }}" class="btn btn-outline-secondary">Kembali</a>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="alert alert-info">
      Setelah membuat album, upload foto melalui menu <strong>Foto</strong>.
    </div>
  </div>
</form>
@endsection
