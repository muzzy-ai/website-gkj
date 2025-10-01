<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoRequest;
use App\Models\Photo;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    public function index(Request $r)
    {
        $items = Photo::with('album')
            ->when($r->album_id, fn($q) => $q->where('album_id', $r->album_id))
            ->orderByDesc('id')->paginate(24)->withQueryString();

        $albums = Album::orderBy('name')->get(['id','name']);
        return view('admin.photos.index', compact('items','albums'));
    }

    public function create()
    {
        $albums = Album::orderBy('name')->get(['id','name']);
        return view('admin.photos.form', ['albums' => $albums]);
    }

    public function store(PhotoRequest $req)
    {
        $data = $req->validated();

        if ($req->hasFile('image')) {
            $data['path'] = $req->file('image')->store('uploads/photos', 'public');
        }

        // $data['uploaded_by'] = Auth::id(); // jika kolomnya ada
        Photo::create($data);

        return redirect()->route('admin.photos.index')->with('ok', 'Foto diupload.');
    }

    public function destroy(Photo $photo)
    {
        if ($photo->path) {
            Storage::disk('public')->delete($photo->path);
        }
        $photo->delete();

        return back()->with('ok', 'Foto dihapus.');
    }
}
