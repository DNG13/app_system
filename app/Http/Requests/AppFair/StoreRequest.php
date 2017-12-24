<?php

namespace App\Http\Requests\AppFair;

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
            'logo'=>'required|image|mimes:jpeg,jpg,png|max:4096',
            'type_id' => 'required',
            'group_nick'=>'required|string|max:100',
            'contact_name' => 'required|string|max:255',
            'phone' => 'required|string|max:64',
            'members_count' => 'required|numeric',
            'social_link'=>'required',
            'group_link'=>'required',
            'square' => 'required|numeric',
            'payment_type'=>'required|string|max:64',
            'description' => 'required|string',
        ];
    }
}
