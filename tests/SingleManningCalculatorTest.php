<?php

declare(strict_types=1);

namespace Test;

use App\Rota;
use App\Shift;
use App\SingleManningCalculator;
use App\SingleManningList;
use DateTime;
use InvalidArgumentException;

class SingleManningCalculatorTest extends TestCase
{
    public function test_scenario_one()
    {
        $startTime = new DateTime('2021-07-05 08:00:00.0');
        $endTime = new DateTime('2021-07-05 17:00:00.0');

        $rota = new Rota(
            new DateTime('2021-07-01'),
            [
                new Shift($startTime, $endTime, 'Black Widow')
            ]
        );

        $expected = new SingleManningList(
            [
                '05-07-2021' => 540
            ]
        );

        $singleManning = SingleManningCalculator::calculateSingleManning($rota);

        $this->assertEquals($expected, $singleManning);
    }

    public function test_should_throw_invalid_argument_exception_if_start_time_greater_than_end_time()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('End time must be greater than start time.');

        $startTime = new DateTime('2021-07-05 17:00:00.0');
        $endTime = new DateTime('2021-07-05 08:00:00.0');

        new Rota(
            new DateTime('2021-07-01'),
            [
                new Shift($startTime, $endTime, 'Black Widow')
            ]
        );
    }

    public function test_scenario_two()
    {
        $blackWidowStartTime = new DateTime('2021-07-06 08:00:00.0');
        $blackWidowEndTime = new DateTime('2021-07-06 12:00:00.0');

        $thorStartTime = new DateTime('2021-07-06 12:00:00.0');
        $thorEndTime = new DateTime('2021-07-06 17:00:00.0');

        $rota = new Rota(
            new DateTime('2021-07-01'),
            [
                new Shift($blackWidowStartTime, $blackWidowEndTime, 'Black Widow'),
                new Shift($thorStartTime, $thorEndTime, 'Thor'),
            ]
        );

        $expected = new SingleManningList(
            [
                '06-07-2021' => 540
            ]
        );

        $singleManning = SingleManningCalculator::calculateSingleManning($rota);

        $this->assertEquals($expected, $singleManning);
    }

    public function test_scenario_three()
    {
        $wolverineStartTime = new DateTime('2021-07-07 08:00:00.0');
        $wolverineEndTime = new DateTime('2021-07-07 14:00:00.0');

        $gamoraStartTime = new DateTime('2021-07-07 09:00:00.0');
        $gamoraEndTime = new DateTime('2021-07-07 17:00:00.0');

        $rota = new Rota(
            new DateTime('2021-07-01'),
            [
                new Shift($wolverineStartTime, $wolverineEndTime, 'Wolverine'),
                new Shift($gamoraStartTime, $gamoraEndTime, 'Gamora'),
            ]
        );

        $expected = new SingleManningList(
            [
                '07-07-2021' => 240
            ]
        );

        $singleManning = SingleManningCalculator::calculateSingleManning($rota);

        $this->assertEquals($expected, $singleManning);
    }

    public function test_multiples_shifts_in_rota_with_today_date_and_tomorrow_date()
    {
        $rota = new Rota(
            new DateTime('2021-07-01'),
            [
                new Shift($this->todayAddHours(8), $this->todayAddHours(12), 'Black Widow'),
                new Shift($this->todayAddHours(9), $this->todayAddHours(10), 'Thor'),
                new Shift($this->tomorrowAddHours(8), $this->tomorrowAddHours(12), 'Wolverine'),
                new Shift($this->tomorrowAddHours(9), $this->tomorrowAddHours(10), 'Gamora'),
                new Shift($this->tomorrowAddHours(11), $this->tomorrowAddHours(13), 'Black Widow'),

            ]
        );

        $expected = new SingleManningList(
            [
                '15-07-2021' => 180,
                '16-07-2021' => 180,
            ]
        );

        $singleManning = SingleManningCalculator::calculateSingleManning($rota);

        $this->assertEquals($expected, $singleManning);
    }
}
