<?php

namespace App\RewardEntities;

use App\Models\Reward;
use App\Models\RewardEntity;

interface Convertable
{
    public function convert(RewardEntity $rewardEntity, Reward $reward);
}
