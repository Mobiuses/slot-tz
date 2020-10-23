<?php


namespace App\RewardEntities;

use App\Facades\RewardConverter;
use App\Models\Reward;
use App\Models\RewardEntity;
use App\RewardTransports\RewardTransportInterface;
use App\Traits\Convert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashReward extends BaseReward implements Convertable
{
    use Convert;

    /**
     * bonus points *= multiplier
     */
    const TO_BONUS_POINTS_MULTIPLIER = 1.5;

    /**
     * @const int
     */
    const MIN = 50;

    /**
     * @const int
     */
    const MAX = 1000000;

    /**
     * @todo implement currency logic if needed: exchange, etc.
     *
     * @const string
     */
    const CURRENCY = 'usd';

    /**
     * spin reward process
     */
    public function spin()
    {
        $this->amount = rand(self::MIN, self::MAX);
        $data = [
            'amount' => $this->amount,
            'status' => Reward::PENDING_STATUS,
            'user_id' => Auth::user()->id
        ];

        RewardEntity::where('entity', self::class)->first()->rewards()->create($data);

        return $this;
    }

    public function toBonusPointsReward(Reward $reward)
    {
        $rewardEntity = RewardEntity::where('entity', BonusPointsReward::class)->first();

        $reward->setAmount(RewardConverter::cashToBonusPoints($reward->getAmount(), CashReward::TO_BONUS_POINTS_MULTIPLIER));
        $reward->rewardEntity()->associate($rewardEntity);
        $reward->save();
    }
}
