<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class offerRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
    }

    public function messages()
    {

        return $messages = [
            'name.required' =>  __('messages.offer name required'),
            'name.unique' => __(' messages.offer name must be unique'),
            'price.numeric' => __('messages.price should be numeric'),
            'price.required' => __('messages.price required'),
            'details.required' => __('messages.details required'),
        ];
    }

}
