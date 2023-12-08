<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePertanyaanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tipe_jawabans_id' => 'required',
            'layanans_id' => 'required',
            'nama' => 'required|string|max:255',
            'status' => 'required',
            // ? tambahkan aturan validasi untuk field lain jika diperlukan
        ];
    }
}