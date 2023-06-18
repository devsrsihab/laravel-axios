<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // 1. password is required ( it will show under  password div)
        // 2. if password given by user then no error showing 
        // 3. if confirm password is incorect then just confrim password input div will be red color and error text shown
        // 4. the error will be shown under this div which div is incorrect data
        
        return [
            "name"                  =>["required","max:36","regex:/^[a-zA-Z.:\s]+$/", // Only allow letters and spaces
                                        function ($attribute, $value, $fail) {
                                            if (URL::isValidUrl($value)) {
                                                $fail($attribute.' cannot be a URL.');
                                            }
                                        },
                                    ],

            "email"                 => "required|email|unique:users,email",
            "password"              => "required|min:8|max:16",
            "password_confirmation" => "same:password|required_if:password,!==null",
        ];

        
    }
}
