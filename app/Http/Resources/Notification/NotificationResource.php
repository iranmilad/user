<?php

namespace App\Http\Resources\Notification;

use App\Constants\jDateFormat;
use App\Constants\NotificationTypes;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            "text" => $this->when($this->text !== null, $this->text),
            "type" => $this->when($this->type !== null, NotificationTypes::aliases($this->type)),
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::H)),
        ];
    }
}