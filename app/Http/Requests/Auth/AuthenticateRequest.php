<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $validationRules = array(
            "password" => "required|string|min:6|max:128"
        );

        $loginField = (empty($this->get('username')))? 'email' : 'username';

        $validationRules[$loginField] = 'required|email';

        if ($loginField === "username") {
            $validationRules[$loginField] = 'required';
        }

        return $validationRules;
    }
}
