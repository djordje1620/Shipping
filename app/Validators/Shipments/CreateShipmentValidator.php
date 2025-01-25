<?php

namespace App\Validators\Shipments;

use App\Validators\BaseValidator;

class CreateShipmentValidator extends BaseValidator
{
    public function rules(): array
    {
        return [
            'size' => ['required'],
            'method' => ['required'],
            'location_from' => ['required'],
            'location_to' => ['required'],
        ];
    }

    public function validateData(array $data): bool
    {
        return $this->validate($data, $this->rules());
    }
}