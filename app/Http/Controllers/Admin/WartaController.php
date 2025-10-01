<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WartaRequest;
use App\Models\Warta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class WartaController extends Controller
{
    public function index(Request $r)
    {
        $items = Warta::when($r->status, fn($q) => $q->where('status', $r->status))
            ->when($r->q, fn($q) => $q->where('title', 'like', "%{$r->q}%"))
            ->orderByDesc('published_at')->orderByDesc('id')
            ->paginate(12)->withQueryString();

        return view('admin.wartas.index', compact('items'));
    }

    public function create()
    {
        return view('admin.wartas.form', ['item' => new Warta]);
    }

    public function store(WartaRequest $req)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['created_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            $data['cover_path'] = $req->file('cover')->store('uploads/warta', 'public');
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $item = Warta::create($data);

        return redirect()->route('admin.wartas.edit', $item)->with('ok', 'Warta dibuat.');
    }

    public function edit(Warta $warta)
    {
        return view('admin.wartas.form', ['item' => $warta]);
    }

    public function update(WartaRequest $req, Warta $warta)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['updated_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            if ($warta->cover_path) {
                Storage::disk('public')->delete($warta->cover_path);
            }
            $data['cover_path'] = $req->file('cover')->store('uploads/warta', 'public');
        }

        if ($data['status'] === 'published' && !$warta->published_at) {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $warta->update($data);

        return back()->with('ok', 'Perubahan disimpan.');
    }

    public function destroy(Warta $warta)
    {
        $warta->delete();
        return back()->with('ok', 'Dipindahkan ke Trash.');
    }
}
