<?php

namespace App\Console\Commands;

use App\Models\Reward;
use App\Models\RewardEntity;
use App\RewardEntities\CashReward;
use App\RewardTransports\CreditCardPayment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class SendCashRewards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cash-reward:send {--n=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send unprocessed cash rewards to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit = $this->option('n');
         $unprocessedCashRewards = RewardEntity::where('entity', CashReward::class)
            ->first()
            ->rewards()
            ->where('status', Reward::WAITING_TO_TRANSFER_STATUS)
            // TODO: where user has card details info
            ->limit($limit)
            ->get();

        foreach ($unprocessedCashRewards as $reward) {
            $rewardEntity = new $reward->rewardEntity->entity($reward);

            $userCardInfo = [
                // TODO: get user card info from user account $reward->user->getCardDetails();
            ];

            $newTransfer = new CreditCardPayment($rewardEntity, $reward->user, $userCardInfo);

            $reward->status = Reward::TRANSFERRING_STATUS;
            $reward->save();

            $rewardEntity->transferRewardProcess($newTransfer);
        }

        die('Processed rows: ' . $unprocessedCashRewards->count());
    }
}
