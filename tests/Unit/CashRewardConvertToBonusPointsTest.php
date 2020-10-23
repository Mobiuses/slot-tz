<?php

namespace Tests\Unit;

use App\Libraries\RewardConverter;
use App\RewardEntities\CashReward;
use PHPUnit\Framework\TestCase;

class CashRewardConvertToBonusPointsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $converter = new RewardConverter;
        $this->assertEquals(150, $converter->cashToBonusPoints(100, CashReward::TO_BONUS_POINTS_MULTIPLIER));
    }
}
