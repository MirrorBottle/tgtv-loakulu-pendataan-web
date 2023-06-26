<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = ['ip_address', 'device', 'visitor'];


    public function scopeExist($query, $ip) {
        return $query->where('ip_address', $ip)->exists();
    }
}
