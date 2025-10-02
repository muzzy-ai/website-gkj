@extends('admin.layouts.app')
@section('title', ($item->exists ? 'Edit' : 'Tambah') . ' Agenda')

@section('content')
<h4 class="mb-3">{{ $item->exists ? 'Edit' : 'Tambah' }} Agenda &amp; Kegiatan</h4>

<form method="POST"
      action="{{ $item->exists ? route('admin.agenda-items.update',$item) : route('admin.agenda-items.store') }}"
      enctype="multipart/form-data" class="row g-3">
  @csrf
  @if($item->exists) @method('PUT') @endif

  <div class="col-lg-8">
    <div class="card shadow-sm mb-3">
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Judul</label>
          <input type="text" name="title" class="form-control" value="{{ old('title',$item->title) }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Slug (opsional)</label>
          <input type="text" name="slug" class="form-control" value="{{ old('slug',$item->slug) }}">
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Mulai</label>
            <input type="datetime-local" name="start_at" class="form-control"
                   value="{{ old('start_at', optional($item->start_at)->format('Y-m-d\TH:i')) }}" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Selesai</label>
            <input type="datetime-local" name="end_at" class="form-control"
                   value="{{ old('end_at', optional($item->end_at)->format('Y-m-d\TH:i')) }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Lokasi</label>
          <input type="text" name="location" class="form-control" value="{{ old('location',$item->location) }}">
        </div>

        <div class="mb-3">
          <label class="form-label">Isi Agenda</label>
          <textarea name="body" rows="8" class="form-control" required>{{ old('body',$item->body) }}</textarea>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
              @foreach (['draft'=>'Draft','published'=>'Published','archived'=>'Archived'] as $v=>$l)
                <option value="{{ $v }}" @selected(old('status',$item->status)===$v)>{{ $l }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Tanggal Publish (opsional)</label>
            <input type="datetime-local" name="published_at" class="form-control"
                   value="{{ old('published_at', optional($item->published_at)->format('Y-m-d\TH:i')) }}">
          </div>
        </div>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-body d-flex gap-2">
        <button class="btn btn-maroon px-4">{{ $item->exists ? 'Simpan Perubahan' : 'Simpan' }}</button>
        <a href="{{ route('admin.agenda-items.index') }}" class="btn btn-outline-secondary">Kembali</a>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card shadow-sm mb-3">
      <div class="card-body">
        <label class="form-label">Cover (opsional)</label>
        <input type="file" name="cover" class="form-control" accept="image/*">
        @if($item->cover_path)
          <img src="{{ Storage::url($item->cover_path) }}" class="img-fluid rounded mt-2" alt="Cover">
        @endif
      </div>
    </div>
  </div>
</form>
@endsection
