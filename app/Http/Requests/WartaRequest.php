<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class WartaRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Cek apakah user sudah login
        return Auth::check();
    }

    public function rules(): array
    {
        // Jika sedang update data, ambil id renungan yang sedang diedit
        $id = $this->warta->id ?? null;

        return [
            'title' => 'required|string|max:160',
            'slug'  => 'nullable|string|max:180|unique:warta,slug,' . $id,
            'excerpt' => 'nullable|string|max:500',
            'body'  => 'required|string',
            'status'=> 'required|in:draft,published,archived',
            'cover' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ];
    }
}
