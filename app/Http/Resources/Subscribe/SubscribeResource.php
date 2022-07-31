<?php

namespace App\Http\Resources\Subscribe;

use App\Constants\jDateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscribeResource extends JsonResource
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
            "title" => $this->when($this->title !== null, $this->title),
            "description" => $this->when($this->description !== null, $this->description),
            "price" => $this->when($this->price !== null, number_format($this->price)),
            "period" => $this->when($this->period !== null, $this->period),
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}