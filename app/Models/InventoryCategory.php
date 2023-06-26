<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function items() {
        return $this->hasMany(InventoryItem::class, 'inventory_category_id', 'id');
    }
}
