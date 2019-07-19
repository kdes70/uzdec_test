<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Update extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,id',
            'password' => 'required|string|min:6',
            'role' => ['required', 'string', Rule::in(array_keys(User::getRoleList()))],
            'state' => ['required', 'string', Rule::in(array_keys(User::getStatesList()))],
        ];
    }
}
