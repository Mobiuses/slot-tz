<?php


namespace App\RewardEntities;


use App\Models\Reward;
use App\Models\RewardEntity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BonusPointsReward extends BaseReward
{
    /**
     * @const int
     */
    const MIN = 50;

    /**
     * @const int
     */
    const MAX = 1000000;

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
}
