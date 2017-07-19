<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotice extends FormRequest
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
            'to' => 'required',
            'title' => 'required',
            'message' => 'required'
        ];
    }

    public function data()
    {
        return [
            'to' => $this->get('to'),
            'title' => $this->get('title'),
            'message' => $this->get('message')
        ]
    }

    public function notifiables()
    {
        return [
            'test@email.com'
        ]
    }
}
