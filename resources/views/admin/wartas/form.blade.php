@extends('admin.layouts.app')
@section('title', ($item->exists ? 'Edit' : 'Tambah') . ' Warta Jemaat')

@section('content')
<h4 class="mb-3">{{ $item->exists ? 'Edit' : 'Tambah' }} Warta Jemaat</h4>

<form method="POST"
      action="{{ $item->exists ? route('admin.wartas.update',$item) : route('admin.wartas.store') }}"
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

        <div class="mb-3">
          <label class="form-label">Isi Warta</label>
          <textarea name="body" rows="10" class="form-control" required>{{ old('body',$item->body) }}</textarea>
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
        <a href="{{ route('admin.wartas.index') }}" class="btn btn-outline-secondary">Kembali</a>
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

    <div class="card shadow-sm">
      <div class="card-body">
        <div class="mb-2"><strong>SEO</strong></div>
        <div class="mb-3">
          <label class="form-label">Meta Title</label>
          <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title',$item->meta_title) }}">
        </div>
        <div class="mb-0">
          <label class="form-label">Meta Description</label>
          <textarea name="meta_description" rows="3" class="form-control">{{ old('meta_description',$item->meta_description) }}</textarea>
        </div>
      </div>
    </div>

  </div>
</form>
@endsection
