<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    use HasFactory;

    public static $INVENTORY_OUT = 1;
    public static $INVENTORY_IN = 2; 
    
    protected $guarded = [];
    protected $dates = [
        "date"
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function admin() {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
    public function stocks() {
        return $this->hasMany(InventoryStock::class, 'inventory_log_id', 'id');
    }

    public function scopeIn($query) {
        return $query->where("type", self::$INVENTORY_IN);
    }

    public function scopeOut($query) {
        return $query->where("type", self::$INVENTORY_OUT);
    }

    public function getTypeLabelAttribute() {
        return $this->type == self::$INVENTORY_IN ? "Masuk" : "Keluar";
    }
}
