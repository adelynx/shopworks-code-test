<?php

declare(strict_types=1);

namespace App;

class SingleManningCalculator
{
    use SingleManningCalculatorTrait;

    /**
     * @param Rota $rota
     *
     * @return SingleManningList
     */
    public static function calculateSingManning(Rota $rota): SingleManningList
    {
        $groupShiftsByDay = self::groupShiftsByDay($rota); // Complexity: n
        $singleManningList = [];

        foreach ($groupShiftsByDay as $day => $shift) {
            $singleManning = self::calculateSingleManning($shift); // complexity: n log (n) + n

            $singleManningList[$day] = $singleManning;
        }

        return new SingleManningList($singleManningList);
    }

    /**
     * @param array $shifts
     *
     * @return int
     */
    public static function calculateSingleManning(array $shifts): int
    {
        if (count($shifts) === 0) {
            return 0;
        }

        if (count($shifts) === 1) {
            return self::getTotalMinutes($shifts[0]['end_time'] - $shifts[0]['start_time']);
        }

        $orderedShiftsByStartTime = self::orderShiftsByStartTime($shifts); // Complexity:  O(n log n)
        $singleManning = 0;
        $currentShift = $shifts[0];

        array_shift($shifts); // remove first shift

        do {
            $nextShift = $shifts[0];

            array_shift($shifts);

            $singleManning += max($nextShift['start_time'] - $currentShift['start_time'], 0);
            $currentShift['start_time'] = self::minTime($currentShift['end_time'], $nextShift['end_time']);
            $currentShift['end_time'] = self::maxTime($currentShift['end_time'], $nextShift['end_time']);
        } while (count($orderedShiftsByStartTime) > 0); // Complexity: n

        $singleManning = $singleManning + $currentShift['end_time'] - $currentShift['start_time'];

        return self::getTotalMinutes($singleManning); // TotalComplexity: n log (n) + n
    }
}
