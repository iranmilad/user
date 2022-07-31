<?php

namespace App\Http\Resources\UserSubscribe;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserSubscribeCollection extends ResourceCollection
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