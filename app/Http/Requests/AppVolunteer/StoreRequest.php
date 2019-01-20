<?php

namespace App\Http\Requests\AppVolunteer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'photo'=>'required|image|mimes:jpeg,jpg,png|max:4096',
            'surname' => 'required|string|max:64',
            'first_name' => 'required|string|max:64',
            'nickname' => 'max:64',
            'age' => 'required|integer',
            'phone' => 'required|string|max:64',
            'telegram' => 'required|string',
            'city' => 'required|string|max:100',
            'social_links' => '',
            'skills' => 'required|string',
            'difficulties' => 'nullable|string',
            'experience' => 'nullable|string',
        ];
    }
}
