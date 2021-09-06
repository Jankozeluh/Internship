<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertStudentRequest extends FormRequest
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
        return [
            'degree' => 'max:10',
            'firstName' => 'string|required|max:100',
            'lastName' => 'string|required|max:100',
            'credits' => 'required',
            'birth' => 'required',
            'enrollment' => 'required',
        ];
    }
}
