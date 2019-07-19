<?php

namespace App\Http\Requests\Sections;

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
            'description' => 'nullable',
            'users' => 'nullable|array',
            'users.*' => [Rule::in(User::all()->pluck('id')->toArray())],
            'logo' => 'nullable|image|max:2048|mimes:jpeg,jpg,png',

        ];
    }
}
