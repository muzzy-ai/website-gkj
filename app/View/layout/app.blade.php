<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','GKJ Yeremia Depok')</title>

  {{-- Bootstrap CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Base style & theming --}}
  <style>
    :root{
      --maroon:#6e1e16;
      --cream:#f5e9c9;
      --cream-soft:#f7f0dc;
      --brown:#7d4f3a;
      --sep:#cdb9a3;
    }
    body{ background: var(--cream-soft); }

    .hero{
      background:
        linear-gradient(rgba(110,30,22,.75),rgba(110,30,22,.75)),
        url("{{ asset('images/hero.jpg') }}") center/cover no-repeat;
      color:#fff;
    }
    .menu-strip{ background: var(--maroon); }
    .menu-strip .nav-link{ color:#f8efe7 !important; font-weight:600; padding:.65rem 1rem; }
    .menu-strip .nav-link:hover{ text-decoration:underline; }
    .menu-strip .nav-link.active{ background: rgba(255,255,255,.12); border-radius:.25rem; }

    .page-band{ background: var(--cream); }
    .section-title{ color:#6b3a24; font-family: Georgia, "Times New Roman", serif; }

    .sep{ height:1px; background:#cdb9a3; width:100%; }
    .list-thin .item{
      border-bottom:1px solid #cdb9a3; padding:.55rem 0;
      display:flex; align-items:center; justify-content:space-between; color:#613c2a; font-weight:600;
    }
    .list-thin .item:first-child{ border-top:1px solid #cdb9a3; }

    .panel{ background:#f2e6c7; border:1px solid #eadcb9; }
    .panel .panel-title{ background:#f6e9cc; padding:.6rem .9rem; font-weight:700; border-bottom:1px solid #eadcb9; }
    .panel .subline{ font-size:.9rem; color:#6a4c3a; }

    footer{ background: var(--maroon); color:#f8efe7; }
    .footer-logo{ width:56px;height:56px;border-radius:.5rem;background:#ececec;color:#333;
      display:flex;align-items:center;justify-content:center;font-weight:700; }
    .footer-note{ color:#e7d7c6; font-size:.84rem; line-height:1.2; }
    .gallery-card .card-header{ background:#fff7e8; font-weight:700; }
  </style>

  @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

  {{-- Header & Nav --}}
  @include('partials.header')
  @include('partials.nav')

  {{-- Page band (opsional) --}}
  @hasSection('page_title')
    <div class="page-band">
      <div class="container py-3 text-center">
        <h3 class="section-title m-0">@yield('page_title')</h3>
      </div>
    </div>
  @endif

  {{-- Main --}}
  <main class="container py-4 flex-grow-1">
    @yield('content')
  </main>

  {{-- Footer --}}
  @include('partials.footer')

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
