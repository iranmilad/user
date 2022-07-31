<?php

namespace App\Http\Resources\Chart;

use App\Constants\jDateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class ChartResource extends JsonResource
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
            "refresh_time" => $this->when($this->refresh_time !== null, $this->refresh_time),
            "subscribes" => $this->when($this->relationLoaded("subscribes"), $this->subscribes()->with("subscribe")->get()),
            "feeder_url" => $this->when($this->feeder_url !== null, $this->feeder_url),
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}