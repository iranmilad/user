<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

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
            $url = "https://ippanel.com/services.jspd";
		
            $rcpt_nm = is_array($this->mobile) ? $this->mobile : explode( "," , $this->mobile );
            $param = array
                        (
                            'uname'=>env("SMS_PANNEL_UNAME"),
                            'pass'=>env("SMS_PANNEL_PASS"),
                            'from'=>env("SMS_PANNEL_FROM"),
                            'message'=>$this->message,
                            'to'=>json_encode($rcpt_nm),
                            'op'=>'send'
                        );
                        
            $handler = curl_init($url);             
            curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($handler, CURLOPT_POSTFIELDS, $param);                       
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($handler);
            
            // $response2 = json_decode($response2);
            // $res_code = $response2[0];
            // $res_data = $response2[1];
            
            curl_close($handler);
    
        }catch (\Exception $ex){

        }

    }
}
