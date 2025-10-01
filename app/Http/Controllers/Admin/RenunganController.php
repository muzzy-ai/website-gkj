<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RenunganRequest;
use App\Models\Renungan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RenunganController extends Controller
{
    public function index(Request $r)
    {
        $items = Renungan::when($r->status, fn($q) => $q->where('status', $r->status))
            ->when($r->q, fn($q) => $q->where('title', 'like', "%{$r->q}%"))
            ->orderByDesc('published_at')->orderByDesc('id')
            ->paginate(12)->withQueryString();

        return view('admin.renungans.index', compact('items'));
    }

    public function create()
    {
        return view('admin.renungans.form', ['item' => new Renungan]);
    }

    public function store(RenunganRequest $req)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['created_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            $data['cover_path'] = $req->file('cover')->store('uploads/renungan', 'public');
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $item = Renungan::create($data);

        return redirect()->route('admin.renungans.edit', $item)->with('ok', 'Renungan dibuat.');
    }

    public function edit(Renungan $renungan)
    {
        return view('admin.renungans.form', ['item' => $renungan]);
    }

    public function update(RenunganRequest $req, Renungan $renungan)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['updated_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            if ($renungan->cover_path) {
                Storage::disk('public')->delete($renungan->cover_path);
            }
            $data['cover_path'] = $req->file('cover')->store('uploads/renungan', 'public');
        }

        if ($data['status'] === 'published' && !$renungan->published_at) {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $renungan->update($data);

        return back()->with('ok', 'Perubahan disimpan.');
    }

    public function destroy(Renungan $renungan)
    {
        $renungan->delete();
        return back()->with('ok', 'Dipindahkan ke Trash.');
    }
}
