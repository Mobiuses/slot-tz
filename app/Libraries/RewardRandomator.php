<?php


namespace App\Libraries;

use App\Models\RewardEntity;
use App\RewardEntities\CashReward;
use App\RewardEntities\RewardInterface;
use Exception;
use Illuminate\Support\Collection;

class RewardRandomator
{
    /**
     * @param Collection $rewards
     * @return Collection|mixed
     * @throws Exception
     */
    public function getRandomRewardEntity(Collection $rewards): RewardInterface
    {
        if ($rewards->isEmpty()) {
            throw new Exception('None rewards available');
        }
        $wonReward = $rewards->random();

        return (new $wonReward->entity);
    }
}
