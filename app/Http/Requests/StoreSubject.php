<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubject extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name'       => 'required',
            'teacher_id' => 'required'
        ];
    }

    public function data()
    {
        return [
            'name'       => $this->get('name'),
            'teacher_id' => $this->get('teacher_id'),
        ];
    }
}
