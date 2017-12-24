<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
            'file' => 'nullable|mimes:jpeg,jpg,png,ogg,mp3,wav,wma,mid,flac,aac,alac,ac3,m4a,aif,iff,m3u,mpa,ra,doc,rtf,pdf,docx,sxw,txt,odt|max:102400',
        ];
    }
}
