@extends('admin.layouts.app')
@section('title','Layanan Jemaat')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="m-0">Layanan Jemaat</h4>
  <a href="{{ route('admin.layanans.create') }}" class="btn btn-maroon">+ Tambah</a>
</div>

<form class="row g-2 mb-3" method="GET" action="{{ route('admin.layanans.index') }}">
  <div class="col-md-4">
    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari layanan…">
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
          <th>Nama Layanan</th>
          <th>Deskripsi</th>
          <th width="130">Status</th>
          <th width="140"></th>
        </tr>
      </thead>
      <tbody>
      @forelse ($items as $it)
        <tr>
          <td>{{ $it->id }}</td>
          <td class="fw-semibold">{{ $it->title }}</td>
          <td class="text-muted small">{{ Str::limit($it->description,50) }}</td>
          <td>
            <span class="badge bg-{{ $it->status==='active'?'success':'secondary' }}">
              {{ ucfirst($it->status) }}
            </span>
          </td>
          <td class="text-end">
            <a href="{{ route('admin.layanans.edit',$it) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="{{ route('admin.layanans.destroy',$it) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin hapus layanan ini?')">
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
