@extends('admin.layouts.app')
@section('title','Renungan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="m-0">Renungan</h4>
  <a href="{{ route('admin.renungans.create') }}" class="btn btn-maroon">+ Tambah</a>
</div>

<form class="row g-2 mb-3" method="GET" action="{{ route('admin.renungans.index') }}">
  <div class="col-md-4">
    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari judul…">
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
          <th width="130">Status</th>
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
          <td>
            @php
              $map = ['draft'=>'secondary','published'=>'success','archived'=>'dark'];
            @endphp
            <span class="badge bg-{{ $map[$it->status] ?? 'secondary' }} badge-status">
              {{ ucfirst($it->status) }}
            </span>
          </td>
          <td>{{ $it->published_at?->format('d M Y H:i') ?? '—' }}</td>
          <td class="text-end">
            <a href="{{ route('admin.renungans.edit',$it) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="{{ route('admin.renungans.destroy',$it) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin hapus?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">
  {{ $items->links() }}
</div>
@endsection
