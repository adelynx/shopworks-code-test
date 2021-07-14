<?php

declare(strict_types=1);

namespace App;

use DateInterval;
use DateTime;

trait SingleManningCalculatorTrait
{
    /**
     * @param array $shifts
     *
     * @return array
     */
    private static function orderShiftsByStartTime(array $shifts): array
    {
        $groupedShiftsByStartTime = [];

        foreach ($shifts as $shift) {
            $startTime = $shift['start_time'];
            $groupedShiftsByStartTime[$startTime][] = $shift;
        }

        return $groupedShiftsByStartTime;
    }

    /**
     * Return shifts payload grouped by day
     *
     * @param Rota $rota
     *
     * @return array
     */
    private static function groupShiftsByDay(Rota $rota): array
    {
        $groupedShiftsByDay = [];

        foreach ($rota->shifts as $shift) {
            $day = $shift->startTime->format('d/m/Y');
            $groupedShiftsByDay[$day][] = $shift;
        }

        return $groupedShiftsByDay;
    }

    /**
     * @param DateInterval $dateInterval
     *
     * @return int
     */
    private static function getTotalMinutes(DateInterval $dateInterval): int
    {
        return ($dateInterval->d * 24 * 60) + ($dateInterval->h * 60) + $dateInterval->i;
    }

    /**
     * @param DateTime $firstValue
     * @param DateTime $secondValue
     *
     * @return DateTime
     */
    private static function minTime(DateTime $firstValue, DateTime $secondValue): DateTime
    {
        return $firstValue < $secondValue ? $firstValue : $secondValue;
    }

    /**
     * @param DateTime $firstValue
     * @param DateTime $secondValue
     *
     * @return DateTime
     */
    private static function maxTime(DateTime $firstValue, DateTime $secondValue): DateTime
    {
        return $firstValue > $secondValue ? $firstValue : $secondValue;
    }
}
