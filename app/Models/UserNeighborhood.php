<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNeighborhood extends Model
{
    use HasFactory;


    public function neighborhood() {
        return $this->belongsTo(Neighborhood::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
