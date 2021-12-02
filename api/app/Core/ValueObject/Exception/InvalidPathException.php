<?php

declare(strict_types=1);

namespace App\Core\ValueObject\Exception;

use App\Core\Exception\ErrorCode;
use App\Core\Exception\ValidationException;

class InvalidPathException extends ValidationException
{
    public static function emptyPath(): static
    {
        return new static('Path can\'t be empty.', ErrorCode::EMPTY_PATH);
    }

    public static function noFileOrDirFound(string $path): static
    {
        return new static(
            sprintf('No directory or file found in the resulting path. Got path "%s".', $path),
            ErrorCode::NO_FILE_OR_DIR_FOUND,
        );
    }

    public static function notFile(): static
    {
        return new static('Path must be a file.', ErrorCode::NOT_A_FILE);
    }

    public static function notDir(): static
    {
        return new static('Path must be a directory.', ErrorCode::NOT_A_DIRECTORY);
    }
}
