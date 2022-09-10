<?php
namespace App\Traits\VerificationCode;


use App\Jobs\SendSmsJob;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

trait VerificationCode
{
    private function createVerificationCode($request)
    {
        $mobile = $request->input('mobile');
        $vCode = \App\Models\VerificationCode::query()->where([['mobile', $mobile], ['created_at', '>=', Carbon::now()->addMinutes(-2)->format('Y-m-d H:i:s')]])->first();

        if (!$vCode) {
            $code = random_int(1000, 9999);
            $guId = uniqid();
            $vCode=\App\Models\VerificationCode::query()->create([
                "gu_id" => $guId,
                "mobile" => $mobile,
                "code" => $code,
                "info" => json_encode($request->only(['first_name','last_name','password'])),
                "expire_at" => now()->addMinutes(5)
            ]);
            //if (env('APP_DEBUG') != "true")
                $a=SendSmsJob::dispatch($mobile, "کد تایید : $code");
                Log::info(json_encode($mobile));
        }
        return $vCode;
    }

    private function verifyCode($request)
    {
        $guId = $request->input('gu_id');
        $verificationCode = \App\Models\VerificationCode::query()->where('gu_id', $guId)->firstOrFail();

        if ($verificationCode->used == 1)
            throw ValidationException::withMessages(['code' => __("code used")]);
        if ($verificationCode->expire_at < now()->format('Y-m-d H:i:s'))
            throw ValidationException::withMessages(['code' => __("code expired")]);
        if ($verificationCode->code != $request->input('code'))
            throw ValidationException::withMessages(['code' => __("invalid code")]);

        $verificationCode->used = 1;
        $verificationCode->save();
        return $verificationCode;
    }

    private function getVerificationCodeByGuId($guId)
    {
        return \App\Models\VerificationCode::query()->where('gu_id', $guId)->first();
    }

}
