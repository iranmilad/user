<?php

namespace App\Http\Resources\UserQuestion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserAuestionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "data" => $this->collection,
            "draw"=> $request->input('draw'),
            "recordsTotal"=>$this->total(),
            "recordsFiltered"=>$this->total(),
        ];
    }
}