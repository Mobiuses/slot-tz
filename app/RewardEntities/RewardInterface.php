<?php


namespace App\RewardEntities;

use App\RewardTransports\RewardTransportInterface;

interface RewardInterface
{

    public function spin();

    public function transferRewardProcess(RewardTransportInterface $transport);
}
