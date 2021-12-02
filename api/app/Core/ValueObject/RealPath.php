<?php

declare(strict_types=1);

namespace App\Core\ValueObject;

use App\Core\ValueObject\Exception\InvalidPathException;

class RealPath extends Path
{
    protected function __construct(string $path)
    {
        parent::__construct($path);
        if (!file_exists($path)) {
            throw InvalidPathException::noFileOrDirFound($path);
        }
    }

    public function isDir(): bool
    {
        return is_dir($this->get());
    }

    public function isFile(): bool
    {
        return !$this->isDir();
    }
}
