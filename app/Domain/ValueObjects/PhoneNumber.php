<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

class PhoneNumber
{
    private $number;

    public function __construct(string $number)
    {
        $cleanedNumber = preg_replace('/[^0-9]/', '', $number);
        if (!preg_match('/^\(?[0-9]{2}\)?[0-9]{8,9}$/', $cleanedNumber)) {
            throw new InvalidArgumentException('Invalid phone number format');
        }
        $this->number = $cleanedNumber;
    }

    public function getNumber(): string
    {
        return $this->number;
    }
}
