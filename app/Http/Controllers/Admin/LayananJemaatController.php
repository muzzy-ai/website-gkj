<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LayananJemaatRequest;
use App\Models\LayananJemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LayananJemaatController extends Controller
{
    public function index(Request $r)
    {
        $items = LayananJemaat::when($r->status, fn($q) => $q->where('status', $r->status))
            ->when($r->q, fn($q) => $q->where('title', 'like', "%{$r->q}%"))
            ->orderByDesc('published_at')->orderByDesc('id')
            ->paginate(12)->withQueryString();

        return view('admin.layanan-jemaats.index', compact('items'));
    }

    public function create()
    {
        return view('admin.layanan-jemaats.form', ['item' => new LayananJemaat]);
    }

    public function store(LayananJemaatRequest $req)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['created_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            $data['cover_path'] = $req->file('cover')->store('uploads/layanan', 'public');
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $item = LayananJemaat::create($data);

        return redirect()->route('admin.layanan-jemaats.edit', $item)->with('ok', 'Layanan dibuat.');
    }

    public function edit(LayananJemaat $layanan_jemaat)
    {
        return view('admin.layanan-jemaats.form', ['item' => $layanan_jemaat]);
    }

    public function update(LayananJemaatRequest $req, LayananJemaat $layanan_jemaat)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['updated_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            if ($layanan_jemaat->cover_path) {
                Storage::disk('public')->delete($layanan_jemaat->cover_path);
            }
            $data['cover_path'] = $req->file('cover')->store('uploads/layanan', 'public');
        }

        if ($data['status'] === 'published' && !$layanan_jemaat->published_at) {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $layanan_jemaat->update($data);

        return back()->with('ok', 'Perubahan disimpan.');
    }

    public function destroy(LayananJemaat $layanan_jemaat)
    {
        $layanan_jemaat->delete();
        return back()->with('ok', 'Dipindahkan ke Trash.');
    }
}
