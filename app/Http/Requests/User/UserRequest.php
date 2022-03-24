<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    private function isUserLogged()
    {
        if($this->user == auth()->id()) {
            return true;
        }
        return false;
    }

    private function passwordExistsInRequest()
    {
        if (!array_key_exists('password', $this->all())) {
            return $this->user()->can('user-edit');
        }
        return false;
    }

    private function methodVerify()
    {
        switch ($this->method()) {
            case 'POST':
                return $this->user()->can('user-create');
                break;
            case 'PATCH':
                return $this->passwordExistsInRequest();
                break;
            default:
                return $this->user()->can('user-list');
                break;
        }
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->isUserLogged()) {
            return true;
        } else {
            return $this->methodVerify();
        }
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
