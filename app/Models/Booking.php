<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Booking extends Model {
protected $fillable = ['user_id', 'room_id', 'start_time', 'end_time', 'rent_type', 'total_price', 'status'];
    public function room() { return $this->belongsTo(Room::class); }
    public function user() { return $this->belongsTo(User::class); }
}