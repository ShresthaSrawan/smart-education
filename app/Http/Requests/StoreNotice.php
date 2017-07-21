<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreNotice extends FormRequest
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
            'to'      => 'required',
            'title'   => 'required',
            'message' => 'required',
            'notify'  => 'boolean'
        ];
    }

    public function data()
    {
        return [
            'meta'    => [ 'to' => $this->notifiables()->pluck('id') ],
            'user_id' => auth()->id(),
            'title'   => $this->get('title'),
            'message' => $this->get('message'),
            'notify'  => $this->get('notify')
        ];
    }

    public function notifiables()
    {
        return User::whereIn('id', collect($this->get('to'))->pluck('code'))->get();
    }
}
