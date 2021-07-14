<?php

declare(strict_types=1);

namespace App;

use DateTime;
use InvalidArgumentException;

class Shift
{
    public DateTime $startTime;

    public DateTime $endTime;

    public string $staffName;

    /**
     * Shift constructor.
     *
     * @param DateTime $startTime
     * @param DateTime $endTime
     * @param string $staffName
     */
    public function __construct(DateTime $startTime, DateTime $endTime, string $staffName)
    {
        if ($endTime <= $startTime) {
            throw new InvalidArgumentException('End time must be greater than start time.');
        }

        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->staffName = $staffName;
    }

    /**
     * Get shift payload.
     *
     * @return array
     */
    public function get(): array
    {
        return [
            'staff_name' => $this->staffName,
            'start_time' => $this->startTime,
            'end_time'   => $this->endTime,
        ];
    }
}
