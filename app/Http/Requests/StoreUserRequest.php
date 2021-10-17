<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            "hash" => "required|string|unique:users,hash",
            "email" => "required|email|unique:users,email",
            "username" => "required|string|min:4|unique:users,username",
            "full_name" => "required|string|min:5",
        ];
    }
}
