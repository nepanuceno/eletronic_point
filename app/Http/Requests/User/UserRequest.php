<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method) {
            case 'POST':
                return $this->user()->can('user-create');
                break;
            case 'PUT':
                return $this->user()->can('user-edit');
                break;
            default:
                return $this->user()->can('user-list');
                break;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user_id = $this->user ?? '';
        $rules = [
            'name' => ['required', 'string'],
            'email' => [
                'required',
                'email',
                "unique:users,email,{$user_id},id"
            ],
            'password' => [
                'required',
                'same:confirm-password'
            ]
        ];

        $rules['password']=['nullable', 'min:6'];

        return $rules;
    }
}
