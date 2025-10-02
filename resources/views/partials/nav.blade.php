<nav class="menu-strip">
  <div class="container">
    <ul class="nav justify-content-center flex-wrap">
      <li class="nav-item"><a class="nav-link {{ request()->routeIs('renungan.index') ? 'active' : '' }}" href="{{ route('renungan.index') }}">Renungan</a></li>
      <li class="nav-item"><a class="nav-link {{ request()->routeIs('warta.index') ? 'active' : '' }}" href="{{ route('warta.index') }}">Warta Jemaat</a></li>
      <li class="nav-item"><a class="nav-link {{ request()->routeIs('berita.index') ? 'active' : '' }}" href="{{ route('berita.index') }}">Berita</a></li>
      <li class="nav-item"><a class="nav-link {{ request()->routeIs('agenda.index') ? 'active' : '' }}" href="{{ route('agenda.index') }}">Agenda &amp; Kegiatan</a></li>
      <li class="nav-item"><a class="nav-link {{ request()->routeIs('foto.index') ? 'active' : '' }}" href="{{ route('foto.index') }}">Foto</a></li>
      <li class="nav-item"><a class="nav-link {{ request()->routeIs('informasi.index') ? 'active' : '' }}" href="{{ route('informasi.index') }}">Informasi Penting</a></li>
      <li class="nav-item"><a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang Kami</a></li>
      <li class="nav-item"><a class="nav-link {{ request()->routeIs('layanan') ? 'active' : '' }}" href="{{ route('layanan') }}">Layanan Jemaat</a></li>
    </ul>
  </div>
</nav>
