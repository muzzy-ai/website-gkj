@extends('admin.layouts.app')
@section('title', ($item->exists ? 'Edit' : 'Tambah') . ' Layanan Jemaat')

@section('content')
<h4 class="mb-3">{{ $item->exists ? 'Edit' : 'Tambah' }} Layanan Jemaat</h4>

<form method="POST"
      action="{{ $item->exists ? route('admin.layanans.update',$item) : route('admin.layanans.store') }}"
      enctype="multipart/form-data" class="row g-3">
  @csrf
  @if($item->exists) @method('PUT') @endif

  <div class="col-lg-8">
    <div class="card shadow-sm mb-3">
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Nama Layanan</label>
          <input type="text" name="title" class="form-control" value="{{ old('title',$item->title) }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="description" rows="6" class="form-control" required>{{ old('description',$item->description) }}</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select">
            <option value="active" @selected(old('status',$item->status)=='active')>Aktif</option>
            <option value="inactive" @selected(old('status',$item->status)=='inactive')>Tidak Aktif</option>
          </select>
        </div>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-body d-flex gap-2">
        <button class="btn btn-maroon px-4">{{ $item->exists ? 'Simpan Perubahan' : 'Simpan' }}</button>
        <a href="{{ route('admin.layanans.index') }}" class="btn btn-outline-secondary">Kembali</a>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card shadow-sm mb-3">
      <div class="card-body">
        <label class="form-label">Icon / Gambar (opsional)</label>
        <input type="file" name="icon" class="form-control" accept="image/*">
        @if($item->icon_path)
          <img src="{{ Storage::url($item->icon_path) }}" class="img-fluid rounded mt-2" alt="Icon">
        @endif
      </div>
    </div>
  </div>
</form>
@endsection
