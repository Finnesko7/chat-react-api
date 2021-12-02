<?php

declare(strict_types=1);

namespace App\Core\ValueObject;

use App\Core\ValueObject\Exception\InvalidEmailException;

class Email extends ValueObject
{
    private string $email;

    /**
     * @throws InvalidEmailException
     */
    protected function __construct(string $email)
    {
        if ('' === $email) {
            throw InvalidEmailException::emptyEmail();
        }
        $email = trim($email);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw InvalidEmailException::invalidFormat($email);
        }
        $this->email = $email;
    }

    /**
     * @throws InvalidEmailException
     */
    public static function make(string $email): static
    {
        return new static($email);
    }

    public function get(): string
    {
        return $this->email;
    }
}
