<?php

namespace Database\Seeders;

use App\Models\Reward;
use App\Models\RewardEntity;
use App\Models\RewardItem;
use App\Models\User;
use App\RewardEntities\BonusPointsReward;
use App\RewardEntities\CashReward;
use App\RewardEntities\ItemReward;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create();

        $entities = [
            CashReward::class,
            BonusPointsReward::class,
            ItemReward::class
        ];

        foreach ($entities as $entity) {
            RewardEntity::create(['entity' => $entity, 'unlimited' => $entity === BonusPointsReward::class ? 1 : 0]);
        }

        $rewardItems = [
            [
                'title' => 'Item 1',
                'available_amount' => 10,
            ],
            [
                'title' => 'Item 2',
                'available_amount' => 10,
            ],
            [
                'title' => 'Item 3',
                'available_amount' => 10,
            ],
            [
                'title' => 'Item 4',
                'available_amount' => 10,
            ],
            [
                'title' => 'Item 5',
                'available_amount' => 10,
            ],
        ];

        foreach ($rewardItems as $reward) {
            $entity = new RewardItem;

            foreach ($reward as $column => $value) {
                $entity->$column = $value;
            }

            $entity->save();
        }
    }
}
