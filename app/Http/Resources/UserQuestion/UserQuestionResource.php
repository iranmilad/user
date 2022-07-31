<?php

namespace App\Http\Resources\UserQuestion;

use App\Constants\jDateFormat;
use Illuminate\Http\Resources\Json\JsonResource;

class UserQuestionResource extends JsonResource
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
            "type" => $this->when($this->type !== null, $this->type),
            "title" => $this->when($this->title !== null, $this->title),
            "question" => $this->when($this->question !== null, $this->question),
            "answer" => $this->when($this->answer !== null, $this->answer),
            "answerd_at" => $this->when($this->answerd_at !== null, $this->answerd_at),
            "answerd_by" => $this->when($this->answerd_by !== null, $this->answerd_by),
            "responder"=> $this->when($this->relationLoaded("responder") !== null, $this->responder),         
            "created_at" => $this->when($this->created_at !== null, jdate($this->created_at)->format(jDateFormat::S)),
        ];
    }
}