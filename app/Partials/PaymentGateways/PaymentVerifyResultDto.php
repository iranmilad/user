<?php


namespace App\Partials\PaymentGateways;


use Carbon\Carbon;

class PaymentVerifyResultDto
{
    public $refId;
    public $status;
    public $isSuccess;
    public $state;
    public $description;

}
