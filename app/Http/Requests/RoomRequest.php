<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'details' => 'nullable|string|max:255',
            'size' => 'required|in:P,M,G',
        ];
    }
    public function messages()
    {
        return [
            "name.required" => 'Campo :attribute requerido',
            "name.string" => 'Campo :attribute debe ser string',
            "name.max" => 'Campo :attribute debe tener max 255 caracteres',
            "details.string" => 'Campo :attribute debe ser string',
            "details.max" => 'Campo :attribute debe tener max 255 caracteres',
            "size.required" => 'Campo :attribute requerido',
            "size.in" => 'Campo :attribute debe ser P,M,G',
        ];
    }
}
