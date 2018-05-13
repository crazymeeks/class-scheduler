<?php

namespace Scheduler\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassSizeFormRequest extends FormRequest
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
            'semester' => 'required',
            'program' => 'required',
            'level' => 'required',
            'block' => 'required',
            'size' => 'required|integer',
        ];
    }
}
