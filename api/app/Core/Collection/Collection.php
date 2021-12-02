<?php

declare(strict_types=1);

namespace App\Core\Collection;

use App\Core\Exception\InfrastructureException;
use App\Core\Exception\NotAllowedCollectionItemException;
use App\Core\ValueObject\Type;
use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Symfony\Component\Serializer\Normalizer\DenormalizableInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class Collection implements IteratorAggregate, ArrayAccess, Countable, NormalizableInterface, DenormalizableInterface
{
    public const EMPTY_COLLECTION = 0;

    /**
     * @var string|null for all types use null
     */
    protected ?string $allowedType = null;

    protected array $items;

    /**
     * @throws NotAllowedCollectionItemException
     */
    public function __construct(array $items = [])
    {
        if ($this->allowedType !== null) {
            foreach ($items as $item) {
                $this->validateIncomingItem($item);
            }
        }
        $this->items = $items;
    }

    /**
     * @throws InfrastructureException
     */
    public function normalize(NormalizerInterface $normalizer, string $format = null, array $context = []): mixed
    {
        try {
            $normalizedData = [];
            foreach ($this->items as $key => $item) {
                $normalizedKey = is_object($key) ? $normalizer->normalize($key, $format, $context) : $key;
                if (is_array($normalizedKey)) {
                    $normalizedKey = json_encode($normalizedKey);
                }
                $normalizedData[$normalizedKey] = $normalizer->normalize($item, $format, $context);
            }
        } catch (\Throwable $exception) {
            throw InfrastructureException::fromUnexpectedThrowable($exception);
        }

        return $normalizedData;
    }

    /**
     * @throws InfrastructureException
     */
    public function denormalize(
        DenormalizerInterface $denormalizer,
        mixed $data,
        string $format = null,
        array $context = []
    ): static {
        try {
            if (class_exists((string)$this->allowedType) && is_array($data)) {
                foreach ($data as $item) {
                    $this->add($denormalizer->denormalize($item, $this->allowedType, $format, $context));
                }
            } elseif (is_array($data)) {
                $this->items = $data;
            } else {
                $this->items = $denormalizer->denormalize($data, $this->allowedType, $format, $context);
            }
        } catch (\Throwable $exception) {
            throw InfrastructureException::fromUnexpectedThrowable($exception);
        }

        return $this;
    }

    /**
     * @throws NotAllowedCollectionItemException
     */
    public function add($item): void
    {
        $this->validateIncomingItem($item);
        $this->items[] = $item;
    }

    /**
     * @throws NotAllowedCollectionItemException
     */
    public function merge(self $collectionForMerge): void
    {
        foreach ($collectionForMerge as $itemOffset => $item) {
            $this->offsetExists($itemOffset) ? $this->add($item) : $this->offsetSet($itemOffset, $item);
        }
    }

    public function map(callable $callback): array
    {
        return array_map($callback, $this->items);
    }

    /**
     * @throws NotAllowedCollectionItemException
     */
    public function filter(?callable $callback = null): self
    {
        $filteredItems = $callback !== null ? array_filter($this->items, $callback) : array_filter($this->items);
        return new static($filteredItems);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function isEmpty(): bool
    {
        return $this->count() === self::EMPTY_COLLECTION;
    }

    public function toArray(): array
    {
        return $this->items;
    }

    public function offsetSet($offset, $newItem): void
    {
        $this->validateIncomingItem($newItem);
        $this->items[$offset] = $newItem;
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet($offset)
    {
        return $this->items[$offset] ?? null;
    }

    public function offsetUnset($offset): void
    {
        if ($this->offsetExists($offset)) {
            unset($this->items[$offset]);
        }
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @throws NotAllowedCollectionItemException
     */
    private function validateIncomingItem($item): void
    {
        if ($this->allowedType === null) {
            return;
        }
        $isItemAllowed = Type::isValueTypeOf($item, $this->allowedType);
        if (! $isItemAllowed) {
            throw NotAllowedCollectionItemException::collectionCantContainItem(
                get_class($this),
                $this->allowedType,
                $item,
            );
        }
    }
}
