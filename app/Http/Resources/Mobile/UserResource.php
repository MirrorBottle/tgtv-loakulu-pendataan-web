<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
class UserResource extends JsonResource
{
    protected $token;
    public function token($value){
        $this->token = $value;
        return $this;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return helperCamelizeArray(array_merge(parent::toArray($request), [
            'bearer_token' => $this->token,
            'role' => $this->isRoleAdmin ? "admin" : "user",
            'neighborhoods' => $this->neighborhoods->map(function($neighborhood) {
                return [
                    'id' => $neighborhood->id,
                    'name' => $neighborhood->name
                ];
            })
        ]));
    }
}
