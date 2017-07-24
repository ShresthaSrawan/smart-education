<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParent extends StoreUser
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();

        $rules['children'] = 'required';
dd($rules);
        return $rules;
    }

    public function data()
    {
        $data = parent::data();

        return $data;
    }
}
