<?php

declare(strict_types=1);

namespace App\Core\ValueObject;

use App\Core\Exception\InvalidEnumException;

abstract class Enum extends ValueObject
{
    private string|int $enum;
    private static array $enumList;
    private static array $enumInstances;

    /**
     * @throws InvalidEnumException
     */
    private function __construct(string|int $enum)
    {
        if (!self::assertInList($enum)) {
            throw InvalidEnumException::notInList($enum, self::getList());
        }
        $this->enum = $enum;
    }

    final public function get(): string|int
    {
        return $this->enum;
    }

    final public function isEqualWith(self $enum): bool
    {
        return $this->enum === $enum->enum;
    }

    /**
     * @throws InvalidEnumException
     */
    final public static function make(string|int $enum): static
    {
        if (!isset(self::$enumInstances[static::class][$enum])) {
            self::$enumInstances[static::class][$enum] = new static($enum);
        }

        return self::$enumInstances[static::class][$enum];
    }

    final public static function assertInList(string|int $enum): bool
    {
        return \in_array($enum, self::getList(), true);
    }

    final public static function getList(): array
    {
        if (!isset(self::$enumList[static::class])) {
            $reflection = new \ReflectionClass(static::class);
            self::$enumList[static::class] = array_values($reflection->getConstants());
        }

        return self::$enumList[static::class];
    }

    public static function __callStatic(string $name, array $arguments)
    {
        $name = mb_strtoupper($name);
        $reflection = new \ReflectionClass(static::class);
        $enumConstants = $reflection->getConstants();
        $enum = $enumConstants[$name] ?? null;
        if (is_null($enum)) {
            throw InvalidEnumException::undefinedEnumConstant($name, $enumConstants);
        }

        return self::make($enum);
    }
}
