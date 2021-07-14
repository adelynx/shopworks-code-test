<?php

declare(strict_types=1);

namespace App;

use DateTime;

class Rota
{
    public DateTime $weekCommenceDate;

    public array $shifts;

    /**
     * Rota constructor.
     *
     * @param DateTime $weekCommenceDate
     * @param array $shifts
     */
    public function __construct(DateTime $weekCommenceDate, array $shifts)
    {
        $this->weekCommenceDate = $weekCommenceDate;
        $this->shifts = $shifts;
    }
}
