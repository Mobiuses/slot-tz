<?php


namespace App\RewardTransports;


use App\Models\User;
use App\RewardEntities\CashReward;
use App\RewardEntities\RewardInterface;

abstract class BaseTransport implements RewardTransportInterface
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var CashReward
     */
    protected $reward;

    /**
     * CreditCardPayment constructor.
     * @param RewardInterface $reward
     * @param User $user
     */
    public function __construct(RewardInterface $reward, User $user)
    {
        $this->user = $user;
        $this->reward = $reward;
    }
}
