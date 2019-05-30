<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachmentRequest extends FormRequest
{
    // public $expectsJson = true;
    public function expectsJson ()
    {
        return true;
    }

    // public function wantsJson()
    // {
    //     return true;
    // }
    // public function isJson()
    // {
    //     return true;
    // }


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
            'attachable_id' => 'required|int',
            'image' => 'required|image',
            'attachable_type' => 'required',
        ];
    }
}
