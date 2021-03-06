<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'sei' => 'required|string|max:30',
            'mei' => 'required|string|max:30',
            'sei_hira' => 'required|string|max:30',
            'mei_hira' => 'required|string|max:30',
            'self_introduction' => 'required|max:40',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            "image" => "指定されたファイルが画像ではありません。",
        ];
        // return parent::messages(); // TODO: Change the autogenerated stub
    }
}
