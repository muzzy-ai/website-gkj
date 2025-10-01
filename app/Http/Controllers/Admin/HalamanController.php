<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HalamanRequest;
use App\Models\Halaman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HalamanController extends Controller
{
    public function index(Request $r)
    {
        $items = Halaman::when($r->status, fn($q) => $q->where('status', $r->status))
            ->when($r->q, fn($q) => $q->where('title', 'like', "%{$r->q}%"))
            ->orderByDesc('published_at')->orderByDesc('id')
            ->paginate(12)->withQueryString();

        return view('admin.halamans.index', compact('items'));
    }

    public function create()
    {
        return view('admin.halamans.form', ['item' => new Halaman]);
    }

    public function store(HalamanRequest $req)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['created_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            $data['cover_path'] = $req->file('cover')->store('uploads/halaman', 'public');
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $item = Halaman::create($data);

        return redirect()->route('admin.halamans.edit', $item)->with('ok', 'Halaman dibuat.');
    }

    public function edit(Halaman $halaman)
    {
        return view('admin.halamans.form', ['item' => $halaman]);
    }

    public function update(HalamanRequest $req, Halaman $halaman)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['updated_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            if ($halaman->cover_path) {
                Storage::disk('public')->delete($halaman->cover_path);
            }
            $data['cover_path'] = $req->file('cover')->store('uploads/halaman', 'public');
        }

        if ($data['status'] === 'published' && !$halaman->published_at) {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $halaman->update($data);

        return back()->with('ok', 'Perubahan disimpan.');
    }

    public function destroy(Halaman $halaman)
    {
        $halaman->delete();
        return back()->with('ok', 'Dipindahkan ke Trash.');
    }
}
