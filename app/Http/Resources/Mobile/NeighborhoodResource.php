<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class NeighborhoodResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return helperCamelizeArray([
      "id" => $this->neighborhood->id,
      "name" => $this->neighborhood->name,
      "family_total" => $this->neighborhood->families->count(),
      "villager_total" => $this->neighborhood->villagers->count()
    ]);
  }
}
