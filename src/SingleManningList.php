<?php

declare(strict_types=1);

namespace App;

class SingleManningList
{
    public array $singleManningList;

    /**
     * SingleManning constructor.
     *
     * @param array $singleManningList
     */
    public function __construct(array $singleManningList)
    {
        $this->singleManningList = $singleManningList;
    }
}
