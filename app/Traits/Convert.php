<?php


namespace App\Traits;


use App\Models\Reward;
use App\Models\RewardEntity;
use App\RewardEntities\BonusPointsReward;
use App\RewardEntities\CashReward;
use App\RewardEntities\Convertable;

trait Convert
{
    /**
     * @param RewardEntity $rewardEntity
     * @param Reward $reward
     */
    public function convert(RewardEntity $rewardEntity, Reward $reward)
    {
        if ($this instanceof Convertable) {
            $method = 'to' . class_basename($rewardEntity->entity);
            $this->$method($reward);
        }
    }
}
