<?php

namespace App\Http\Resources\Menu;

use App\Constants\jDateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            "key" => $this->when($this->key !== null, $this->key),
            "subscribes" => $this->when($this->relationLoaded("subscribes"), $this->subscribes()->with("subscribe")->get()),
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}