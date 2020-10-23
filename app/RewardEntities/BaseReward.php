<?php


namespace App\RewardEntities;


use App\Models\Reward;
use App\RewardTransports\RewardTransportInterface;

abstract class BaseReward implements RewardInterface
{
    /**
     * @var RewardInterface
     */
    public $reward;

    /**
     * @var int
     */
    public $amount;

    /**
     * BaseReward constructor.
     * @param Reward $reward
     */
    public function __construct(Reward $reward = null)
    {
        $this->reward = $reward;
    }

    /**
     * @param RewardTransportInterface $transfer
     */
    public function transferRewardProcess(RewardTransportInterface $transfer)
    {
        $transfer->process();
    }

    /**
     * @return bool
     */
    protected function availableInStock(): bool
    {
        if ($this->reward->rewardEntity->unlimited) {
            return true;
        }

        if ($this->amount <= $this->reward->checkLimit()) {
            return true;
        }

        return false;
    }
}
