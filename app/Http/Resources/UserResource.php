<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'key'=> $this->id,
            'name'=> $this->name,
            'email'=>$this->email,
        ];
    }
}