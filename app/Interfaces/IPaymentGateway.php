<?php


namespace App\Interfaces;



use App\Partials\PaymentGateways\PaymentGatewayRequestDto;

interface IPaymentGateway
{
    public function requestPay(PaymentGatewayRequestDto $result);

    public function verify($guId, $amount);


}
