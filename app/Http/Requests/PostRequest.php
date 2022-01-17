<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = [
            'content' => 'required|max:50',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['user_id'] = 'prohibited';
        } else {
            $rules['user_id'] = 'required|exists:users,id';
        }

        return $rules;
    }
}
