<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgendaItemsRequest;
use App\Models\AgendaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AgendaItemController extends Controller
{
    public function index(Request $r)
    {
        $items = AgendaItem::when($r->status, fn($q) => $q->where('status', $r->status))
            ->when($r->q, fn($q) => $q->where('title', 'like', "%{$r->q}%"))
            ->orderBy('start_at', 'asc')
            ->paginate(12)->withQueryString();

        return view('admin.agenda-items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.agenda-items.form', ['item' => new AgendaItem]);
    }

    public function store(AgendaItemsRequest $req)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['created_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            $data['cover_path'] = $req->file('cover')->store('uploads/agenda', 'public');
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $item = AgendaItem::create($data);

        return redirect()->route('admin.agenda-items.edit', $item)->with('ok', 'Agenda dibuat.');
    }

    public function edit(AgendaItem $agenda_item)
    {
        return view('admin.agenda-items.form', ['item' => $agenda_item]);
    }

    public function update(AgendaItemsRequest $req, AgendaItem $agenda_item)
    {
        $data = $req->validated();
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['updated_by'] = Auth::id();

        if ($req->hasFile('cover')) {
            if ($agenda_item->cover_path) {
                Storage::disk('public')->delete($agenda_item->cover_path);
            }
            $data['cover_path'] = $req->file('cover')->store('uploads/agenda', 'public');
        }

        if ($data['status'] === 'published' && !$agenda_item->published_at) {
            $data['published_at'] = now();
            $data['published_by'] = Auth::id();
        }

        $agenda_item->update($data);

        return back()->with('ok', 'Perubahan disimpan.');
    }

    public function destroy(AgendaItem $agenda_item)
    {
        $agenda_item->delete();
        return back()->with('ok', 'Dipindahkan ke Trash.');
    }
}
