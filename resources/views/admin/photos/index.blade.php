@extends('admin.layouts.app')
@section('title','Foto')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="m-0">Foto</h4>
  <a href="{{ route('admin.photos.create') }}" class="btn btn-maroon">+ Upload</a>
</div>

<form class="row g-2 mb-3" method="GET" action="{{ route('admin.photos.index') }}">
  <div class="col-md-4">
    <select name="album_id" class="form-select" onchange="this.form.submit()">
      <option value="">— Semua Album —</option>
      @foreach ($albums as $a)
        <option value="{{ $a->id }}" @selected(request('album_id')==$a->id)>{{ $a->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-2">
    <button class="btn btn-outline-secondary w-100">Terapkan</button>
  </div>
</form>

@if($items->count())
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row g-3">
        @foreach ($items as $p)
          <div class="col-6 col-md-3 col-lg-2">
            <div class="border rounded p-1 h-100 d-flex flex-column">
              <a href="{{ Storage::url($p->path) }}" target="_blank">
                <img src="{{ Storage::url($p->path) }}" class="img-fluid rounded" alt="Foto">
              </a>
              <div class="small text-muted mt-1 flex-grow-1">
                {{ $p->album?->name ?? '—' }}
              </div>
              <form action="{{ route('admin.photos.destroy',$p) }}" method="POST" class="mt-2"
                    onsubmit="return confirm('Hapus foto ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger w-100">Hapus</button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="mt-3">
    {{ $items->links() }}
  </div>
@else
  <div class="card shadow-sm">
    <div class="card-body text-center text-muted">Belum ada foto.</div>
  </div>
@endif
@endsection
