<?php
/** @noinspection ALL */

declare(strict_types=1);

use App\Rota;
use App\Shift;
use App\SingleManningCalculator;

class SingleManningCalculatorTest extends \PHPUnit\Framework\TestCase
{
    public function test_one()
    {
        $today = new DateTime('today');
        $tomorrow = new DateTime('tomorrow');

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

        $singleManning = SingleManningCalculator::calculateSingleManning($rota);

        dd($singleManning);

        $this->assertEquals(300, $singleManning);
    }

    private function todayAddHours(int $hours): DateTime
    {
        return (new DateTime('today'))
            ->add(new DateInterval('PT' . $hours . 'H'));
    }

    private function tomorrowAddHours(int $hours): DateTime
    {
        return (new DateTime('tomorrow'))
            ->add(new DateInterval('PT' . $hours . 'H'));
    }
}
