<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'first_name' => 'required',
            'last_name'  => 'required',
            'username'   => 'required|unique:users,username',
            'email'      => 'required|unique:users,email',
            'password'   => 'required|confirmed'
        ];
    }

    public function data()
    {
        return [
            'title'      => $this->get('title'),
            'first_name' => $this->get('first_name'),
            'last_name'  => $this->get('last_name'),
            'username'   => $this->get('username'),
            'email'      => $this->get('email'),
            'password'   => bcrypt($this->get('password')),
        ];
    }
}
