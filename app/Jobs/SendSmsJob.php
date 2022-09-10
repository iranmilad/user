<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $mobile, $message;

    /**
     * Create a new job instance.
     * @param  $mobile ,$message
     *
     * @return void
     */
    public function __construct($mobile, $message)
    {
        $this->mobile = $mobile;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{


            $rcpt_nm = is_array($this->mobile) ? $this->mobile : explode( "," , $this->mobile );


            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://rest.ippanel.com/v1/messages',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>array(
                "originator"=> env("SMS_PANNEL_FROM"),
                "recipients"=> json_encode($rcpt_nm),
                "message"=> $this->message
              ),
              CURLOPT_HTTPHEADER => array(
                'Authorization'=> env("SMS_PANNEL_Token"),
                'Content-Type'=>'application/json'
              ),
            ));
            $response = curl_exec($curl);

            curl_close($curl);

        }catch (\Exception $ex){
            Log::warning(json_encode($ex));
        }

    }
}
