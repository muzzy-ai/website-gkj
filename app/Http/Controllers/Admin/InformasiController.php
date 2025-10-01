<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InformasiRequest;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class InformasiController extends Controller
{
    public function index(Request $r)
    {
        $items = Informasi::when($r->status, fn($q) => $q->where('status', $r->status))
            ->when($r->q, fn($q) => $q->where('title', 'like', "%{$r->q}%"))
            ->orderByDesc('published_at')->orderByDesc('id')
            ->paginate(12)->withQueryString();

        return view('admin.informasi.index', compact('items'));
    }

    public function create()
    {
        return view('admin.informasi.form', ['item' => new Informasi]);
    }

    public function store(InformasiRequest $req)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['created_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            $data['cover_path'] = $req->file('cover')->store('uploads/informasi', 'public');
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $item = Informasi::create($data);

        return redirect()->route('admin.informasi.edit', $item)->with('ok', 'Informasi dibuat.');
    }

    public function edit(Informasi $informasi_penting)
    {
        return view('admin.informasi.form', ['item' => $informasi_penting]);
    }

    public function update(InformasiRequest $req, Informasi $informasi_penting)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['updated_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            if ($informasi_penting->cover_path) {
                Storage::disk('public')->delete($informasi_penting->cover_path);
            }
            $data['cover_path'] = $req->file('cover')->store('uploads/informasi', 'public');
        }

        if ($data['status'] === 'published' && !$informasi_penting->published_at) {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $informasi_penting->update($data);

        return back()->with('ok', 'Perubahan disimpan.');
    }

    public function destroy(Informasi $informasi_penting)
    {
        $informasi_penting->delete();
        return back()->with('ok', 'Dipindahkan ke Trash.');
    }
}
