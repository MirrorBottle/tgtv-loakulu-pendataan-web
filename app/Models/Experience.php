<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'type',
        'name',
        'year',
        'description',
        'is_active'
    ];

    public function getTypeLabelAttribute() {
        return $this->type == '1' ? 'Catering' : 'Rental';
    }

    public function scopeCatherings($query) {
        return $query->where('is_active', 1)->where('type', '1')->get();
    }

    public function scopeRents($query) {
        return $query->where('is_active', 1)->where('type', '2')->get();
    }
}
