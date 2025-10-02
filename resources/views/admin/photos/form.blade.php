@extends('admin.layouts.app')
@section('title','Upload Foto')

@section('content')
<h4 class="mb-3">Upload Foto</h4>

<form method="POST" action="{{ route('admin.photos.store') }}" enctype="multipart/form-data" class="row g-3">
  @csrf

  <div class="col-lg-8">
    <div class="card shadow-sm mb-3">
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Pilih Album</label>
          <select name="album_id" class="form-select" required>
            <option value="">— Pilih Album —</option>
            @foreach ($albums as $a)
              <option value="{{ $a->id }}" @selected(old('album_id')==$a->id)>{{ $a->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">File Foto</label>
          <input type="file" name="image" class="form-control" accept="image/*" required>
          <div class="form-text">Tipe yang didukung: JPG, PNG, WebP. Maks 5–10 MB (sesuaikan validator).</div>
        </div>

        <div class="mb-0">
          <label class="form-label">Caption (opsional)</label>
          <input type="text" name="caption" class="form-control" value="{{ old('caption') }}" placeholder="Keterangan singkat foto">
        </div>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-body d-flex gap-2">
        <button class="btn btn-maroon px-4">Upload</button>
        <a href="{{ route('admin.photos.index') }}" class="btn btn-outline-secondary">Kembali</a>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="alert alert-info">
      Gunakan resolusi yang cukup (≥ 1200px lebar) supaya tampilan galeri di publik terlihat tajam.
    </div>
  </div>
</form>
@endsection
