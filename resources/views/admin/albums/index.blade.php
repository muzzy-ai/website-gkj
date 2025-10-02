@extends('admin.layouts.app')
@section('title','Album')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="m-0">Album</h4>
  <a href="{{ route('admin.albums.create') }}" class="btn btn-maroon">+ Tambah</a>
</div>

<form class="row g-2 mb-3" method="GET" action="{{ route('admin.albums.index') }}">
  <div class="col-md-4">
    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama album…">
  </div>
  <div class="col-md-2">
    <button class="btn btn-outline-secondary w-100">Cari</button>
  </div>
</form>

<div class="card shadow-sm">
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th width="60">ID</th>
          <th>Nama</th>
          <th>Deskripsi</th>
          <th width="140" class="text-end"></th>
        </tr>
      </thead>
      <tbody>
      @php use Illuminate\Support\Str; @endphp
      @forelse ($items as $it)
        <tr>
          <td>{{ $it->id }}</td>
          <td class="fw-semibold">{{ $it->name }}</td>
          <td class="text-muted small">{{ Str::limit($it->description, 80) }}</td>
          <td class="text-end">
            <a href="{{ route('admin.albums.edit',$it) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="{{ route('admin.albums.destroy',$it) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin hapus album ini? Foto di album tidak ikut terhapus.')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="4" class="text-center text-muted">Belum ada album.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="mt-3">
  {{ $items->links() }}
</div>
@endsection
