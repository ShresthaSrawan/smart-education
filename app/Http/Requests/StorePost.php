<?php

namespace App\Http\Requests;

use App\Models\CustomTag;
use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'message' => 'required'
        ];
    }

    public function data()
    {
        return [
            'user_id' => auth()->id(),
            'message' => $this->get('message')
        ];
    }

    public function tags()
    {
        $tags = [];

        foreach ($this->input('tags', []) as $t)
        {
            if (array_key_exists('type', $t))
            {
                $tags[] = $t;
            }
            elseif (array_key_exists('name', $t))
            {
                $newTag = CustomTag::create($t);
                $tags[] = [
                    'tagable_id'   => $newTag->id,
                    'tagable_type' => CustomTag::class
                ];
            }
        }

        return $tags;
    }
}
