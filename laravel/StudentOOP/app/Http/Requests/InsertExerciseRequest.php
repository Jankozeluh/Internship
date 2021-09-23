<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertExerciseRequest extends FormRequest
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
            'name' => 'required',
            'date' => 'required|date_format:Y-m-d|after:now',
            'pc' => 'required',
            'subject_id' => 'exists:subjects,id',
            'teacher_id' => 'exists:teachers,id', 
            'group_id' => 'exists:groups,id',
        ];
    }
}
