<?php

namespace App\Validators\Shipments;

use App\Validators\BaseValidator;

class TrackingNumberValidator extends BaseValidator
{
    public function rules(): array
    {
        return [
            'tracking_number' => ['required', 'valid_length:8'],
        ];
    }

    public function validateData(array $data): bool
    {
        return $this->validate($data, $this->rules());
    }
}