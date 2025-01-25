<?php

namespace App\Validators\Users;

use App\Validators\BaseValidator;

class RegisterValidator extends BaseValidator
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'email_exists'], 
            'password' => ['required', 'min_length:6'],
            'first_name' => ['required', 'min_length:2'],
            'last_name' => ['required', 'min_length:2'],
            'phone' => ['required', 'min_length:10'],
        ];
    }

    public function validateData(array $data): bool
    {
        return $this->validate($data, $this->rules());
    }
}
