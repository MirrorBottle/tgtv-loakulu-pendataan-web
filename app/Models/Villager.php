<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villager extends Model
{
    use HasFactory;

    public $dates = ['birth_date'];

    public function family() {
        return $this->belongsTo(Family::class);
    }

    public function neighborhood() {
        return $this->belongsTo(Neighborhood::class);
    }

    public function getAgeAttribute() {
        return Carbon::parse($this->birth_date)->diff(Carbon::now())->y;
    }

    
}
