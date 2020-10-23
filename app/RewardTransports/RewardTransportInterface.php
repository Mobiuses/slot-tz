<?php


namespace App\RewardTransports;


interface RewardTransportInterface
{
    /**
     * @return mixed
     */
    public function process();
}
