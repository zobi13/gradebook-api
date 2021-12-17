<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Gradebook;
use Illuminate\Support\Facades\Auth;

class UpdateGradebookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $gradebook = $this->route('gradebook');
        // $gradebook = Gradebook::find($gradebookId);

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
            'name' => 'string|max:255',
            'user_id' => 'integer'
        ];
    }
}
