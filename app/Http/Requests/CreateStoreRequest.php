<?php

namespace App\Http\Requests;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'tel' => 'required|string|max:30',
            'url' => 'required|string|max:255',
            'business_hours' => 'required|string|max:255',
            'color_code' => 'required|string|max:255',
        ];
    }
}
