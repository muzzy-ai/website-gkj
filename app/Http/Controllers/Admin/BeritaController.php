<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeritaRequest;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index(Request $r)
    {
        $items = Berita::when($r->category, fn($q) => $q->where('category', $r->category))
            ->when($r->status, fn($q) => $q->where('status', $r->status))
            ->when($r->q, fn($q) => $q->where('title', 'like', "%{$r->q}%"))
            ->orderByDesc('published_at')->orderByDesc('id')
            ->paginate(12)->withQueryString();

        return view('admin.beritas.index', compact('items'));
    }

    public function create()
    {
        return view('admin.beritas.form', ['item' => new Berita]);
    }

    public function store(BeritaRequest $req)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['created_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            $data['cover_path'] = $req->file('cover')->store('uploads/berita', 'public');
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $item = Berita::create($data);

        return redirect()->route('admin.beritas.edit', $item)->with('ok', 'Berita dibuat.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.beritas.form', ['item' => $berita]);
    }

    public function update(BeritaRequest $req, Berita $berita)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['updated_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            if ($berita->cover_path) {
                Storage::disk('public')->delete($berita->cover_path);
            }
            $data['cover_path'] = $req->file('cover')->store('uploads/berita', 'public');
        }

        if ($data['status'] === 'published' && !$berita->published_at) {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $berita->update($data);

        return back()->with('ok', 'Perubahan disimpan.');
    }

    public function destroy(Berita $berita)
    {
        $berita->delete();
        return back()->with('ok', 'Dipindahkan ke Trash.');
    }
}
