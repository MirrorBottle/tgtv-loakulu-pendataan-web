<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    public $guarded = [];

    public function members() {
        return $this->hasMany(Villager::class);
    }

    public function neighborhood() {
        return $this->belongsTo(Neighborhood::class);
    }
}
