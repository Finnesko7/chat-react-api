<?php

declare(strict_types=1);

namespace App\Core\Exception;

class InfrastructureException extends RuntimeException
{
    public static function transactionFailure(?\Throwable $previous = null): static
    {
        return new static(
            'Process transaction was finish with failure.',
            ErrorCode::INTERNAL_ERROR,
            $previous,
        );
    }

    public static function fromUnexpectedThrowable(\Throwable $exception): static
    {
        return new static(
            sprintf('Unexpected exception: %s', $exception->getMessage()),
            ErrorCode::INTERNAL_ERROR,
            $exception,
        );
    }
}
