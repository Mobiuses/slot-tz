<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('amount');
            $table->enum('status', ['pending', 'declined', 'waiting_to_transfer', 'transferring', 'transferred']);
            $table->bigInteger('reward_entity_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('reward_item_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('reward_entity_id')->references('id')->on('reward_entities');
            $table->foreign('reward_item_id')->references('id')->on('reward_items');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewards');
    }
}
