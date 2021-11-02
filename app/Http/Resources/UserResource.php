<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "hash" => $this->hash,
            "email" => $this->email,
            "username" => $this->username,
            "full_name" => $this->full_name,
            "access_token" => $this->token
        ];
    }
}
