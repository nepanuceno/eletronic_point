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
        // dd($this->method, $this->user);
        // if($this->user == auth()->id()) {
        //     return true;
        // }
        // else {
        //     switch ($this->method) {
        //         case 'POST':
        //             return $this->user()->can('user-create');
        //             break;
        //         case 'PUT':
        //             return $this->user()->can('user-edit');
        //             break;
        //         case 'PATCH':
        //             return $this->user()->can('user-edit');
        //             break;
        //         default:
        //             return $this->user()->can('user-list');
        //             break;
        //     }
        // }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (array_key_exists('password', $this->all())) {
            $rules = [
                'password' => [
                    'required',
                    'same:confirm-password'
                ]
            ];
            return $rules;

            // $rules['password']=['nullable', 'min:6'];
        } else {
            $user_id = $this->user ?? '';
            $rules = [
                'name' => ['required', 'string'],
                'email' => [
                    'required',
                    'email',
                    "unique:users,email,{$user_id},id"
                ]
            ];
            return $rules;

        }


    }
}
