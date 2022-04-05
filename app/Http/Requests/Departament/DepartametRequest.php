<?php

namespace App\Http\Requests\Departament;

use Illuminate\Foundation\Http\FormRequest;

class DepartametRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('departament-edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $departament_id=$this->departaments;
        return [
            'name' => ['required', "unique:departaments,id,{$departament_id}", 'string'],
            'parent_id' => ['required', 'integer'],
        ];
    }
}
