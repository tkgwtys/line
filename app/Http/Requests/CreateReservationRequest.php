<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'selected_date' => 'required|string',
            'selected_time' => 'required|string',
            'player' => 'required|string|max:50',
            'course' => 'required|string|max:100',
            'user' => 'required|string|max:100',
            'store' => 'required|string|max:100',
        ];
    }
}
