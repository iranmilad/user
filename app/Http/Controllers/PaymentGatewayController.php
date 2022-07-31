<?php

namespace App\Http\Controllers;

use App\Constants\PaymentGatewayBanks;
use App\Constants\PaymentStates;
use App\Constants\PaymentTypes;
use App\Http\Requests\PaymentGatewayRequestPayRequest;
use App\Interfaces\IPaymentGateway;
use App\Models\Payment;
use App\Models\Subscribe;
use App\Models\User;
use App\Models\UserSubscribe;
use App\Partials\PaymentGateways\PaymentGatewayRequestDto;
use App\Partials\PaymentGateways\ZarinPal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use stdClass;

class PaymentGatewayController extends Controller
{
    
    public function requestPay(PaymentGatewayRequestPayRequest $request)
    {
        $bank = $request->input("bank", 1);
        $referenceId = $request->input('reference_id');
        $type = $request->input('type',1);
       

        if (auth()->check()) {
            $user = auth()->user();
        } else {
          return $this->responseJson("ابتدا وارد حساب کاربری شوید.",null,401);
        }

        $reference = $this->checkReference($referenceId, $type, $user);

        if (!$reference) {
            if (request()->wantsJson()) {
                return $this->responseJson("خطایی رخ داده است",null,401);
            }
        } elseif ($reference->message) {
            if (request()->wantsJson()) {
                return $this->responseJson($reference->message,null,401);
            }
        }


        $guId=uniqid();
        $amount=$reference->price;
        Payment::create([
            "gu_id"=> $guId,
            "user_id"=>$user->id,
            "reference_id"=>$referenceId,
            "amount"=>$amount,
            "type"=>$type,
            "state"=>PaymentStates::PENDING
        ]);

        $paymentGatewayRequestDto = new PaymentGatewayRequestDto();
        $paymentGatewayRequestDto->guId =  $guId;
        $paymentGatewayRequestDto->amount = $amount;
        $paymentGatewayRequestDto->userMobile = $user->mobile;
        $paymentGatewayRequestDto->userEmail = $user->email;
        $paymentGatewayRequestDto->paymentType = $type;
        $paymentGatewayRequestDto->description = "خرید اشتراک";

        $paymentGateway = null;
        if ($bank == PaymentGatewayBanks::ZARINPALL) {
            $paymentGateway = new ZarinPal();
        }
        $result = $this->request($paymentGateway, $paymentGatewayRequestDto);

        if (request()->wantsJson()) {
            return $this->responseJson("", $result);
        }
        return Redirect::to($result->data);
    }

    protected function checkReference($referenceId, $type, $user)
    {
        $reference = null;
        if ($type == PaymentTypes::subscription) {
            if ($user->has_subscribe??null) {
                $res=new stdClass();
                $res->message="اشتراک فعال دارید و قادر به خرید اشتراک نمی باشید.";
                return $res;
            }
            $reference = Subscribe::query()->find($referenceId);

            if(!$reference){
                $res=new stdClass();
                $res->message="اشتراک یافت نشد.";
                return $res;
            }
        } 

        return $reference;
    }

    protected function request(IPaymentGateway $gateway, PaymentGatewayRequestDto $request)
    {
        return $gateway->requestPay($request);
    }

    public function verify($guid, $bank)
    {
        $paymentGateway = null;
        if ($bank == PaymentGatewayBanks::ZARINPALL) {
            $paymentGateway = new Zarinpal();
        }
        $payment = Payment::query()->where('gu_id',$guid)->first();

        if(!$payment){
            $this->responseJson("خطا در انجام تراکنش",null,401);
        }
        $reference = $this->checkReference($payment->reference_id, $payment->type, $payment->user);

        $result = $this->checkVerify($paymentGateway, $guid, $payment->amount);
        if (!$reference || !isset($reference->id) ){
            $result->isSuccess=false;
            $result->description ="خطایی در انجام تراکنش رخ داده اشت.";
       }

        if ($result->status == 100 && $result->isSuccess) {
            $this->checkout($payment, $reference);
            $payment->update([
                "ref_id" => $result->refId,
                "state" => $result->state,
            ]);          
        }
        $result->action = $this->getBackUrl($payment->type); 

        if (request()->wantsJson()) {
            return $this->responseJson( "", $result);
        }

        if ($result->isSuccess) {
            return view('checkout-success', ['data' => $result]);
        }
        return view('checkout-error', ['data' => $result]);
    }

    protected function checkVerify(IPaymentGateway $gateway, $guid, $amount)
    {
        return $gateway->verify($guid, $amount);
    }

    protected function checkout($payment, $reference)
    {
        $type = $payment->type;
        if ($type == PaymentTypes::subscription) {
            $userSubscribe = $payment->user->subscribe;
            $startAt = $userSubscribe ? Carbon::parse($userSubscribe->expire_at)->addDay() : now();
            UserSubscribe::query()->create([
                "user_id" => $payment->user_id,
                "payment_gu_id" => $payment->gu_id,
                "subscribe_id" => $reference->id,
                "price" => $reference->price,
                "title" => $reference->title,
                "expire_at" => $startAt->addDays($reference->days),
            ]);
        }
    }

    private function getBackUrl($type)
    {
        $action = "";
        switch ($type) {
            case 1:
                $action = "";
                break;
        }
        return  env("APP_URL") . "/" . $action;

    }
}
