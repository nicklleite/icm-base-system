<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "hash" => $this->hash,
            "company_id" => $this->company_id,
            "full_name" => $this->full_name,
            "social_name" => $this->social_name,
            "birthday" => $this->birthday,
            "birth_city" => $this->birth_city,
            "birth_state" => $this->birth_state,
            "birth_country" => $this->birth_country,
            'is_pwd' => $this->is_pwd,
        ];
    }
}
