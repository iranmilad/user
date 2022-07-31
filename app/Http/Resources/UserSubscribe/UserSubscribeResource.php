<?php

namespace App\Http\Resources\UserSubscribe;

use App\Constants\jDateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSubscribeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->when($this->id !== null, $this->id),
            "user_id" => $this->when($this->user_id !== null, $this->user_id),
            "user"=> $this->when($this->relationLoaded("user") !== null, $this->user),       
            "title" => $this->when($this->title !== null, $this->title),
            "price" => $this->when($this->price !== null, number_format( $this->price)),
            "payment_gu_id" => $this->when($this->payment_gu_id !== null, $this->payment_gu_id),
            "expire_at" => $this->when($this->expire_at !== null, $this->expire_at),
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}