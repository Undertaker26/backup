<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function rules()
    {
        // Define common rules for creating a user
        return [
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            // Other rules if needed
        ];
    }

    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }
}
