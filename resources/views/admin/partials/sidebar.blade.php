<div class="list-group list-group-flush">
  <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    Dashboard
  </a>

  <div class="list-group-item fw-bold">Konten</div>
  <a href="{{ route('admin.renungans.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/renungans*') ? 'active' : '' }}">Renungan</a>
  <a href="{{ route('admin.wartas.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/wartas*') ? 'active' : '' }}">Warta Jemaat</a>
  <a href="{{ route('admin.beritas.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/beritas*') ? 'active' : '' }}">Berita</a>
  <a href="{{ route('admin.agenda-items.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/agenda-items*') ? 'active' : '' }}">Agenda & Kegiatan</a>
  <a href="{{ route('admin.informasi.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/informasi-pentings*') ? 'active' : '' }}">Informasi Penting</a>
  <a href="{{ route('admin.layanans.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/layanan-jemaats*') ? 'active' : '' }}">Layanan Jemaat</a>
  <a href="{{ route('admin.halamans.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/halamans*') ? 'active' : '' }}">Halaman Statis</a>

  <div class="list-group-item fw-bold">Galeri</div>
  <a href="{{ route('admin.albums.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/albums*') ? 'active' : '' }}">Album</a>
  <a href="{{ route('admin.photos.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/photos*') ? 'active' : '' }}">Foto</a>
</div>
