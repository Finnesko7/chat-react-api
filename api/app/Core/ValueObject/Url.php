<?php

declare(strict_types=1);

namespace App\Core\ValueObject;

use App\Core\ValueObject\Exception\InvalidUrlException;

class Url extends ValueObject
{
    private string $url;

    /**
     * @throws InvalidUrlException
     */
    protected function __construct(string $url)
    {
        $url = trim($url);
        if ('' === $url) {
            throw InvalidUrlException::emptyUrl();
        }
        if (\filter_var($url, \FILTER_VALIDATE_URL) === false) {
            throw InvalidUrlException::invalidFormat($url);
        }
        $this->url = $url;
    }

    /**
     * @throws InvalidUrlException
     */
    public static function make(string $url): static
    {
        return new static($url);
    }

    public function get(): string
    {
        return $this->url;
    }
}
