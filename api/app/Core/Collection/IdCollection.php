<?php

declare(strict_types=1);

namespace App\Core\Collection;

use App\Core\ValueObject\Id;

class IdCollection extends Collection
{
    protected ?string $allowedType = Id::class;

    public static function fromScalarArray(array $ids): self
    {
        $idsCollection = new static();
        foreach ($ids as $id) {
            $idsCollection->add(Id::make((int)$id));
        }

        return $idsCollection;
    }

    public function asArray(): array
    {
        return $this->map(static function (Id $id) {
            return $id->get();
        });
    }
}
