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
    public static function calculateSingleManning(Rota $rota): SingleManningList
    {
        $groupShiftsByDay = self::groupShiftsByDay($rota); // Complexity: n
        $singleManningList = [];

        foreach ($groupShiftsByDay as $day => $shift) {
            $singleManning = self::calculateSingleManningInShiftsList($shift); // complexity: n log (n) + n

            $singleManningList[$day] = $singleManning;
        }

        return new SingleManningList($singleManningList);
    }

    /**
     * @param array $shifts
     *
     * @return int
     */
    public static function calculateSingleManningInShiftsList(array $shifts): int
    {
        if (count($shifts) === 0) {
            return 0;
        }

        if (count($shifts) === 1) {
            return self::getTotalMinutes($shifts[0]->endTime - $shifts[0]->startTime);
        }

        $orderedShiftsByStartTime = self::orderShiftsByStartTime($shifts); // Complexity:  O(n log n) (quick sort algorithm)
        $singleManning = 0;

        $currentShift = $orderedShiftsByStartTime[0];

        array_shift($orderedShiftsByStartTime); // remove first shift

        do {
            $nextShift = $orderedShiftsByStartTime[0];

            array_shift($orderedShiftsByStartTime);

            $singleManning += self::maxInterval($nextShift->startTime, $currentShift->startTime);
            $currentShift->startTime = self::minTime($currentShift->endTime, $nextShift->endTime);
            $currentShift->endTime = self::maxTime($currentShift->endTime, $nextShift->endTime);
        } while (count($orderedShiftsByStartTime) > 0); // Complexity: n

        $singleManning += self::getTotalMinutes($currentShift->endTime->diff($currentShift->startTime));

        return $singleManning; // TotalComplexity: n log (n) + n
    }
}
