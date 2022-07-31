<?php

namespace App\Http\Resources\Chart;

use App\Constants\jDateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class UserChartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $accessibility=$this->accessibility;
        return [
            "id" => $this->when($this->id !== null, $this->id),
            "title" => $this->when($this->title !== null, $this->title),
            "key" => $this->when($this->key !== null, $this->key),
            "refresh_time" => $accessibility->refresh_time,
            "feeder_url" => $this->when($this->feeder_url !== null, $this->feeder_url),
            "active" => $accessibility->active,
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}