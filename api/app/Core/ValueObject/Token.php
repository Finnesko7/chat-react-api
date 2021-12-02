<?php

declare(strict_types=1);

namespace App\Core\ValueObject;

use App\Core\ValueObject\Exception\InvalidTokenException;

class Token extends ValueObject
{
    private string $token;

    /**
     * @throws InvalidTokenException
     */
    protected function __construct(string $token)
    {
        if ('' === $token) {
            throw InvalidTokenException::emptyToken();
        }
        $this->token = $token;
    }

    /**
     * @throws InvalidTokenException
     */
    public static function make(string $token): static
    {
        return new static($token);
    }

    public function get(): string
    {
        return $this->token;
    }

    public function isEqualWith(Token $tokenToCompare): bool
    {
        return $this->token === $tokenToCompare->get();
    }
}
