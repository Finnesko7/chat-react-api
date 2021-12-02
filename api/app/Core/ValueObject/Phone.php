<?php

declare(strict_types=1);

namespace App\Core\ValueObject;

use App\Core\ValueObject\Exception\InvalidPhoneNumberException;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberUtil;

class Phone extends ValueObject
{
    protected PhoneNumber $phoneNumber;

    /**
     * @throws InvalidPhoneNumberException
     */
    protected function __construct(string $number)
    {
        if ('' === $number) {
            throw InvalidPhoneNumberException::emptyPhone();
        }
        $phoneNumberUtil = PhoneNumberUtil::getInstance();
        try {
            $phoneNumber = $phoneNumberUtil->parse($number);
        } catch (NumberParseException) {
            throw InvalidPhoneNumberException::invalidFormat($number);
        }
        if ($phoneNumber === null || !$phoneNumberUtil->isValidNumber($phoneNumber)) {
            throw InvalidPhoneNumberException::invalidFormat($number);
        }
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @throws InvalidPhoneNumberException
     */
    public static function fromString(string $number): static
    {
        return new static($number);
    }

    public function get(): PhoneNumber
    {
        return $this->phoneNumber;
    }

    public function getNumber(): string
    {
        return sprintf('+%s%s', $this->phoneNumber->getCountryCode(), $this->phoneNumber->getNationalNumber());
    }

    public function jsonSerialize(): string
    {
        return $this->getNumber();
    }

    public function __toString(): string
    {
        return $this->getNumber();
    }
}
