<?php

namespace App\Validators\Users;

use App\Validators\BaseValidator;

class LoginValidator extends BaseValidator
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min_length:6']
        ];
    }

    public function validateData(array $data): bool
    {
        return $this->validate($data, $this->rules());
    }
}