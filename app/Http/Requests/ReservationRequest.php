<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];
    }
    public function messages()
    {
        return [
            "room_id.required" => 'Campo :attribute requerido',
            'room_id.exists' => 'No se encontro elemento :attribute',
            "user_id.required" => 'Campo :attribute requerido',
            'user_id.exists' => 'No se encontro elemento :attribute',
            "date.required" => 'Campo :attribute requerido',
            "date.date" => 'Campo :attribute debe ser una fecha',
            "start_time.required" => 'Campo :attribute requerido',
            'start_time.date_format' => 'El formato de la Hora debe ser H:i',
            "end_time.required" => 'Campo :attribute requerido',
            'end_time.date_format' => 'El formato de la Hora debe ser H:i',
            "end_time.after" => 'La hora de fin debe ser posterior a la hora de inicio.',
        ];
    }
}
