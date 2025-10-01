<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PhotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Cek apakah user sudah login
        return Auth::check();
    }

    public function rules(): array
    {
        // Jika sedang update data, ambil id renungan yang sedang diedit
        $id = $this->photo->id ?? null;

        return [
            'image' => 'required|image|max:4096',
            'album_id' => 'required|exists:albums,id',
            'caption' => 'nullable|string',
            'taken_at' => 'nullable|date',
            'title' => 'required|string|max:160',

        ];
    }
}
