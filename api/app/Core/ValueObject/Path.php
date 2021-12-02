<?php

declare(strict_types=1);

namespace App\Core\ValueObject;

use App\Core\ValueObject\Exception\InvalidPathException;

class Path extends ValueObject
{
    private string $path;

    protected function __construct(string $path)
    {
        if ('' === $path) {
            throw InvalidPathException::emptyPath();
        }
        $this->path = $path;
    }

    public static function make(string $path): static
    {
        return new static($path);
    }

    public function get(): string
    {
        return $this->path;
    }

    public function isDir(): bool
    {
        return is_dir($this->path);
    }

    public function isFile(): bool
    {
        return !$this->isDir();
    }
}
