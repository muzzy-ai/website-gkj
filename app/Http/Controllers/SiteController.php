<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Photo;
use Illuminate\Support\Facades\Route;

class SiteController extends Controller
{
    public function home()
    {
        // Foto galeri utama (terbaru)
        $heroPhoto = Photo::orderByDesc('id')->first();

        // Informasi terbaru (published)
        $infos = Informasi::where('status', 'published')
            ->orderByDesc('published_at')
            ->take(5)
            ->get(['id','title','slug','published_at']);

        // Artikel yang ditampilkan di panel kanan (ambil 1 terbaru)
        $featured = Informasi::where('status', 'published')
            ->orderByDesc('published_at')
            ->first(['id','title','body','published_at']);

        // Helper kecil untuk URL informasi (pakai rute jika ada)
        $infoUrl = function ($info) {
            if (Route::has('informasi.show')) {
                // Jika kamu sudah punya show by slug, ganti ke ['slug'=>$info->slug]
                return route('informasi.show', ['id' => $info->id]);
            }
            return url('/informasi/'.$info->id);
        };

        return view('TampilanUtama.beranda', compact('heroPhoto','infos','featured','infoUrl'));
    }
}
