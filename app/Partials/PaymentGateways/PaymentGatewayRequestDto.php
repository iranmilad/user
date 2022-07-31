<?php


namespace App\Partials\PaymentGateways;


class PaymentGatewayRequestDto
{
    public $paymentType;
    public $guId;
    public $amount;
    public $description;
    public $userEmail;
    public $userMobile;
}
