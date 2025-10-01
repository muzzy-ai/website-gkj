<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AlbumRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Cek apakah user sudah login
        return Auth::check();
    }

    public function rules(): array
    {
        // Jika sedang update data, ambil id renungan yang sedang diedit
        $id = $this->album->id ?? null;

        return [
            'name' => 'required|string|max:160',
            'description' => 'nullable|string|max:500',
            'cover' => 'nullable|image|max:2048',
        ];
    }
}
