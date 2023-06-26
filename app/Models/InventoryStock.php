<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = [
        "date"
    ];

    public function item() {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id', 'id');
    }

    public function log() {
        return $this->belongsTo(InventoryLog::class, 'inventory_log_id', 'id');
    }

    public function getAlterQuantityAttribute() {
        return $this->decrease == 0 ? $this->increase : $this->decrease;
    }
}
