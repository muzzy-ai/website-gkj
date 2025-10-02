<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin | GKJ Yeremia Depok')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{
      --maroon:#6e1e16;
      --maroon-dark:#5a1812;
      --gold:#d4af37;
      --cream:#f6ede3;
      --sep:#e3d3bf;
    }
    body{ background:#faf7f1; }
    .admin-topbar{ background:var(--maroon); color:#fff; }
    .admin-topbar .brand{ font-weight:700; letter-spacing:.4px; }
    .admin-sidebar{
      background:#fff; border-right:1px solid var(--sep); min-height:100vh;
    }
    .admin-sidebar .nav-link{ color:#4b2f23; font-weight:600; }
    .admin-sidebar .nav-link.active{ background: #f3e7d2; border-left:4px solid var(--maroon); }
    .content-wrap{ padding: 1.25rem; }
    .btn-maroon{ background:var(--maroon); color:#fff; }
    .btn-maroon:hover{ background:var(--maroon-dark); color:#fff; }
    .table thead th{ background:#fff7e8; }
    .badge-status{ font-weight:600; }
  </style>
  @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

  {{-- TOPBAR --}}
  <nav class="admin-topbar navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand text-white brand" href="{{ route('admin.dashboard') }}">GKJ Admin</a>
      <div class="ms-auto d-flex align-items-center gap-3">
        <span class="small">Halo, {{ auth()->user()->name ?? 'Admin' }}</span>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="btn btn-sm btn-outline-light">Logout</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">

      {{-- SIDEBAR --}}
      <aside class="admin-sidebar col-12 col-md-3 col-lg-2 p-0">
        @include('admin.partials.sidebar')
      </aside>

      {{-- CONTENT --}}
      <main class="col-12 col-md-9 col-lg-10">
        <div class="content-wrap">
          @include('admin.partials.flash')
          @yield('content')
        </div>
      </main>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
