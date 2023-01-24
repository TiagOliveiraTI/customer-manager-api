<?php

declare(strict_types=1);

namespace App\Domain\Entities;

class Document
{
    private string $number;

    public function __construct(string $number)
    {
        $cleanedNumber = preg_replace('/[^0-9]/', '', $number);
        if (!preg_match('/^[0-9]{11}$/', $cleanedNumber) || !self::isValid($cleanedNumber)) {
            throw new InvalidArgumentException('Invalid CPF format');
        }
        $this->number = $cleanedNumber;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getFormattedNumber(): string
    {
        return substr($this->number, 0, 3) . '.' .
            substr($this->number, 3, 3) . '.' .
            substr($this->number, 6, 3) . '-' .
            substr($this->number, 9, 2);
    }

    private static function isValid(string $number): bool
    {
        $num = preg_replace('/[^\d]/', '', $number);
        if (strlen($num) != 11) {
            return false;
        }
        for ($i = 0, $j = 10, $sum = 0; $i < 9; $i++, $j--) {
            $sum += $num[$i] * $j;
        }
        $rest = $sum % 11;
        if ($num[9] != ($rest < 2 ? 0 : 11 - $rest)) {
            return false;
        }
        for ($i = 0, $j = 11, $sum = 0; $i < 10; $i++, $j--) {
            $sum += $num[$i] * $j;
        }
        $rest = $sum % 11;
        return ($num[10] == ($rest < 2 ? 0 : 11 - $rest));
    }
}
