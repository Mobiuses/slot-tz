<?php


namespace App\RewardEntities;


use App\Models\Reward;
use App\Models\RewardEntity;
use App\Models\RewardItem;
use App\RewardTransports\CreditCardPayment;
use App\RewardTransports\RewardTransportInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemReward extends BaseReward
{
    /**
     * @return $this
     */
    public function spin()
    {
        $item = RewardItem::inRandomOrder()->first();
        $reward = null;
        $data = [
            'amount' => $this->getAmount(),
            'status' => Reward::PENDING_STATUS,
            'user_id' => Auth::user()->id
        ];
        DB::transaction(function () use ($item, &$reward, $data) {
            $reward = RewardEntity::where('entity', self::class)->first()->rewards()->create($data);
            $reward->rewardItem()->associate($item)->save();
        });

        $this->reward = $reward;

        return $this;
    }

    /**
     * @return int
     */
    private function getAmount(): int
    {
        if (is_null($this->amount)) {
            $this->amount = 1;
        }

        return $this->amount;
    }
}
