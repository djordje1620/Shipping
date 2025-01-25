<?php

namespace App\Validators;

use App\Repositories\UserRepository;

class BaseValidator
{
    protected array $errors = [];
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function validate(array $data, array $rules): bool
    {
        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                if (!$this->applyRule($data[$field] ?? null, $rule)) {
                    $this->addError($field, $this->getErrorMessage($field, $rule));
                }
            }
        }
        return empty($this->errors);
    }

    /**
     * @throws \Exception
     */
    protected function applyRule($value, string $rule): bool
    {
        [$ruleName, $parameter] = explode(':', $rule . ':');

        return match ($ruleName) {
            'required' => !is_null($value) && $value !== '',
            'email' => filter_var($value, FILTER_VALIDATE_EMAIL),
            'min_length' => strlen($value) >= (int)$parameter,
            'max_length' => strlen($value) <= (int)$parameter,
            'email_exists' => $this->customRule('email_exists', $value),
            default => false,
        };
    }
    protected function customRule(string $ruleName, $value): bool
    {
        if ($ruleName === 'email_exists') {
            if ($this->userRepository->getUserByEmail($value)) {
                $this->errors['email'][] = "A user with this email already exists.";
                return false;
            }
        }
        return true;
    }



    protected function getErrorMessage(string $field, string $rule): string
    {
        $ruleName = explode(':', $rule)[0];
        return match ($ruleName) {
            'required' => "The $field field is required.",
            'email' => "The $field must be a valid email address.",
            'min_length' => "The $field must be at least {$this->getRuleParameter($rule)} characters long.",
            'max_length' => "The $field must be at most {$this->getRuleParameter($rule)} characters long.",
            default => "",
        };
    }

    protected function getRuleParameter(string $rule): ?string
    {
        return explode(':', $rule)[1] ?? null;
    }

    protected function addError(string $field, string $message): void
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }
        $this->errors[$field][] = $message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
