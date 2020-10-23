<?php

namespace App\Http\Controllers;

use App\Facades\RewardRandomator;
use App\Models\Reward;
use App\Models\RewardEntity;
use App\RewardEntities\Convertable;
use App\RewardTransports\CreditCardPayment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    /**
     * roll and get a reward
     */
    public function roll()
    {
        $availableRewards = RewardEntity::get();
        $preparedReward = RewardRandomator::getRandomRewardEntity($availableRewards);
        $wonReward = $preparedReward->spin();

        return response()->json($wonReward);
    }

    /**
     * @param Reward $reward
     * @return JsonResponse
     */
    public function transfer(Reward $reward)
    {
        $rewardEntity = new $reward->rewardEntity->entity($reward);

        $newTransfer = new CreditCardPayment($rewardEntity, $reward->user, [
            'receiver_card' => 6666666666666666,
            'receiver_last_name' => 'Musk',
            'receiver_first_name' => 'Elon',
        ]);

        $reward->status = Reward::TRANSFERRING_STATUS;

        $rewardEntity->transferRewardProcess($newTransfer);

        return response()->json(['status' => 'processing']);
    }

    public function convert(Reward $reward, RewardEntity $rewardEntity)
    {
        $rewardClass = new $reward->rewardEntity->entity($reward);
        if ($rewardClass instanceof Convertable) {
            $rewardClass->convert($rewardEntity, $reward);
        }

        return response()->json($reward);
    }
}
