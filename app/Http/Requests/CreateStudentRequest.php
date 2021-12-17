<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Gradebook;
use Illuminate\Support\Facades\Auth;

class CreateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $gradebookId = $this->route('gradebook');
        $gradebook = Gradebook::find($gradebookId);

        if (Auth::id() == $gradebook['user_id']) {
            return true;
        } else return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'profile_pic_url' => 'required|url',
            'gradebook_id' => 'required|integer'
        ];
    }
}
