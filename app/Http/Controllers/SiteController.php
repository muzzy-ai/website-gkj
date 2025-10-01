<?php

namespace App\Http\Controllers;

use App\Models\Renungan;
use App\Models\Berita;
use App\Models\AgendaItem;
use App\Models\Informasi;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home', [
            'renungan' => Renungan::where('status','published')->latest('published_at')->first(),
            'berita'   => Berita::where('status','published')->latest('published_at')->take(3)->get(),
            'agenda'   => AgendaItem::where('status','published')->orderBy('start_at')->take(4)->get(),
            'infos'    => Informasi::where('status','published')->latest('published_at')->take(4)->get(),
        ]);
    }
}
