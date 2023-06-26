<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryLogItemsResource extends JsonResource
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
      return [
        "item_name" => $this->item->name,
        "item_unit" => $this->item->unit,
        "decrease" => $this->decrease,
        "increase" => $this->increase,
      ];
    }
}
