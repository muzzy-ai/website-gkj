@if (session('ok'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('ok') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger">
    <div class="fw-bold mb-1">Ada error:</div>
    <ul class="mb-0">
      @foreach ($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif
