<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class FamilyDetailResource extends JsonResource
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
      "id" => $this->id,
      "number" => $this->number,
      "total_member" => $this->total_member,
      "neighborhood_id" => $this->neighborhood_id,
      "address" => $this->address ?? "",
      "head_family" => $this->head_family,
      "neighborhood_name" => $this->neighborhood->name,
      "member_names" => $this->members->pluck("name")->join(", ")
    ]);
  }
}
