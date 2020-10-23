<?php

namespace App\Libraries;

class RewardConverter
{
    /**
     * @param int $cash
     * @param float $multiplier
     * @return int
     */
    public function cashToBonusPoints(int $cash, float $multiplier): int
    {
        return floor($cash * $multiplier);
    }
}
