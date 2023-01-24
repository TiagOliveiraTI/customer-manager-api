<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use DateTime;
use InvalidArgumentException;

class BirthDate
{
    private DateTime $date;

    public function __construct(string $date)
    {
        $date = date_create_from_format('Y-m-d', $date);
        if (!$date) {
            throw new InvalidArgumentException('Invalid date format', 400);
        }

        $now = new DateTime();
        if ($date > $now) {
            throw new InvalidArgumentException('Future date is not allowed', 400);
        }

        $this->date = $date;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getAge(): int
    {
        $now = new DateTime();
        $interval = $now->diff($this->date);
        return $interval->y;
    }

    public function getFormattedDate(): string
    {
        return $this->date->format('d/m/Y');
    }
}
