<?php

namespace App\Http\Resources\Admin;

use App\Constants\jDateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            "first_name" => $this->when($this->first_name !== null, $this->first_name),
            "last_name" => $this->when($this->last_name !== null, $this->last_name),
            "mobile" => $this->when($this->mobile !== null, $this->mobile),
            "supper_admin" => $this->when($this->supper_admin !== null, $this->supper_admin),
            "password" => $this->when($this->password !== null, $this->password),
            "active" => $this->when($this->active !== null, $this->active),
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}