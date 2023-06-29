<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class VillagerDetailResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return helperCamelizeArray(array_merge(parent::toArray($request), [
      'neighborhood_id'   => (int) $this->neighborhood_id,
      'family_id'         => (int) $this->family_id,
      'age'               => $this->age,
      'birth_date'        => $this->birth_date->format("d/m/Y"),
      'family_number'     => $this->family->number,
      'neighborhood_name' => $this->neighborhood->name
  ]));
  }
}
