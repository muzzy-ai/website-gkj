<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function index(Request $r)
    {
        $items = Album::when($r->q, fn($q) => $q->where('name', 'like', "%{$r->q}%"))
            ->orderByDesc('id')->paginate(20)->withQueryString();

        return view('admin.albums.index', compact('items'));
    }

    public function create()
    {
        return view('admin.albums.form', ['item' => new Album]);
    }

    public function store(AlbumRequest $req)
    {
        $data = $req->validated();
        // Jika ingin menyimpan audit (bikin kolom jika perlu)
        // $data['created_by'] = Auth::id();

        $item = Album::create($data);
        return redirect()->route('admin.albums.edit', $item)->with('ok', 'Album dibuat.');
    }

    public function edit(Album $album)
    {
        return view('admin.albums.form', ['item' => $album]);
    }

    public function update(AlbumRequest $req, Album $album)
    {
        $data = $req->validated();
        // $data['updated_by'] = Auth::id();
        $album->update($data);

        return back()->with('ok', 'Perubahan disimpan.');
    }

    public function destroy(Album $album)
    {
        $album->delete();
        return back()->with('ok', 'Album dihapus.');
    }
}
