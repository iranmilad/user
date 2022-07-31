<?php

namespace App\Http\Resources\Payment;

use App\Constants\jDateFormat;
use App\Constants\PaymentStates;
use App\Constants\PaymentTypes;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            "gu_id" => $this->when($this->gu_id !== null, $this->gu_id),
            "user_id" => $this->when($this->user_id !== null, $this->user_id),
            "user" => $this->when($this->relationLoaded("user"), $this->user),
            "ref_id" => $this->when($this->ref_id !== null, $this->ref_id),
            "amount" => $this->when($this->amount !== null, $this->amount),
            "amount_format" => $this->when($this->amount !== null, number_format($this->amount)),
            "state" => $this->when($this->state !== null, $this->state),
            "state_text" => $this->when($this->state !== null, PaymentStates::aliases($this->state)),
            "type" => $this->when($this->type !== null, $this->type),
            "type_text" => $this->when($this->type !== null, PaymentTypes::aliases($this->type)),
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::H)),
        ];
    }
}