<?php

namespace App\Http\Requests\Person;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StorePersonRequest extends FormRequest
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
    #[ArrayShape([
        'full_name' => "string",
        'social_name' => "string",
        'birthday' => "string",
        'is_pwd' => "string",
        'birth_country' => "string",
        'birth_city' => "string"
    ])]
    public function rules(): array
    {
        return [
            'full_name' => "required|string",
            'social_name' => "required|string",
            'birthday' => "required|date",
            'is_pwd' => "boolean",
            'birth_country' => "required|string",
            'birth_city' => "required|string"
        ];
    }
}
