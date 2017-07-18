<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrade extends FormRequest
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
            'name'             => 'required',
            'class_teacher_id' => 'required|exists:users,id'
        ];
    }

    public function data()
    {
        return [
            'name'             => $this->get('name'),
            'class_teacher_id' => $this->get('class_teacher_id'),
        ];
    }
}
