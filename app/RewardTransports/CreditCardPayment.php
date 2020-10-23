<?php


namespace App\RewardTransports;


use App\Models\User;
use App\RewardEntities\RewardInterface;

class CreditCardPayment extends BaseTransport
{
    /**
     * @var array
     */
    private $cardInfo;

    /**
     * CreditCardPayment constructor.
     * @param RewardInterface $reward
     * @param User $user
     * @param array $cardInfo
     */
    public function __construct(RewardInterface $reward, User $user, array $cardInfo)
    {
        parent::__construct($reward, $user);

        $this->cardInfo = $cardInfo;
    }

    /**
     * payment process
     */
    public function process()
    {
//      TODO: implement logic here or create and dispatch job
//          Example from privat bank api
//
//        $liqpay = new LiqPay($public_key, $private_key);
//        $res = $liqpay->api("request", array(
//            'action'         => 'p2pcredit',
//            'version'        => '3',
//            'amount'         => '1',
//            'currency'       => 'USD',
//            'description'    => 'description text',
//            'order_id'       => 'order_id_1',
//            'receiver_card'  => $cardInfo['card'],
//            'receiver_last_name'   => $cardInfo['last_name'],
//            'receiver_first_name'  => $cardInfo['first_name']
//        ));
    }
}
