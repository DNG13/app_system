<?php

namespace App\Http\Requests\AppFair;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
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
            'type_id' => 'required',
            'group_nick'=>'required|string|max:100',
            'contact_name' => 'required|string|max:255',
            'phone' => 'required|string|max:64',
            'social_link'=>'required',
            'group_link'=>'required',
            'square' => 'nullable|numeric',
            'payment_type'=>'required|string|max:64',
            'description' => 'required|string',
        ];
    }
}
