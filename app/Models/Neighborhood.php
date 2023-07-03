<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    use HasFactory;

    public function families() {
        return $this->hasMany(Family::class, "neighborhood_id", "id");
    }

    public function villagers() {
        return $this->hasMany(Villager::class, "neighborhood_id", "id");
    }
}
