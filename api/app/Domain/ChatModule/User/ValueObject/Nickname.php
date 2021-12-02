<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\User\ValueObject;

use App\Core\ValueObject\ValueObject;
use App\Domain\ChatModule\User\Exception\InvalidNicknameException;

class Nickname extends ValueObject
{
    private const MIN_LENGTH = 2;
    private const MAX_LENGTH = 24;

    private string $nickname;

    /**
     * @throws InvalidNicknameException
     */
    private function __construct(string $nickname)
    {
        if ('' === $nickname) {
            throw InvalidNicknameException::empty();
        }
        $nicknameLength = mb_strlen($nickname);
        if ($nicknameLength < self::MIN_LENGTH) {
            throw InvalidNicknameException::lessThanMin(self::MIN_LENGTH);
        }
        if ($nicknameLength > self::MAX_LENGTH) {
            throw InvalidNicknameException::greaterThanMax(self::MAX_LENGTH);
        }
        $this->nickname = $nickname;
    }

    /**
     * @throws InvalidNicknameException
     */
    public static function make(string $nickname): static
    {
        return new static($nickname);
    }

    public function get(): string
    {
        return $this->nickname;
    }
}
