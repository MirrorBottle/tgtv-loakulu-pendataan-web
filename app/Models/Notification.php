<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
      'category',
      'user_id',
      'message',
      'is_read'
    ];

    private function getMessageByRecipient($recipient, $order_number) {
      $role_id = $recipient->roles->first()->id;
      switch (intval($role_id)) {
        // If penyelia
        case 3:
        // If SDM
        case 4:
        // If koordinator
        case 5:
          return "$order_number need approvement";
        // If Driver
        case 6:
          return "$order_number has start order";
        default:
          # code...
          return "$order_number has been approved";
          break;
      }
    }

    // SCOPE

    public function scopeCreateOrderNotif($query, $recipient, $order) {
      $query->create([
        'category' => 1,
        'user_id' => $recipient->id,
        'message' => $this->getMessageByRecipient($recipient, $order->order_number),
      ]);
    }

    public function scopeGeNotRead($query) {
      $query->where('is_read', 0)->get();
    }

    //RELATIONSHIP
    public function user() {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
