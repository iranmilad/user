<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $tokens, $title, $body,$link;

    /**
     * Create a new job instance.
     * @param  $mobile ,$parameters,$templateId
     *
     * @return void
     */
    public function __construct($tokens, $title, $body)
    {
        $this->tokens = $tokens;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        if(is_array($this->tokens) && sizeof(array_filter( $this->tokens,function ($item){return $item!=null;}))){
            $fields = array(
                'registration_ids' =>
                    $this->tokens,

                "notification" => array(
                    "title" => $this->title,
                    "body" => $this->body,
                )
            );
            $fields = json_encode($fields);

            $headers = array(
                'Authorization: key=' . env('FIREBASE_KEY'),
                'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

            $result = curl_exec($ch);
            echo $result;
            curl_close($ch);
        }


    }
}
