<?php

declare(strict_types=1);

namespace App\Core\ValueObject;

use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

abstract class ValueObject implements \JsonSerializable, \Stringable, NormalizableInterface
{
    abstract public function get();

    public function jsonSerialize()
    {
        return $this->get();
    }

    public function normalize(NormalizerInterface $normalizer, string $format = null, array $context = []): mixed
    {
        return $this->get();
    }

    public function __toString(): string
    {
        return (string)$this->get();
    }
}
