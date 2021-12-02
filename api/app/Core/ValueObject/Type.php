<?php

declare(strict_types=1);

namespace App\Core\ValueObject;

/**
 * @method static Type NULL()
 * @method static Type BOOL()
 * @method static Type STRING()
 * @method static Type INT()
 * @method static Type FLOAT()
 * @method static Type ARRAY()
 * @method static Type OBJECT()
 * @method static Type CALLABLE()
 */
class Type extends Enum
{
    public const NULL = 'null';
    public const BOOL = 'boolean';
    public const STRING = 'string';
    public const INT = 'integer';
    public const FLOAT = 'float';
    public const ARRAY = 'array';
    public const OBJECT = 'object';
    public const CALLABLE = 'callable';

    public static function isValueTypeOf(mixed $value, null|string|self $type): bool
    {
        $type = $type instanceof Type ? $type->get() : $type;
        switch ($type) {
            case self::STRING:
                $isValueTypeOf = is_string($value);
                break;
            case self::INT:
                $isValueTypeOf = is_int($value);
                break;
            case self::FLOAT:
                $isValueTypeOf = is_float($value);
                break;
            case self::BOOL:
                $isValueTypeOf = is_bool($value);
                break;
            case self::ARRAY:
                $isValueTypeOf = is_array($value);
                break;
            case self::OBJECT:
                $isValueTypeOf = is_object($value);
                break;
            case self::CALLABLE:
                $isValueTypeOf = is_callable($value);
                break;
            case self::NULL:
                $isValueTypeOf = is_null($value);
                break;
            case class_exists($type) || interface_exists($type):
                $isValueTypeOf = $value instanceof $type;
                break;
            default:
                $isValueTypeOf = true;
                break;
        }

        return $isValueTypeOf;
    }
}
