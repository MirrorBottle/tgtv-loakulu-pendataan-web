<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebInboxRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'min:3|required',
            'email' => 'email|required',
            'message' => 'min:5|required'
        ];
    }
}
