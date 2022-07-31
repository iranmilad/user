<?php


namespace App\Partials\PaymentGateways;


use App\Constants\PaymentStates;
use App\Interfaces\IPaymentGateway;

class ZarinPal implements IPaymentGateway
{

    private $bank = 1;

    public function requestPay(PaymentGatewayRequestDto $result)
    {
        $merchantID = env("ZAINPALL_MERCHANTID","XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX"); //Required

        $CallbackURL = asset('/payment-gateway/verify/' . $result->guId . '/' . $this->bank); // Required

        if (env('APP_DEBUG')=="true")
            $client = new \SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        else
            $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $merchantID,
                'Amount' => $result->amount,
                'Description' => $result->description,
                'Email' => $result->userEmail,
                'Mobile' => $result->userMobile,
                'CallbackURL' => $CallbackURL,
            ]
        );

        $resultDto = new \stdClass();
        if ($result->Status == 100) {
            if (env('APP_DEBUG')=="true")
                $resultDto->url = 'https://sandbox.zarinpal.com/pg/StartPay/' . $result->Authority;
            else
                $resultDto->url = 'https://www.zarinpal.com/pg/StartPay/' . $result->Authority;
            $resultDto->isSuccess = true;
        } else {
            $resultDto->isSuccess = false;
            $resultDto->message = 'ERR: ' . $result->Status;
        }
        return $resultDto;
    }

    public function verify($guId, $amount)
    {
        $merchantID = env("ZAINPALL_MERCHANTID","XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX"); //Required

        $authority = $_GET['Authority'];
        $status = $_GET['Status'];

        $resultDto = new PaymentVerifyResultDto();

        if ($status == 'OK') {
            if (env('APP_DEBUG')=="true")
                $client = new \SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
            else
                $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $merchantID,
                    'Authority' => $authority,
                    'Amount' => $amount,
                ]
            );
            $resultDto->status = $result->Status;
            if ($result->Status == 100) {
                $resultDto->isSuccess = true;
                $resultDto->refId = $result->RefID;
                $resultDto->state = PaymentStates::SUCCESS;
                $resultDto->description = "تراکنش موفق";
            } else {
                $resultDto->isSuccess = false;
                $resultDto->state = PaymentStates::ERROR;
                $resultDto->refId = null;
                $resultDto->description ="خطایی در انجام تراکنش رخ داده اشت.";
            }
        } else {
            $resultDto->isSuccess = false;
            $resultDto->refId = null;
            $resultDto->status = null;
            $resultDto->state = PaymentStates::CANCELED;
            $resultDto->description = "تراکنش توسط کاربر لغو شد.";
        }
        return $resultDto;
    }
}
