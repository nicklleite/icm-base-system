<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            "hash" => "sometimes|string|unique:users,hash",
            "email" => "sometimes|email|unique:users,email",
            "username" => "sometimes|string|min:4|unique:users,username",
            "full_name" => "required|string|min:5",
        ];
    }
}