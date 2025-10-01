<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AgendaItemsRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Cek apakah user sudah login
        return Auth::check();
    }

    public function rules(): array
    {
        // Jika sedang update data, ambil id renungan yang sedang diedit
        $id = $this->agenda_items->id ?? null;

        return [
            'title' => 'required|string|max:160',
            'slug'  => 'nullable|string|max:180|unique:agenda_items,slug,' . $id,
            'excerpt' => 'nullable|string|max:500',
            'body'  => 'required|string',
            'status'=> 'required|in:draft,published,archived',
            'cover' => 'nullable|image|max:2048',

            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'location' => 'nullable|string|max:160',
            'organizer' => 'nullable|string|max:160',


            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
        ];
    }
}
