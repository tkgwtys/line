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
            'player_id' => 'required|string',
            'reservationDate' => 'required|string',
            'course' => 'required|string|max:10',
            'store' => 'required|string|max:10',
            'status' => 'required|string|max:10',
            'status' => 'required|string|max:10',
        ];
    }
}
