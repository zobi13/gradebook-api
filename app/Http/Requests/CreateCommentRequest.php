<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    //     if (Auth::check()) {
    //         return true;
    //     } else return false;
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
            'text' => 'required|string|max:1000',
            'gradebook_id' => 'required|integer',
            'user_id' => 'required|integer'
        ];
    }
}
